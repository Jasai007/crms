import { useEffect, useState } from 'react';
import { api } from '../api/client.js';
import { useAuth } from '../context/AuthContext.jsx';
import PageHeader from '../components/PageHeader.jsx';
import Modal from '../components/Modal.jsx';
import StageBadge from '../components/StageBadge.jsx';

const EMPTY = { coach_no: '', repair_type: 'POH', workshop_in: '', estimated_hours: '' };

export default function Registrations() {
  const { isAdmin } = useAuth();
  const [regs, setRegs] = useState([]);
  const [coaches, setCoaches] = useState([]);
  const [statusFilter, setStatusFilter] = useState('in_progress');
  const [modalOpen, setModalOpen] = useState(false);
  const [form, setForm] = useState(EMPTY);
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);
  const [toast, setToast] = useState('');

  const load = () =>
    api
      .get(`/api/registrations${statusFilter ? `?status=${statusFilter}` : ''}`)
      .then((d) => setRegs(d.registrations))
      .catch((e) => setError(e.message));

  useEffect(() => { load(); }, [statusFilter]);
  useEffect(() => {
    api.get('/api/coaches').then((d) => setCoaches(d.coaches)).catch(() => {});
  }, []);

  // Only idle coaches can be registered (mirrors legacy coachreg checks).
  const availableCoaches = coaches.filter((c) => !c.in_workshop);

  const set = (k) => (e) => setForm((f) => ({ ...f, [k]: e.target.value }));

  const save = async (e) => {
    e.preventDefault();
    setBusy(true);
    setError('');
    try {
      await api.post('/api/registrations', { ...form, estimated_hours: Number(form.estimated_hours) });
      setModalOpen(false);
      setForm(EMPTY);
      setToast('Coach registered for repair.');
      await load();
    } catch (err) {
      setError(err.message);
    } finally {
      setBusy(false);
    }
  };

  return (
    <div>
      <PageHeader
        title="Registration"
        subtitle="Register a coach into the workshop for repair / maintenance."
        actions={
          isAdmin && (
            <button className="btn-primary" onClick={() => { setError(''); setModalOpen(true); }}>
              + Register coach
            </button>
          )
        }
      />

      {toast && (
        <div className="mb-4 flex items-center justify-between rounded-lg bg-emerald-50 px-4 py-2 text-sm text-emerald-800">
          {toast}
          <button className="font-bold" onClick={() => setToast('')}>×</button>
        </div>
      )}

      <div className="card mb-4 flex flex-wrap items-center gap-3 p-4">
        <label className="label mb-0">Status</label>
        <select className="input max-w-xs" value={statusFilter} onChange={(e) => setStatusFilter(e.target.value)}>
          <option value="in_progress">In progress</option>
          <option value="released">Released</option>
          <option value="">All</option>
        </select>
        <span className="text-sm text-slate-500">{regs.length} registration(s)</span>
      </div>

      <div className="card overflow-hidden">
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-slate-200">
            <thead className="bg-slate-50">
              <tr>
                <th className="table-th">ID</th>
                <th className="table-th">Coach no.</th>
                <th className="table-th">Type</th>
                <th className="table-th">Workshop in</th>
                <th className="table-th">Est. hours</th>
                <th className="table-th">Current stage</th>
                <th className="table-th">Stage since</th>
                <th className="table-th">Status</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-100 bg-white">
              {regs.map((r) => (
                <tr key={r.id} className="hover:bg-slate-50">
                  <td className="table-td text-slate-500">#{r.id}</td>
                  <td className="table-td font-semibold">{r.coach_no}</td>
                  <td className="table-td">{r.repair_type}</td>
                  <td className="table-td">{r.workshop_in}</td>
                  <td className="table-td">{r.estimated_hours}</td>
                  <td className="table-td"><StageBadge stage={r.current_stage} label={r.stage_label} /></td>
                  <td className="table-td">{r.stage_in_at || '—'}</td>
                  <td className="table-td">
                    <span className={r.status === 'released' ? 'text-emerald-600' : 'text-amber-600'}>
                      {r.status === 'released' ? 'Released' : 'In workshop'}
                    </span>
                  </td>
                </tr>
              ))}
              {regs.length === 0 && (
                <tr>
                  <td className="table-td py-8 text-center text-slate-400" colSpan={8}>
                    No registrations found.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      <Modal title="Register coach for repair" open={modalOpen} onClose={() => setModalOpen(false)}>
        <form onSubmit={save} className="space-y-3">
          {error && <div className="rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>}
          <div>
            <label className="label">Coach <span className="text-rose-500">*</span></label>
            <select className="input" value={form.coach_no} onChange={set('coach_no')} required>
              <option value="">Select an idle coach…</option>
              {availableCoaches.map((c) => (
                <option key={c.id} value={c.coach_no}>
                  {c.coach_no} — {c.coach_type || 'n/a'} {c.category ? `(${c.category})` : ''}
                </option>
              ))}
            </select>
            {availableCoaches.length === 0 && (
              <p className="mt-1 text-xs text-rose-600">All coaches in the master are already in the workshop.</p>
            )}
          </div>
          <div>
            <label className="label">Repair type <span className="text-rose-500">*</span></label>
            <select className="input" value={form.repair_type} onChange={set('repair_type')} required>
              <option>MCR</option>
              <option>HCR</option>
              <option>POH</option>
            </select>
          </div>
          <div>
            <label className="label">Workshop-in date <span className="text-rose-500">*</span></label>
            <input className="input" type="date" value={form.workshop_in} onChange={set('workshop_in')} required />
          </div>
          <div>
            <label className="label">Estimated hours <span className="text-rose-500">*</span></label>
            <input className="input" type="number" min="0" value={form.estimated_hours} onChange={set('estimated_hours')} required />
          </div>
          <div className="flex justify-end gap-2 pt-2">
            <button type="button" className="btn-secondary" onClick={() => setModalOpen(false)}>Cancel</button>
            <button type="submit" className="btn-primary" disabled={busy || !availableCoaches.length}>
              {busy ? 'Saving…' : 'Register'}
            </button>
          </div>
        </form>
      </Modal>
    </div>
  );
}

