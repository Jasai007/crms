import { useCallback, useEffect, useState } from 'react';
import { api } from '../api/client.js';
import { useAuth } from '../context/AuthContext.jsx';
import PageHeader from '../components/PageHeader.jsx';
import Modal from '../components/Modal.jsx';
import StageBadge from '../components/StageBadge.jsx';

/**
 * Kanban board of the workshop floor. Columns mirror the legacy
 * shop tables; coaches are cards that admins move forward/backward.
 */
const COLUMNS = [
  { key: 'REGISTERED', title: 'Registered' },
  { key: 'STRIPPING', title: 'Stripping & Inspection' },
  { key: 'REPAIR_SHOPS', title: 'Repair Shops', stages: ['POH', 'MCR', 'HCR'] },
  { key: 'PAINTING', title: 'Paint Shop' },
  { key: 'LIFTING', title: 'Lifting Shop' },
  { key: 'BRAKE', title: 'Brake Shop' },
  { key: 'NTXR', title: 'Pit Line (NTXR)' },
  { key: 'REPAIR', title: 'Repair Loop' },
  { key: 'TRAFFIC_OUT', title: 'Traffic Out' },
];

const STAGE_TITLES = {
  REGISTERED: 'Registered', STRIPPING: 'Stripping & Inspection', POH: 'POH Shop',
  MCR: 'MCR Shop', HCR: 'HCR Shop', PAINTING: 'Paint Shop', LIFTING: 'Lifting Shop',
  BRAKE: 'Brake Shop', NTXR: 'Pit Line (NTXR)', REPAIR: 'Repair Shop',
  TRAFFIC_OUT: 'Traffic Out',
};

export default function Maintenance() {
  const { isAdmin } = useAuth();
  const [regs, setRegs] = useState([]);
  const [shops, setShops] = useState([]);
  const [selected, setSelected] = useState(null); // registration being moved
  const [detail, setDetail] = useState(null);     // { registration, events }
  const [form, setForm] = useState({ actualHours: '', shopNo: '', fit: '', done: false });
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);
  const [toast, setToast] = useState('');

  const load = () =>
    api
      .get('/api/registrations')
      .then((d) => setRegs(d.registrations))
      .catch((e) => setError(e.message));

  useEffect(() => {
    load();
    api.get('/api/registrations/meta/stages').then((d) => setShops(d.shops)).catch(() => {});
  }, []);

  const columns = COLUMNS.map((col) => ({
    ...col,
    cards: regs.filter((r) =>
      col.stages ? col.stages.includes(r.current_stage) : r.current_stage === col.key
    ),
  }));

  const openCard = (r) => {
    setError('');
    setForm({ actualHours: '', shopNo: '', fit: '', done: false });
    setSelected(r);
    api
      .get(`/api/registrations/${r.id}`)
      .then(setDetail)
      .catch(() => setDetail(null));
  };

  const move = async (direction) => {
    setBusy(true);
    setError('');
    try {
      const body = { direction };
      if (direction === 'forward') {
        if (Number.isInteger(form.actualHours !== '' ? Number(form.actualHours) : undefined)) {
          body.actualHours = Number(form.actualHours);
        }
        if (form.shopNo !== '') body.shopNo = Number(form.shopNo);
        if (form.fit !== '') body.fit = form.fit;
        if (selected.required_inputs.includes('done')) body.done = form.done;
      }
      const d = await api.post(`/api/registrations/${selected.id}/move`, body);
      setToast(
        `Coach ${selected.coach_no} moved to ${STAGE_TITLES[d.registration.current_stage]}.`
      );
      setSelected(null);
      setDetail(null);
      await load();
    } catch (err) {
      setError(err.message);
    } finally {
      setBusy(false);
    }
  };

  const needsInputs = selected?.required_inputs || [];
  const needsHours = needsInputs.includes('actualHours');
  const needsShop = needsInputs.includes('shopNo');
  const needsFit = needsInputs.includes('fit');
  const needsDone = needsInputs.includes('done');
  const forwardReady =
    (!needsHours || form.actualHours !== '') &&
    (!needsShop || form.shopNo !== '') &&
    (!needsFit || form.fit !== '');

  return (
    <div>
      <PageHeader
        title="Maintenance"
        subtitle="Live shop floor. Select a coach card to move it forward or back."
      />

      {toast && (
        <div className="mb-4 flex items-center justify-between rounded-lg bg-emerald-50 px-4 py-2 text-sm text-emerald-800">
          {toast}
          <button className="font-bold" onClick={() => setToast('')}>×</button>
        </div>
      )}
      {error && !selected && (
        <div className="mb-4 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>
      )}

      {/* Horizontal scroll board; snap keeps it usable on touch screens. */}
      <div className="-mx-4 flex snap-x gap-4 overflow-x-auto px-4 pb-4 lg:mx-0 lg:px-0">
        {columns.map((col) => (
          <section
            key={col.key}
            className="card w-72 flex-none snap-start"
            aria-label={col.title}
          >
            <header className="border-b border-slate-100 px-4 py-3">
              <h2 className="text-sm font-bold text-slate-800">{col.title}</h2>
              <span className="text-xs text-slate-400">{col.cards.length} coach(es)</span>
            </header>
            <div className="min-h-[6rem] space-y-2 p-3">
              {col.cards.map((r) => (
                <button
                  key={r.id}
                  onClick={() => openCard(r)}
                  className="w-full rounded-lg border border-slate-200 bg-slate-50 p-3 text-left transition hover:border-rail-400 hover:bg-rail-50"
                >
                  <div className="flex items-center justify-between">
                    <span className="font-bold text-slate-800">{r.coach_no}</span>
                    <span className="text-xs text-slate-400">#{r.id}</span>
                  </div>
                  <div className="mt-1 flex flex-wrap items-center gap-1 text-xs text-slate-500">
                    <span>{r.repair_type}</span>
                    <span>·</span>
                    <span>{r.stage_in_at || r.workshop_in}</span>
                  </div>
                  {col.stages && (
                    <div className="mt-1">
                      <StageBadge stage={r.current_stage} label={r.stage_label} />
                    </div>
                  )}
                </button>
              ))}
              {col.cards.length === 0 && (
                <p className="py-4 text-center text-xs text-slate-400">Empty</p>
              )}
            </div>
          </section>
        ))}
      </div>

      {/* Move dialog: extra inputs appear only when the stage requires them. */}
      <Modal
        title={selected ? `Coach ${selected.coach_no} — ${selected.stage_label}` : ''}
        open={!!selected}
        onClose={() => { setSelected(null); setDetail(null); setError(''); }}
      >
        {selected && (
          <div className="space-y-4">
            <div className="rounded-lg bg-slate-50 p-3 text-sm text-slate-600">
              <div className="flex flex-wrap gap-x-6 gap-y-1">
                <span><strong>Type:</strong> {selected.repair_type}</span>
                <span><strong>Workshop in:</strong> {selected.workshop_in}</span>
                <span><strong>Est. hours:</strong> {selected.estimated_hours}</span>
              </div>
            </div>

            {/* Timeline */}
            {detail && (
              <div>
                <h3 className="label">Timeline</h3>
                <ol className="space-y-1 text-xs text-slate-600">
                  {detail.events.map((e) => (
                    <li key={e.id} className="flex items-center justify-between">
                      <StageBadge stage={e.stage} label={e.stage_label} />
                      <span>
                        {e.in_at}{e.out_at ? ` → ${e.out_at}` : ' → (open)'}
                        {e.fit ? ` · fit ${e.fit}` : ''}
                      </span>
                    </li>
                  ))}
                </ol>
              </div>
            )}

            {error && <div className="rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>}

            {isAdmin ? (
              <>
                {/* Stage-specific inputs */}
                {needsHours && (
                  <div>
                    <label className="label">Actual hours <span className="text-rose-500">*</span></label>
                    <input
                      className="input" type="number" min="0"
                      value={form.actualHours}
                      onChange={(e) => setForm((f) => ({ ...f, actualHours: e.target.value }))}
                    />
                  </div>
                )}
                {needsShop && (
                  <div>
                    <label className="label">Repair shop <span className="text-rose-500">*</span></label>
                    <select
                      className="input"
                      value={form.shopNo}
                      onChange={(e) => setForm((f) => ({ ...f, shopNo: e.target.value }))}
                    >
                      <option value="">Select shop…</option>
                      {shops.map((s) => (
                        <option key={s.shopNo} value={s.shopNo}>{s.label}</option>
                      ))}
                    </select>
                  </div>
                )}
                {needsFit && (
                  <div>
                    <label className="label">Pit-line inspection result <span className="text-rose-500">*</span></label>
                    <div className="flex gap-3">
                      {['YES', 'NO'].map((v) => (
                        <label key={v} className="flex items-center gap-2 text-sm">
                          <input
                            type="radio" name="fit" value={v}
                            checked={form.fit === v}
                            onChange={(e) => setForm((f) => ({ ...f, fit: e.target.value }))}
                          />
                          {v === 'YES' ? 'Fit — release to traffic' : 'Not fit — send to repair'}
                        </label>
                      ))}
                    </div>
                  </div>
                )}
                {needsDone && (
                  <label className="flex items-center gap-2 text-sm">
                    <input
                      type="checkbox"
                      checked={form.done}
                      onChange={(e) => setForm((f) => ({ ...f, done: e.target.checked }))}
                    />
                    Repairs complete — release coach directly to traffic
                  </label>
                )}

                <div className="flex flex-wrap justify-between gap-2 pt-2">
                  <button
                    className="btn-secondary"
                    disabled={busy || !selected.can_go_back}
                    onClick={() => move('backward')}
                    title={selected.can_go_back ? '' : 'No earlier stage'}
                  >
                    ← Back
                  </button>
                  <button className="btn-success" disabled={busy || !forwardReady} onClick={() => move('forward')}>
                    {busy ? 'Moving…' : 'Forward →'}
                  </button>
                </div>
              </>
            ) : (
              <p className="rounded-lg bg-slate-100 px-3 py-2 text-sm text-slate-600">
                View only — ask an admin to move coaches.
              </p>
            )}
          </div>
        )}
      </Modal>
    </div>
  );
}


