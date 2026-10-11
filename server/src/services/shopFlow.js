import { db } from '../db.js';

/**
 * Coach repair workflow state machine.
 *
 * Replaces the 7 legacy `check_*.php` scripts with one place that knows
 * how a coach moves through the workshop (see legacy/flowchart.jpg):
 *
 *   REGISTERED -> STRIPPING -> [POH | MCR | HCR] -> PAINTING -> LIFTING
 *     -> BRAKE -> NTXR (pit line inspection)
 *          |-- fit = YES -> TRAFFIC_OUT (released)
 *          |-- fit = NO  -> REPAIR
 *                              |-- done = false -> back to NTXR (re-inspect)
 *                              |-- done = true  -> TRAFFIC_OUT (released)
 *
 * Every move closes the currently open `stage_events` row and opens a new
 * one for the destination stage (backward moves do the inverse, in one
 * transaction, exactly like the legacy back-action intended).
 */

export const STAGES = {
  REGISTERED: 'REGISTERED',
  STRIPPING: 'STRIPPING',
  POH: 'POH',
  MCR: 'MCR',
  HCR: 'HCR',
  PAINTING: 'PAINTING',
  LIFTING: 'LIFTING',
  BRAKE: 'BRAKE',
  NTXR: 'NTXR',
  REPAIR: 'REPAIR',
  TRAFFIC_OUT: 'TRAFFIC_OUT',
};

export const STAGE_LABELS = {
  REGISTERED: 'Registered',
  STRIPPING: 'Stripping & Inspection',
  POH: 'POH Shop',
  MCR: 'MCR Shop',
  HCR: 'HCR Shop',
  PAINTING: 'Paint Shop',
  LIFTING: 'Lifting Shop',
  BRAKE: 'Brake Shop',
  NTXR: 'Pit Line (NTXR)',
  REPAIR: 'Repair Shop',
  TRAFFIC_OUT: 'Traffic Out',
};

export const REPAIR_BRANCH = [STAGES.POH, STAGES.MCR, STAGES.HCR];

/** Legacy shop numbers -> repair branch (chosen at the stripping step). */
export const SHOP_CHOICES = {
  25: STAGES.POH,
  26: STAGES.MCR,
  33: STAGES.HCR,
};

export class FlowError extends Error {
  constructor(message) {
    super(message);
    this.name = 'FlowError';
    this.status = 400;
  }
}

const now = () => new Date().toISOString().slice(0, 10);

const getReg = db.prepare('SELECT * FROM registrations WHERE id = ?');
const getOpenEvent = db.prepare(
  'SELECT * FROM stage_events WHERE registration_id = ? AND out_at IS NULL ORDER BY id DESC LIMIT 1'
);

export function getRegistration(id) {
  const reg = getReg.get(id);
  if (!reg) throw new FlowError('Registration not found');
  return reg;
}

/**
 * Previous stage of the registration's current stage, derived from its
 * event timeline (handles the NTXR <-> REPAIR loop correctly).
 */
function previousStageOf(reg) {
  const events = db
    .prepare('SELECT * FROM stage_events WHERE registration_id = ? ORDER BY id ASC')
    .all(reg.id);
  if (events.length === 0) return null;
  const idx = events.map((e) => e.stage).lastIndexOf(reg.current_stage);
  if (idx <= 0) return null;
  return events[idx - 1].stage;
}

/** What stage comes after `stage`, given the move payload for branching steps. */
function nextStageOf(stage, payload) {
  switch (stage) {
    case STAGES.REGISTERED:
      return { stage: STAGES.STRIPPING };
    case STAGES.STRIPPING: {
      const branch = SHOP_CHOICES[payload.shopNo];
      if (!branch) {
        throw new FlowError(
          `Invalid shop number. Expected one of: ${Object.keys(SHOP_CHOICES).join(', ')}`
        );
      }
      if (!Number.isInteger(payload.actualHours) || payload.actualHours < 0) {
        throw new FlowError('actualHours must be a non-negative integer');
      }
      return { stage: branch };
    }
    case STAGES.POH:
    case STAGES.MCR:
    case STAGES.HCR:
      return { stage: STAGES.PAINTING };
    case STAGES.PAINTING:
      return { stage: STAGES.LIFTING };
    case STAGES.LIFTING:
      return { stage: STAGES.BRAKE };
    case STAGES.BRAKE:
      return { stage: STAGES.NTXR };
    case STAGES.NTXR: {
      if (payload.fit !== 'YES' && payload.fit !== 'NO') {
        throw new FlowError("Inspection result required: fit must be 'YES' or 'NO'");
      }
      return payload.fit === 'YES'
        ? { stage: STAGES.TRAFFIC_OUT, release: true, fit: payload.fit }
        : { stage: STAGES.REPAIR, fit: payload.fit };
    }
    case STAGES.REPAIR: {
      if (payload.done !== true && payload.done !== false) {
        throw new FlowError('done flag required: true to release, false to re-inspect');
      }
      return payload.done
        ? { stage: STAGES.TRAFFIC_OUT, release: true }
        : { stage: STAGES.NTXR };
    }
    case STAGES.TRAFFIC_OUT:
      throw new FlowError('Coach has been released to traffic; no forward move');
    default:
      throw new FlowError(`Unknown stage: ${stage}`);
  }
}

/**
 * Move a registration forward one step (or across the fit/done branches).
 * Runs in a single transaction; throws FlowError on invalid input.
 */
export function moveForward(regId, payload = {}) {
  const tx = db.transaction(() => {
    const reg = getRegistration(regId);
    if (reg.status === 'released') {
      throw new FlowError('Coach already released to traffic');
    }
    const { stage, release, fit } = nextStageOf(reg.current_stage, payload);

    const open = getOpenEvent.get(reg.id);
    if (!open) throw new FlowError('No open stage event for this registration');

    // Close the current stage.
    db.prepare(
      `UPDATE stage_events SET out_at = @out_at,
       actual_hours = COALESCE(@actual_hours, actual_hours),
       shop_no = COALESCE(@shop_no, shop_no), fit = COALESCE(@fit, fit)
       WHERE id = @id`
    ).run({
      id: open.id,
      out_at: now(),
      actual_hours: Number.isInteger(payload.actualHours) ? payload.actualHours : null,
      shop_no: Number.isInteger(payload.shopNo) ? payload.shopNo : null,
      fit: fit ?? null,
    });

    // Open the next stage.
    db.prepare('INSERT INTO stage_events (registration_id, stage, in_at) VALUES (?, ?, ?)').run(
      reg.id,
      stage,
      now()
    );

    db.prepare('UPDATE registrations SET current_stage = ?, status = ? WHERE id = ?').run(
      stage,
      release ? 'released' : 'in_progress',
      reg.id
    );

    return getReg.get(reg.id);
  });
  return tx();
}

/** Move a registration one step back (undo). */
export function moveBackward(regId) {
  const tx = db.transaction(() => {
    const reg = getRegistration(regId);
    if (reg.status === 'released') {
      throw new FlowError('Coach already released to traffic; cannot move back');
    }
    const prev = previousStageOf(reg);
    if (!prev) throw new FlowError('Already at the first stage; cannot move back');

    const open = getOpenEvent.get(reg.id);
    if (!open) throw new FlowError('No open stage event for this registration');

    // Delete current open event (legacy back-action deleted the row too)...
    db.prepare('DELETE FROM stage_events WHERE id = ?').run(open.id);
    // ...and reopen the previous stage's event.
    const prevEvent = db
      .prepare(
        `SELECT * FROM stage_events WHERE registration_id = ? AND stage = ? AND out_at IS NOT NULL
         ORDER BY id DESC LIMIT 1`
      )
      .get(reg.id, prev);
    if (!prevEvent) throw new FlowError(`No closable event found for stage ${prev}`);
    db.prepare('UPDATE stage_events SET out_at = NULL, fit = NULL WHERE id = ?').run(prevEvent.id);

    db.prepare(
      `UPDATE registrations SET current_stage = ?, status = 'in_progress' WHERE id = ?`
    ).run(prev, reg.id);

    return getReg.get(reg.id);
  });
  return tx();
}

/**
 * Which payload fields the UI must collect before a forward move from
 * `stage` can be submitted. Computed without moving anything.
 */
export function requiredInputsFor(stage) {
  switch (stage) {
    case STAGES.STRIPPING:
      // Leaving stripping: which repair shop and how long it actually took.
      return ['actualHours', 'shopNo'];
    case STAGES.NTXR:
      return ['fit'];
    case STAGES.REPAIR:
      return ['done'];
    default:
      return [];
  }
}

