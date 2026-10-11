import { Router } from 'express';
import { db } from '../db.js';
import { requireAuth } from '../middleware/auth.js';
import { STAGES, STAGE_LABELS } from '../services/shopFlow.js';

const router = Router();
router.use(requireAuth);

// GET /api/reports/stats — dashboard counters
router.get('/stats', (_req, res) => {
  const coaches = db.prepare('SELECT COUNT(*) AS n FROM coaches').get().n;
  const inProgress = db
    .prepare(`SELECT COUNT(*) AS n FROM registrations WHERE status = 'in_progress'`)
    .get().n;
  const released = db
    .prepare(`SELECT COUNT(*) AS n FROM registrations WHERE status = 'released'`)
    .get().n;
  const byStage = db
    .prepare(
      `SELECT current_stage, COUNT(*) AS n FROM registrations
       WHERE status = 'in_progress' GROUP BY current_stage`
    )
    .all()
    .map((r) => ({ stage: r.current_stage, label: STAGE_LABELS[r.current_stage], count: r.n }));
  const users = db.prepare('SELECT COUNT(*) AS n FROM users').get().n;
  res.json({ coaches, inProgress, released, byStage, users });
});

// GET /api/reports/holding?stage= — shop holding (legacy "SHOP HOLDING" report)
router.get('/holding', (req, res) => {
  const stage = (req.query.stage || 'ALL').toString();
  const where = [`r.status = 'in_progress'`];
  const params = [];
  if (stage !== 'ALL') {
    where.push('r.current_stage = ?');
    params.push(stage);
  }
  const rows = db
    .prepare(
      `SELECT r.id, r.coach_no, r.repair_type, r.workshop_in, r.estimated_hours,
              r.current_stage, c.railway_zone, c.alloted_base, c.coach_type, c.category,
              (SELECT in_at FROM stage_events e WHERE e.registration_id = r.id
                 AND e.stage = r.current_stage ORDER BY e.id DESC LIMIT 1) AS stage_in_at,
              CAST(julianday('now') - julianday(
                (SELECT in_at FROM stage_events e WHERE e.registration_id = r.id
                   AND e.stage = r.current_stage ORDER BY e.id DESC LIMIT 1)
              ) AS INTEGER) AS days_in_stage
       FROM registrations r LEFT JOIN coaches c ON c.coach_no = r.coach_no
       WHERE ${where.join(' AND ')}
       ORDER BY r.coach_no`
    )
    .all(...params);
  res.json({
    stage,
    stage_label: stage === 'ALL' ? 'All stages' : STAGE_LABELS[stage] || stage,
    holding: rows,
  });
});

// GET /api/reports/history/:coachNo — full repair history of one coach
router.get('/history/:coachNo', (req, res) => {
  const coachNo = req.params.coachNo;
  const coach = db.prepare('SELECT * FROM coaches WHERE coach_no = ?').get(coachNo);
  const regs = db
    .prepare(
      `SELECT * FROM registrations WHERE coach_no = ? ORDER BY workshop_in DESC, id DESC`
    )
    .all(coachNo);
  const eventsFor = db.prepare(
    'SELECT * FROM stage_events WHERE registration_id = ? ORDER BY id ASC'
  );
  const timeline = regs.map((r) => ({
    ...r,
    stage_label: STAGE_LABELS[r.current_stage],
    events: eventsFor.all(r.id).map((e) => ({
      ...e,
      stage_label: STAGE_LABELS[e.stage],
      duration_days:
        e.out_at && e.in_at
          ? Math.round((new Date(e.out_at) - new Date(e.in_at)) / 86400000)
          : null,
    })),
  }));
  res.json({ coach: coach || null, coach_no: coachNo, registrations: timeline });
});

// GET /api/reports/stages — for the stage filter dropdown
router.get('/stages', (_req, res) => {
  res.json({
    stages: [{ value: 'ALL', label: 'All' }].concat(
      Object.entries(STAGE_LABELS).map(([value, label]) => ({ value, label }))
    ),
  });
});

export default router;
