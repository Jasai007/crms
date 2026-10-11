import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { api } from '../api/client.js';
import { useAuth } from '../context/AuthContext.jsx';
import PageHeader from '../components/PageHeader.jsx';
import StageBadge from '../components/StageBadge.jsx';

function StatCard({ label, value, accent }) {
  return (
    <div className="card p-5">
      <div className="text-xs font-semibold uppercase tracking-wide text-slate-500">{label}</div>
      <div className={`mt-2 text-3xl font-bold ${accent || 'text-rail-900'}`}>{value}</div>
    </div>
  );
}

export default function Dashboard() {
  const { user, isAdmin } = useAuth();
  const [stats, setStats] = useState(null);
  const [recent, setRecent] = useState([]);
  const [error, setError] = useState('');

  useEffect(() => {
    Promise.all([api.get('/api/reports/stats'), api.get('/api/registrations?status=in_progress')])
      .then(([s, r]) => {
        setStats(s);
        setRecent(r.registrations.slice(0, 8));
      })
      .catch((e) => setError(e.message));
  }, []);

  return (
    <div>
      <PageHeader
        title={`Welcome, ${user.firstname || user.username}`}
        subtitle="Overview of the workshop floor right now."
      />
      {error && <div className="mb-4 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>}

      {stats && (
        <>
          <div className="grid grid-cols-2 gap-4 lg:grid-cols-4">
            <StatCard label="Coaches in master" value={stats.coaches} />
            <StatCard label="In workshop" value={stats.inProgress} accent="text-amber-600" />
            <StatCard label="Released to traffic" value={stats.released} accent="text-emerald-600" />
            <StatCard label="Users" value={stats.users} accent="text-slate-600" />
          </div>

          <div className="mt-6 grid gap-6 lg:grid-cols-2">
            {/* Stage-wise breakdown */}
            <div className="card p-5">
              <h2 className="mb-3 font-bold text-slate-800">Coaches by workshop stage</h2>
              {stats.byStage.length === 0 ? (
                <p className="text-sm text-slate-500">No coaches in the workshop.</p>
              ) : (
                <ul className="space-y-2">
                  {stats.byStage.map((s) => (
                    <li key={s.stage} className="flex items-center justify-between text-sm">
                      <StageBadge stage={s.stage} label={s.label} />
                      <span className="font-semibold text-slate-700">{s.count}</span>
                    </li>
                  ))}
                </ul>
              )}
              <div className="mt-4">
                <Link to="/maintenance" className="text-sm font-semibold text-rail-700 hover:underline">
                  Open maintenance board →
                </Link>
              </div>
            </div>

            {/* Recent registrations */}
            <div className="card p-5">
              <h2 className="mb-3 font-bold text-slate-800">Active registrations</h2>
              {recent.length === 0 ? (
                <p className="text-sm text-slate-500">Nothing registered yet.</p>
              ) : (
                <ul className="divide-y divide-slate-100">
                  {recent.map((r) => (
                    <li key={r.id} className="flex items-center justify-between py-2 text-sm">
                      <div>
                        <span className="font-semibold text-slate-800">Coach {r.coach_no}</span>
                        <span className="ml-2 text-slate-500">· {r.repair_type}</span>
                      </div>
                      <StageBadge stage={r.current_stage} label={r.stage_label} />
                    </li>
                  ))}
                </ul>
              )}
              <div className="mt-4">
                <Link to="/registrations" className="text-sm font-semibold text-rail-700 hover:underline">
                  All registrations →
                </Link>
              </div>
            </div>
          </div>

          {!isAdmin && (
            <p className="mt-6 rounded-lg bg-slate-100 px-4 py-3 text-sm text-slate-600">
              You are signed in as a <strong>viewer</strong>. You can browse all data, but only
              admins can move coaches or edit records.
            </p>
          )}
        </>
      )}
    </div>
  );
}
