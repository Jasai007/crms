import { useState } from 'react';
import { Link, Navigate, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext.jsx';

export default function Register() {
  const { user, register } = useAuth();
  const navigate = useNavigate();
  const [form, setForm] = useState({
    username: '', password: '', firstname: '', lastname: '', email: '', doj: '',
  });
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);

  if (user) return <Navigate to="/" replace />;

  const set = (k) => (e) => setForm((f) => ({ ...f, [k]: e.target.value }));

  const onSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setBusy(true);
    try {
      await register(form);
      navigate('/');
    } catch (err) {
      setError(err.message);
    } finally {
      setBusy(false);
    }
  };

  return (
    <div className="flex min-h-screen items-center justify-center bg-gradient-to-br from-rail-950 via-rail-900 to-rail-700 p-4">
      <div className="w-full max-w-md">
        <div className="card p-8">
          <div className="mb-4 flex items-center justify-center gap-3">
            <img src="/indian_rly_logo.png" alt="Indian Railways" className="h-10 w-10 rounded-full bg-white object-contain p-0.5" />
            <h1 className="text-lg font-bold text-rail-900">Create your account</h1>
          </div>
          <p className="mb-4 text-center text-xs text-slate-500">
            Self-registration creates a <strong>viewer</strong> account (read-only).
            Contact an admin to be upgraded.
          </p>

          <form onSubmit={onSubmit} className="space-y-3">
            {error && (
              <div className="rounded-lg bg-rose-50 px-3 py-2 text-sm font-medium text-rose-700">
                {error}
              </div>
            )}
            <div>
              <label className="label">Username</label>
              <input className="input" value={form.username} onChange={set('username')} minLength={3} required />
            </div>
            <div>
              <label className="label">Password</label>
              <input className="input" type="password" value={form.password} onChange={set('password')} minLength={4} required />
            </div>
            <div className="grid grid-cols-1 gap-3 sm:grid-cols-2">
              <div>
                <label className="label">First name</label>
                <input className="input" value={form.firstname} onChange={set('firstname')} required />
              </div>
              <div>
                <label className="label">Last name</label>
                <input className="input" value={form.lastname} onChange={set('lastname')} required />
              </div>
            </div>
            <div>
              <label className="label">Email</label>
              <input className="input" type="email" value={form.email} onChange={set('email')} required />
            </div>
            <div>
              <label className="label">Date of joining</label>
              <input className="input" type="date" value={form.doj} onChange={set('doj')} required />
            </div>
            <button type="submit" className="btn-primary w-full" disabled={busy}>
              {busy ? 'Creating…' : 'Register'}
            </button>
          </form>

          <p className="mt-4 text-center text-sm text-slate-500">
            Already registered?{' '}
            <Link to="/login" className="font-semibold text-rail-700 hover:underline">
              Sign in
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
}
