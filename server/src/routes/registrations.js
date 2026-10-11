import { Router } from 'express';
import { z } from 'zod';
import { db } from '../db.js';
import { requireAuth, requireAdmin } from '../middleware/auth.js';
import {
  moveForward,
  moveBackward,
  requiredInputsFor,
  FlowError,
  STAGES,
  STAGE_LABELS,
  SHOP_CHOICES,
} from '../services/shopFlow.js';

const router = Router();
router.use(requireAuth);

const registrationSchema = z.object({
  coach_no: z.string().min(1, 'Coach number is required'),
  repair_type: z.enum(['POH', 'MCR', 'HCR']),
  workshop_in: z.string().min(1, 'Workshop-in date is required'),
  estimated_hours: z.coerce.number().int().min(0),
});

const moveSchema = z.object({
  direction: z.enum(['forward', 'backward']),
  actualHours: z.coerce.number().int().min(0).optional(),
  shopNo: z.coerce.number().int().optional(),
  fit: z.enum(['YES', 'NO']).optional(),
  done: z.coerce.boolean().optional(),
});

const regWithCoach = `
  SELECT r.*, c.railway_zone, c.alloted_base, c.coach_type, c.category,
         c.make, c.built_date,
         (SELECT in_at FROM stage_events e WHERE e.registration_id = r.id AND e.stage = r.current_stage
          ORDER BY e.id DESC LIMIT 1) AS stage_in_at
  FROM registrations r LEFT JOIN coaches c ON c.coach_no = r.coach_no`;

function canGoBack(id) {
  // Mirrors shopFlow.previousStageOf: at least two distinct stages in timeline.
  const events = db
    .prepare('SELECT stage FROM stage_events WHERE registration_id = ? ORDER BY id ASC')
    .all(id);
  if (events.length === 0) return false;
  const reg = db.prepare('SELECT current_stage FROM registrations WHERE id = ?').get(id);
  const idx = events.map((e) => e.stage).lastIndexOf(reg.current_stage);
  return idx > 0;
}

// GET /api/registrations?status=&stage=&q=
router.get('/', (req, res) => {
  const { status, stage, q } = req.query;
  const where = [];
  const params = [];
  if (status) { where.push('r.status = ?'); params.push(status); }
  if (stage) { where.push('r.current_stage = ?'); params.push(stage); }
  if (q) { where.push('r.coach_no LIKE ?'); params.push(`%${q}%`); }
  const sql = `${regWithCoach} ${where.length ? 'WHERE ' + where.join(' AND ') : ''}
               ORDER BY r.id DESC`;
  const rows = db.prepare(sql).all(...params);
  res.json({
    registrations: rows.map((r) => ({
      ...r,
      stage_label: STAGE_LABELS[r.current_stage],
      required_inputs: r.status === 'released' ? [] : requiredInputsFor(r.current_stage),
      can_go_back: r.status === 'in_progress' && canGoBack(r.id),
    })),
  });
});

// GET /api/registrations/:id — full detail + event timeline (coach history)
router.get('/:id', (req, res) => {
  const reg = db.prepare(`${regWithCoach} WHERE r.id = ?`).get(Number(req.params.id));
  if (!reg) return res.status(404).json({ error: 'Registration not found' });
  const events = db
    .prepare('SELECT * FROM stage_events WHERE registration_id = ? ORDER BY id ASC')
    .all(reg.id);
  res.json({
    registration: {
      ...reg,
      stage_label: STAGE_LABELS[reg.current_stage],
      required_inputs: reg.status === 'released' ? [] : requiredInputsFor(reg.current_stage),
    },
    events: events.map((e) => ({ ...e, stage_label: STAGE_LABELS[e.stage] })),
  });
});

// POST /api/registrations — register a coach for repair (legacy registration)
router.post('/', requireAdmin, (req, res) => {
  const parsed = registrationSchema.safeParse(req.body);
  if (!parsed.success) {
    return res.status(400).json({ error: parsed.error.issues[0].message });
  }
  const { coach_no, repair_type, workshop_in, estimated_hours } = parsed.data;
  const coach = db.prepare('SELECT coach_no FROM coaches WHERE coach_no = ?').get(coach_no);
  if (!coach) {
    return res.status(404).json({ error: `Coach ${coach_no} is not in the coach master` });
  }
  const active = db
    .prepare(`SELECT id FROM registrations WHERE coach_no = ? AND status = 'in_progress'`)
    .get(coach_no);
  if (active) {
    return res
      .status(409)
      .json({ error: `Coach ${coach_no} already has an in-progress registration (#${active.id})` });
  }
  const id = db.transaction(() => {
    const info = db
      .prepare(
        `INSERT INTO registrations (coach_no, repair_type, workshop_in, estimated_hours, current_stage)
         VALUES (?, ?, ?, ?, ?)`
      )
      .run(coach_no, repair_type, workshop_in, estimated_hours, STAGES.REGISTERED);
    const regId = info.lastInsertRowid;
    db.prepare('INSERT INTO stage_events (registration_id, stage, in_at) VALUES (?, ?, ?)').run(
      regId,
      STAGES.REGISTERED,
      workshop_in
    );
    return regId;
  })();
  const reg = db.prepare(`${regWithCoach} WHERE r.id = ?`).get(id);
  res.status(201).json({ registration: { ...reg, stage_label: STAGE_LABELS[reg.current_stage] } });
});

// POST /api/registrations/:id/move — forward/backward through the workshop
router.post('/:id/move', requireAdmin, (req, res) => {
  const parsed = moveSchema.safeParse(req.body);
  if (!parsed.success) {
    return res.status(400).json({ error: parsed.error.issues[0].message });
  }
  const id = Number(req.params.id);
  try {
    const reg =
      parsed.data.direction === 'forward' ? moveForward(id, parsed.data) : moveBackward(id);
    res.json({
      registration: {
        ...reg,
        stage_label: STAGE_LABELS[reg.current_stage],
        required_inputs: reg.status === 'released' ? [] : requiredInputsFor(reg.current_stage),
      },
    });
  } catch (err) {
    if (err instanceof FlowError) return res.status(err.status).json({ error: err.message });
    throw err;
  }
});

// GET /api/registrations/meta/stages — stage list + shop choices for the UI
router.get('/meta/stages', (_req, res) => {
  res.json({
    stages: Object.entries(STAGE_LABELS).map(([value, label]) => ({ value, label })),
    shops: Object.entries(SHOP_CHOICES).map(([no, stage]) => ({
      shopNo: Number(no),
      stage,
      label: `${STAGE_LABELS[stage]} (shop ${no})`,
    })),
  });
});

export default router;
