import { useEffect, useState } from 'react';
import { api } from '../api/client.js';
import { useAuth } from '../context/AuthContext.jsx';
import PageHeader from '../components/PageHeader.jsx';
import Modal from '../components/Modal.jsx';

const EMPTY = {
  username: '', password: '', role: 'viewer',
  firstname: '', lastname: '', email: '', doj: '',
};

export default function Users() {
  const { user: me, isAdmin } = useAuth();
  const [users, setUsers] = useState([]);
  const [q, setQ] = useState('');
  const [modalOpen, setModalOpen] = useState(false);
  const [form, setForm] = useState(EMPTY);
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);

  const load = () =>
    api.get(`/api/users${q ? `?q=${encodeURIComponent(q)}` : ''}`)
      .then((d) => setUsers(d.users))
      .catch((e) => setError(e.message));

  useEffect(() => {
    const t = setTimeout(load, 250); // debounce typing
    return () => clearTimeout(t);
  }, [q]);

  if (!isAdmin) {
    return (
      <div className="card p-8 text-center text-slate-500">
        User management is restricted to admins.
      </div>
    );
  }

  const set = (k) => (e) => setForm((f) => ({ ...f, [k]: e.target.value }));

  const save = async (e) => {
    e.preventDefault();
    setBusy(true);
    setError('');
    try {
      await api.post('/api/users', form);
      setModalOpen(false);
      setForm(EMPTY);
      await load();
    } catch (err) {
      setError(err.message);
    } finally {
      setBusy(false);
    }
  };

  const changeRole = async (u, role) => {
    try {
      await api.put(`/api/users/${u.id}/role`, { role });
      await load();
    } catch (err) {
      window.alert(err.message);
    }
  };

  const remove = async (u) => {
    if (!window.confirm(`Delete user ${u.username}?`)) return;
    try {
      await api.del(`/api/users/${u.id}`);
      await load();
    } catch (err) {
      window.alert(err.message);
    }
  };

  return (
    <div>
      <PageHeader
        title="Users"
        subtitle="Add, remove and promote workshop users."
        actions={<button className="btn-primary" onClick={() => { setError(''); setModalOpen(true); }}>+ Add user</button>}
      />

      <div className="card mb-4 p-4">
        <input
          className="input max-w-md"
          placeholder="Search username, name, email, DOJ…"
          value={q}
          onChange={(e) => setQ(e.target.value)}
        />
      </div>

      {error && !modalOpen && (
        <div className="mb-4 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>
      )}

      <div className="card overflow-hidden">
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-slate-200">
            <thead className="bg-slate-50">
              <tr>
                <th className="table-th">ID</th>
                <th className="table-th">Username</th>
                <th className="table-th">Name</th>
                <th className="table-th">Email</th>
                <th className="table-th">DOJ</th>
                <th className="table-th">Role</th>
                <th className="table-th">Actions</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-100 bg-white">
              {users.map((u) => (
                <tr key={u.id} className="hover:bg-slate-50">
                  <td className="table-td text-slate-500">{u.id}</td>
                  <td className="table-td font-semibold">{u.username}</td>
                  <td className="table-td">{u.firstname} {u.lastname}</td>
                  <td className="table-td">{u.email}</td>
                  <td className="table-td">{u.doj}</td>
                  <td className="table-td">
                    <span className={`stage-badge ${u.role === 'admin' ? 'stage-NTXR' : 'stage-REGISTERED'}`}>
                      {u.role}
                    </span>
                  </td>
                  <td className="table-td">
                    {u.id === me.id ? (
                      <span className="text-xs text-slate-400">You</span>
                    ) : (
                      <div className="flex gap-2">
                        <button
                          className="text-xs font-semibold text-rail-700 hover:underline"
                          onClick={() => changeRole(u, u.role === 'admin' ? 'viewer' : 'admin')}
                        >
                          {u.role === 'admin' ? 'Demote' : 'Promote'}
                        </button>
                        <button
                          className="text-xs font-semibold text-rose-600 hover:underline"
                          onClick={() => remove(u)}
                        >
                          Delete
                        </button>
                      </div>
                    )}
                  </td>
                </tr>
              ))}
              {users.length === 0 && (
                <tr>
                  <td className="table-td py-8 text-center text-slate-400" colSpan={7}>
                    No users found.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>


      <Modal title="Add user" open={modalOpen} onClose={() => setModalOpen(false)}>
        <form onSubmit={save} className="space-y-3">
          {error && <div className="rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>}
          <div className="grid grid-cols-1 gap-3 sm:grid-cols-2">
            <div>
              <label className="label">Username <span className="text-rose-500">*</span></label>
              <input className="input" value={form.username} onChange={set('username')} minLength={3} required />
            </div>
            <div>
              <label className="label">Password <span className="text-rose-500">*</span></label>
              <input className="input" type="password" value={form.password} onChange={set('password')} minLength={4} required />
            </div>
            <div>
              <label className="label">First name <span className="text-rose-500">*</span></label>
              <input className="input" value={form.firstname} onChange={set('firstname')} required />
            </div>
            <div>
              <label className="label">Last name <span className="text-rose-500">*</span></label>
              <input className="input" value={form.lastname} onChange={set('lastname')} required />
            </div>
            <div>
              <label className="label">Email <span className="text-rose-500">*</span></label>
              <input className="input" type="email" value={form.email} onChange={set('email')} required />
            </div>
            <div>
              <label className="label">Date of joining <span className="text-rose-500">*</span></label>
              <input className="input" type="date" value={form.doj} onChange={set('doj')} required />
            </div>
          </div>
          <div>
            <label className="label">Role</label>
            <select className="input" value={form.role} onChange={set('role')}>
              <option value="viewer">Viewer (read-only)</option>
              <option value="admin">Admin (full access)</option>
            </select>
          </div>
          <div className="flex justify-end gap-2 pt-2">
            <button type="button" className="btn-secondary" onClick={() => setModalOpen(false)}>Cancel</button>
            <button type="submit" className="btn-primary" disabled={busy}>
              {busy ? 'Saving…' : 'Add user'}
            </button>
          </div>
        </form>
      </Modal>
    </div>
  );
}

