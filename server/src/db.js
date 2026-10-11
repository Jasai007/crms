import Database from 'better-sqlite3';
import path from 'node:path';
import fs from 'node:fs';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const dataDir = path.join(__dirname, '..', 'data');
fs.mkdirSync(dataDir, { recursive: true });

const dbPath = process.env.DB_PATH || path.join(dataDir, 'crms.db');
export const db = new Database(dbPath);
db.pragma('journal_mode = WAL');
db.pragma('foreign_keys = ON');

/**
 * Schema design (v2):
 *  - `registrations` is the single source of truth for a repair job and
 *    tracks which stage the coach is currently at (`current_stage`).
 *  - `stage_events` replaces the 8 per-shop tables of the legacy app
 *    (strip_ins, pohtable, mcrtable, hcrtable, painting, lifting,
 *    break_shop, ntxr, last_repair, trafficout) with an append-only
 *    timeline: one row per stage entry, closed with `out_at` on exit.
 */
export function initSchema() {
  db.exec(`
    CREATE TABLE IF NOT EXISTS users (
      id            INTEGER PRIMARY KEY AUTOINCREMENT,
      username      TEXT    NOT NULL UNIQUE,
      password_hash TEXT    NOT NULL,
      role          TEXT    NOT NULL DEFAULT 'viewer' CHECK (role IN ('admin','viewer')),
      firstname     TEXT    NOT NULL DEFAULT '',
      lastname      TEXT    NOT NULL DEFAULT '',
      email         TEXT    NOT NULL DEFAULT '',
      doj           TEXT    NOT NULL DEFAULT '',
      created_at    TEXT    NOT NULL DEFAULT (datetime('now'))
    );

    CREATE TABLE IF NOT EXISTS coaches (
      id            INTEGER PRIMARY KEY AUTOINCREMENT,
      coach_no      TEXT    NOT NULL UNIQUE,
      railway_zone  TEXT    NOT NULL DEFAULT '',
      alloted_base  TEXT    NOT NULL DEFAULT '',
      full_brake    TEXT    NOT NULL DEFAULT '',
      coach_type    TEXT    NOT NULL DEFAULT '',
      make          TEXT    NOT NULL DEFAULT '',
      category      TEXT    NOT NULL DEFAULT '',
      built_date    TEXT    NOT NULL DEFAULT '',
      created_at    TEXT    NOT NULL DEFAULT (datetime('now'))
    );

    CREATE TABLE IF NOT EXISTS registrations (
      id               INTEGER PRIMARY KEY AUTOINCREMENT,
      coach_no         TEXT    NOT NULL,
      repair_type      TEXT    NOT NULL CHECK (repair_type IN ('POH','MCR','HCR')),
      workshop_in      TEXT    NOT NULL,
      estimated_hours  INTEGER NOT NULL DEFAULT 0,
      current_stage    TEXT    NOT NULL DEFAULT 'REGISTERED',
      status           TEXT    NOT NULL DEFAULT 'in_progress'
                                CHECK (status IN ('in_progress','released')),
      created_at       TEXT    NOT NULL DEFAULT (datetime('now')),
      FOREIGN KEY (coach_no) REFERENCES coaches(coach_no) ON DELETE CASCADE
    );

    CREATE TABLE IF NOT EXISTS stage_events (
      id                INTEGER PRIMARY KEY AUTOINCREMENT,
      registration_id   INTEGER NOT NULL,
      stage             TEXT    NOT NULL,
      in_at             TEXT    NOT NULL,
      out_at            TEXT,
      actual_hours      INTEGER,
      shop_no           INTEGER,
      fit               TEXT    CHECK (fit IN ('YES','NO')),
      notes             TEXT    NOT NULL DEFAULT '',
      FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE CASCADE
    );

    CREATE INDEX IF NOT EXISTS idx_reg_stage   ON registrations(current_stage);
    CREATE INDEX IF NOT EXISTS idx_events_reg  ON stage_events(registration_id);
    CREATE INDEX IF NOT EXISTS idx_events_open ON stage_events(registration_id, out_at);
  `);
}

initSchema();
