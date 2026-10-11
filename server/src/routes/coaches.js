import { Router } from 'express';
import { z } from 'zod';
import { db } from '../db.js';
import { requireAuth, requireAdmin } from '../middleware/auth.js';

const router = Router();
router.use(requireAuth); // all logged-in users may view; writes are admin-only

const coachSchema = z.object({
  coach_no: z.string().min(1, 'Coach number is required').max(20),
  railway_zone: z.string().max(10).default(''),
  alloted_base: z.string().max(20).default(''),
  full_brake: z.string().max(10).default(''),
  coach_type: z.string().max(20).default(''),
  make: z.string().max(20).default(''),
  category: z.string().max(20).default(''),
  built_date: z.string().max(20).default(''),
});

// GET /api/coaches?q= — list/search coach master
router.get('/', (req, res) => {
  const q = (req.query.q || '').toString().trim();
  let rows;
  if (q) {
    const like = `%${q}%`;
    rows = db
      .prepare(
        `SELECT * FROM coaches
         WHERE coach_no LIKE ? OR railway_zone LIKE ? OR alloted_base LIKE ?
            OR coach_type LIKE ? OR category LIKE ? OR make LIKE ?
         ORDER BY coach_no`
      )
      .all(like, like, like, like, like, like);
  } else {
    rows = db.prepare('SELECT * FROM coaches ORDER BY coach_no').all();
  }
  // Flag coaches currently in the workshop (any in_progress registration).
  const stmt = db.prepare(
    `SELECT COUNT(*) AS n FROM registrations WHERE coach_no = ? AND status = 'in_progress'`
  );
  res.json({
    coaches: rows.map((c) => ({ ...c, in_workshop: stmt.get(c.coach_no).n > 0 })),
  });
});

// POST /api/coaches — add a new coach to the master (legacy coach management)
router.post('/', requireAdmin, (req, res) => {
  const parsed = coachSchema.safeParse(req.body);
  if (!parsed.success) {
    return res.status(400).json({ error: parsed.error.issues[0].message });
  }
  const d = parsed.data;
  if (db.prepare('SELECT id FROM coaches WHERE coach_no = ?').get(d.coach_no)) {
    return res.status(409).json({ error: `Coach ${d.coach_no} is already in the master` });
  }
  const info = db
    .prepare(
      `INSERT INTO coaches (coach_no, railway_zone, alloted_base, full_brake, coach_type, make, category, built_date)
       VALUES (@coach_no, @railway_zone, @alloted_base, @full_brake, @coach_type, @make, @category, @built_date)`
    )
    .run(d);
  const coach = db.prepare('SELECT * FROM coaches WHERE id = ?').get(info.lastInsertRowid);
  res.status(201).json({ coach });
});

// PUT /api/coaches/:id
router.put('/:id', requireAdmin, (req, res) => {
  const parsed = coachSchema.safeParse(req.body);
  if (!parsed.success) {
    return res.status(400).json({ error: parsed.error.issues[0].message });
  }
  const id = Number(req.params.id);
  const existing = db.prepare('SELECT * FROM coaches WHERE id = ?').get(id);
  if (!existing) return res.status(404).json({ error: 'Coach not found' });
  if (parsed.data.coach_no !== existing.coach_no) {
    if (db.prepare('SELECT id FROM coaches WHERE coach_no = ?').get(parsed.data.coach_no)) {
      return res.status(409).json({ error: `Coach ${parsed.data.coach_no} is already in the master` });
    }
    // Keep registrations consistent if the coach number changed.
    db.prepare('UPDATE registrations SET coach_no = ? WHERE coach_no = ?').run(
      parsed.data.coach_no,
      existing.coach_no
    );
  }
  db.prepare(
    `UPDATE coaches SET coach_no = @coach_no, railway_zone = @railway_zone, alloted_base = @alloted_base,
     full_brake = @full_brake, coach_type = @coach_type, make = @make, category = @category,
     built_date = @built_date WHERE id = @id`
  ).run({ ...parsed.data, id });
  const coach = db.prepare('SELECT * FROM coaches WHERE id = ?').get(id);
  res.json({ coach });
});

// DELETE /api/coaches/:id — blocked if the coach has an active registration
router.delete('/:id', requireAdmin, (req, res) => {
  const id = Number(req.params.id);
  const coach = db.prepare('SELECT * FROM coaches WHERE id = ?').get(id);
  if (!coach) return res.status(404).json({ error: 'Coach not found' });
  const active = db
    .prepare(`SELECT id FROM registrations WHERE coach_no = ? AND status = 'in_progress'`)
    .get(coach.coach_no);
  if (active) {
    return res.status(409).json({
      error: `Coach ${coach.coach_no} has an in-progress registration and cannot be deleted`,
    });
  }
  db.prepare('DELETE FROM coaches WHERE id = ?').run(id);
  res.json({ ok: true });
});

export default router;
