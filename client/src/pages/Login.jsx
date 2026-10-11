import { useState } from 'react';
import { Link, Navigate, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext.jsx';

export default function Login() {
  const { user, login } = useAuth();
  const navigate = useNavigate();
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);

  if (user) return <Navigate to="/" replace />;

  const onSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setBusy(true);
    try {
      await login(username, password);
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
        {/* Branding */}
        <div className="mb-6 flex items-center justify-center gap-4">
          <img src="/indian_rly_logo.png" alt="Indian Railways" className="h-14 w-14 rounded-full bg-white object-contain p-1" />
          <img src="/serly_logo.jpg" alt="South Eastern Railway" className="h-14 w-14 rounded-full bg-white object-contain" />
        </div>
        <div className="card p-8">
          <h1 className="text-center text-xl font-bold text-rail-900">
            South Eastern Railway Workshop, Kharagpur
          </h1>
          <p className="mt-1 text-center text-sm font-semibold uppercase tracking-wide text-slate-500">
            Coach Repair &amp; Management System
          </p>

          <form onSubmit={onSubmit} className="mt-6 space-y-4">
            {error && (
              <div className="rounded-lg bg-rose-50 px-3 py-2 text-sm font-medium text-rose-700">
                {error}
              </div>
            )}
            <div>
              <label className="label" htmlFor="username">Username</label>
              <input
                id="username"
                className="input"
                value={username}
                onChange={(e) => setUsername(e.target.value)}
                placeholder="Enter username"
                autoFocus
                required
              />
            </div>
            <div>
              <label className="label" htmlFor="password">Password</label>
              <input
                id="password"
                type="password"
                className="input"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="Enter password"
                required
              />
            </div>
            <button type="submit" className="btn-primary w-full" disabled={busy}>
              {busy ? 'Signing in…' : 'Sign in'}
            </button>
          </form>

          <p className="mt-6 text-center text-sm text-slate-500">
            New user?{' '}
            <Link to="/register" className="font-semibold text-rail-700 hover:underline">
              Register here
            </Link>
          </p>
        </div>
        <p className="mt-4 text-center text-xs text-rail-200">
          Demo: admin <code>jasai007 / jasai</code> · viewer <code>monty99 / monty</code>
        </p>
      </div>
    </div>
  );
}
