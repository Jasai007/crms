import { useEffect, useMemo, useState } from 'react';
import { api } from '../api/client.js';
import { useAuth } from '../context/AuthContext.jsx';
import PageHeader from '../components/PageHeader.jsx';
import Modal from '../components/Modal.jsx';

const EMPTY = {
  coach_no: '', railway_zone: '', alloted_base: '', full_brake: '',
  coach_type: '', make: '', category: '', built_date: '',
};

const FIELDS = [
  ['coach_no', 'Coach number', true],
  ['railway_zone', 'Railway zone'],
  ['alloted_base', 'Allotted base'],
  ['full_brake', 'Full brake'],
  ['coach_type', 'Coach type'],
  ['make', 'Make'],
  ['category', 'Category'],
  ['built_date', 'Built date', false, 'date'],
];

export default function Coaches() {
  const { isAdmin } = useAuth();
  const [coaches, setCoaches] = useState([]);
  const [q, setQ] = useState('');
  const [modalOpen, setModalOpen] = useState(false);
  const [editing, setEditing] = useState(null); // coach object or null
  const [form, setForm] = useState(EMPTY);
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);

  const load = () =>
    api.get('/api/coaches').then((d) => setCoaches(d.coaches)).catch((e) => setError(e.message));
  useEffect(() => { load(); }, []);

  // Client-side filtering keeps the table snappy without extra API calls.
  const filtered = useMemo(() => {
    const term = q.trim().toLowerCase();
    if (!term) return coaches;
    return coaches.filter((c) =>
      Object.values(c).some((v) => String(v ?? '').toLowerCase().includes(term))
    );
  }, [coaches, q]);

  const openAdd = () => { setEditing(null); setForm(EMPTY); setError(''); setModalOpen(true); };
  const openEdit = (c) => {
    setEditing(c);
    setForm(Object.fromEntries(Object.keys(EMPTY).map((k) => [k, c[k] ?? ''])));
    setError('');
    setModalOpen(true);
  };

  const set = (k) => (e) => setForm((f) => ({ ...f, [k]: e.target.value }));

  const save = async (e) => {
    e.preventDefault();
    setBusy(true);
    setError('');
    try {
      if (editing) await api.put(`/api/coaches/${editing.id}`, form);
      else await api.post('/api/coaches', form);
      setModalOpen(false);
      await load();
    } catch (err) {
      setError(err.message);
    } finally {
      setBusy(false);
    }
  };

  const remove = async (c) => {
    if (!window.confirm(`Delete coach ${c.coach_no} from the master?`)) return;
    try {
      await api.del(`/api/coaches/${c.id}`);
      await load();
    } catch (err) {
      window.alert(err.message);
    }
  };

  return (
    <div>
      <PageHeader
        title="Coach Management"
        subtitle="Master list of all coaches belonging to the workshop."
        actions={isAdmin && <button className="btn-primary" onClick={openAdd}>+ Add coach</button>}
      />

      <div className="card mb-4 p-4">
        <input
          className="input max-w-md"
          placeholder="Search by number, zone, base, type…"
          value={q}
          onChange={(e) => setQ(e.target.value)}
        />
      </div>

      <div className="card overflow-hidden">
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-slate-200">
            <thead className="bg-slate-50">
              <tr>
                <th className="table-th">Coach no.</th>
                <th className="table-th">Zone</th>
                <th className="table-th">Base</th>
                <th className="table-th">Type</th>
                <th className="table-th">Category</th>
                <th className="table-th">Make</th>
                <th className="table-th">Brake</th>
                <th className="table-th">Built</th>
                <th className="table-th">Status</th>
                {isAdmin && <th className="table-th no-print">Actions</th>}
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-100 bg-white">
              {filtered.map((c) => (
                <tr key={c.id} className="hover:bg-slate-50">
                  <td className="table-td font-semibold">{c.coach_no}</td>
                  <td className="table-td">{c.railway_zone || '—'}</td>
                  <td className="table-td">{c.alloted_base || '—'}</td>
                  <td className="table-td">{c.coach_type || '—'}</td>
                  <td className="table-td">{c.category || '—'}</td>
                  <td className="table-td">{c.make || '—'}</td>
                  <td className="table-td">{c.full_brake || '—'}</td>
                  <td className="table-td">{c.built_date || '—'}</td>
                  <td className="table-td">
                    {c.in_workshop ? (
                      <span className="stage-badge stage-STRIPPING">In workshop</span>
                    ) : (
                      <span className="stage-badge stage-TRAFFIC_OUT">Out</span>
                    )}
                  </td>
                  {isAdmin && (
                    <td className="table-td no-print">
                      <div className="flex gap-2">
                        <button className="text-xs font-semibold text-rail-700 hover:underline" onClick={() => openEdit(c)}>
                          Edit
                        </button>
                        <button className="text-xs font-semibold text-rose-600 hover:underline" onClick={() => remove(c)}>
                          Delete
                        </button>
                      </div>
                    </td>
                  )}
                </tr>
              ))}
              {filtered.length === 0 && (
                <tr>
                  <td className="table-td py-8 text-center text-slate-400" colSpan={isAdmin ? 10 : 9}>
                    No coaches found.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      <Modal title={editing ? `Edit coach ${editing.coach_no}` : 'Add coach'} open={modalOpen} onClose={() => setModalOpen(false)}>
        <form onSubmit={save} className="space-y-3">
          {error && <div className="rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>}
          {FIELDS.map(([key, label, required, type]) => (
            <div key={key}>
              <label className="label">
                {label}{required && <span className="text-rose-500"> *</span>}
              </label>
              <input
                className="input"
                type={type || 'text'}
                value={form[key]}
                onChange={set(key)}
                required={required}
              />
            </div>
          ))}
          <div className="flex justify-end gap-2 pt-2">
            <button type="button" className="btn-secondary" onClick={() => setModalOpen(false)}>Cancel</button>
            <button type="submit" className="btn-primary" disabled={busy}>
              {busy ? 'Saving…' : 'Save'}
            </button>
          </div>
        </form>
      </Modal>
    </div>
  );
}

