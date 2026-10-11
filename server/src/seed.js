/**
 * Seed the database with the legacy data from legacy/database/railcoaches.sql,
 * plus the demo admin/viewer accounts from the README.
 *
 * Run: npm run seed
 */
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import bcrypt from 'bcryptjs';
import { db, initSchema } from './db.js';
import { STAGES } from './services/shopFlow.js';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const SQL_FILE = path.join(__dirname, '..', '..', 'legacy', 'database', 'railcoaches.sql');

initSchema();

/* Minimal parser for the phpMyAdmin dump (INSERT statements only). */
function parseInserts(sql) {
  const inserts = [];
  const re = /INSERT INTO `(\w+)` \(([^)]+)\) VALUES\s*([\s\S]*?);/g;
  let m;
  while ((m = re.exec(sql))) {
    const table = m[1];
    const cols = m[2].split(',').map((c) => c.trim().replace(/`/g, ''));
    const rows = [];
    const rowRe = /\(([^)]*)\)/g;
    let r;
    while ((r = rowRe.exec(m[3]))) {
      const vals = splitValues(r[1]);
      if (vals.length !== cols.length) continue;
      const obj = {};
      cols.forEach((c, i) => (obj[c] = vals[i]));
      rows.push(obj);
    }
    inserts.push({ table, rows });
  }
  return inserts;
}

function splitValues(str) {
  const out = [];
  let cur = '';
  let inStr = false;
  for (let i = 0; i < str.length; i++) {
    const ch = str[i];
    if (inStr) {
      if (ch === "'") {
        if (str[i + 1] === "'") { cur += "'"; i++; } else inStr = false;
      } else cur += ch;
    } else if (ch === "'") {
      inStr = true;
    } else if (ch === ',') {
      out.push(cur.trim()); cur = '';
    } else cur += ch;
  }
  out.push(cur.trim());
  return out.map((v) => (v === 'NULL' || v === '0000-00-00' ? null : v.replace(/^'|'$/g, '')));
}

const sql = fs.readFileSync(SQL_FILE, 'utf8');
const inserts = parseInserts(sql);
const data = Object.fromEntries(inserts.map((i) => [i.table, i.rows]));

const tx = db.transaction(() => {
  db.exec(
    'DELETE FROM stage_events; DELETE FROM registrations; DELETE FROM coaches; DELETE FROM users;'
  );

  // Users: MD5 hashes cannot be upgraded to bcrypt, so known demo passwords
  // get fresh bcrypt hashes; the rest get bcrypt("password").
  const demoPasswords = { jasai007: 'jasai', monty99: 'monty' };
  const insertUser = db.prepare(
    `INSERT INTO users (id, username, password_hash, role, firstname, lastname, email, doj)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)`
  );
  for (const u of data.user || []) {
    const pw = demoPasswords[u.username] || 'password';
    insertUser.run(
      Number(u.id),
      u.username,
      bcrypt.hashSync(pw, 10),
      Number(u.userlevel) === 1 ? 'admin' : 'viewer',
      u.firstname,
      u.lastname,
      u.email,
      u.doj
    );
  }
  db.exec(`UPDATE sqlite_sequence SET seq = (SELECT MAX(id) FROM users) WHERE name = 'users'`);

  const insertCoach = db.prepare(
    `INSERT INTO coaches (coach_no, railway_zone, alloted_base, full_brake, coach_type, make, category, built_date)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)`
  );
  for (const c of data.coachmaster || []) {
    insertCoach.run(
      c.COACH_NO, c.RAILWAY_ZONE, c.ALLOATED_BASE, c.FULL_BRAKE,
      c.COACH_TYPE, c.MAKE, c.CATEGORY, c.BUILT_DATE
    );
  }
  const insertReg = db.prepare(
    `INSERT INTO registrations (id, coach_no, repair_type, workshop_in, estimated_hours, current_stage, status)
     VALUES (?, ?, ?, ?, ?, ?, ?)`
  );
  const coachExists = db.prepare('SELECT id FROM coaches WHERE coach_no = ?');
  const insertStubCoach = db.prepare(
    `INSERT INTO coaches (coach_no, railway_zone, alloted_base) VALUES (?, '', '')`
  );
  const insertEvent = db.prepare(
    `INSERT INTO stage_events (registration_id, stage, in_at, out_at, actual_hours, shop_no, fit)
     VALUES (?, ?, ?, ?, ?, ?, ?)`
  );

  // Legacy per-shop table -> stage mapping.
  const shopStages = [
    ['strip_ins', STAGES.STRIPPING, 'strip_in', 'strip_out', 'actual_hour', 'shop_no'],
    ['pohtable', STAGES.POH, 'shop_in', 'shop_out', null, null],
    ['mcrtable', STAGES.MCR, 'shop_in', 'shop_out', null, null],
    ['hcrtable', STAGES.HCR, 'shop_in', 'shop_out', null, null],
    ['painting', STAGES.PAINTING, 'paint_in', 'paint_out', null, null],
    ['lifting', STAGES.LIFTING, 'lift_in', 'lift_out', null, null],
    ['break_shop', STAGES.BRAKE, 'break_in', 'break_out', null, null],
    ['ntxr', STAGES.NTXR, 'check_in', 'check_out', null, null],
    ['last_repair', STAGES.REPAIR, 're_in', 're_out', null, null],
    ['trafficout', STAGES.TRAFFIC_OUT, 'date_out', 'date_out', null, null],
  ];

  // Group shop rows by reg_id so each registration's timeline can be rebuilt.
  const byReg = new Map();
  for (const [table, stage, inCol, outCol, hoursCol, shopCol] of shopStages) {
    for (const row of data[table] || []) {
      const id = Number(row.reg_id);
      if (!byReg.has(id)) byReg.set(id, []);
      byReg.get(id).push({
        stage,
        in_at: row[inCol] || row[outCol],
        out_at: row[outCol],
        actual_hours: hoursCol && row[hoursCol] ? Number(row[hoursCol]) : null,
        shop_no: shopCol && row[shopCol] ? Number(row[shopCol]) : null,
        fit: row.fit || null,
      });
    }
  }

  const STAGE_ORDER = [
    STAGES.REGISTERED, STAGES.STRIPPING, STAGES.POH, STAGES.MCR, STAGES.HCR,
    STAGES.PAINTING, STAGES.LIFTING, STAGES.BRAKE, STAGES.NTXR, STAGES.REPAIR,
    STAGES.TRAFFIC_OUT,
  ];

  for (const r of data.coachreg || []) {
    const id = Number(r.reg_id);
    const events = (byReg.get(id) || []).sort(
      (a, b) => STAGE_ORDER.indexOf(a.stage) - STAGE_ORDER.indexOf(b.stage)
    );

    // Current stage: the open (out_at null) event, else last event, else REGISTERED.
    let currentStage = STAGES.REGISTERED;
    let status = 'in_progress';
    const open = events.find((e) => !e.out_at);
    if (events.length > 0) {
      currentStage = open ? open.stage : events[events.length - 1].stage;
    }
    if (events.some((e) => e.stage === STAGES.TRAFFIC_OUT)) status = 'released';

    // Legacy MyISAM never enforced FKs, so some registrations reference
    // coaches absent from coachmaster; insert a stub so nothing is lost.
    if (!coachExists.get(String(r.coach_no))) {
      insertStubCoach.run(String(r.coach_no));
    }

    insertReg.run(
      id,
      String(r.coach_no),
      r.repair_type,
      r.workshop_in,
      Number(r.estimated_hours) || 0,
      currentStage,
      status
    );

    // REGISTERED event (workshop arrival) — mirrors what POST /registrations does.
    insertEvent.run(id, STAGES.REGISTERED, r.workshop_in, r.shop_in || null, null, null, null);

    for (const e of events) {
      insertEvent.run(id, e.stage, e.in_at || r.workshop_in, e.out_at || null,
        e.actual_hours, e.shop_no, e.fit);
    }
  }

  db.exec(
    `UPDATE sqlite_sequence SET seq = (SELECT MAX(id) FROM registrations) WHERE name = 'registrations';
     UPDATE sqlite_sequence SET seq = (SELECT MAX(id) FROM stage_events) WHERE name = 'stage_events';`
  );
});

tx();

const counts = {
  users: db.prepare('SELECT COUNT(*) n FROM users').get().n,
  coaches: db.prepare('SELECT COUNT(*) n FROM coaches').get().n,
  registrations: db.prepare('SELECT COUNT(*) n FROM registrations').get().n,
  events: db.prepare('SELECT COUNT(*) n FROM stage_events').get().n,
};
console.log('Seed complete:', counts);
console.log('Demo logins -> admin: jasai007 / jasai  |  viewer: monty99 / monty');
console.log('All other legacy users have password: "password" (MD5 cannot be upgraded to bcrypt)');
