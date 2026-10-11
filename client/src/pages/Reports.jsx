import { useEffect, useState } from 'react';
import { api } from '../api/client.js';
import PageHeader from '../components/PageHeader.jsx';
import StageBadge from '../components/StageBadge.jsx';

/**
 * Reports: shop holding (coaches currently in each stage) and full
 * coach history (every registration + stage timeline), both printable.
 */
export default function Reports() {
  const [tab, setTab] = useState('holding');
  return (
    <div>
      <PageHeader
        title="Reports"
        subtitle="Shop holding and per-coach repair history."
        actions={
          <button className="btn-secondary no-print" onClick={() => window.print()}>
            🖨 Print
          </button>
        }
      />
      <div className="mb-4 flex gap-2 no-print">
        {[
          ['holding', 'Shop Holding'],
          ['history', 'Coach History'],
        ].map(([key, label]) => (
          <button
            key={key}
            onClick={() => setTab(key)}
            className={`rounded-lg px-4 py-2 text-sm font-semibold ${
              tab === key ? 'bg-rail-900 text-white' : 'bg-white text-slate-600 border border-slate-200'
            }`}
          >
            {label}
          </button>
        ))}
      </div>
      <div id="print-area">
        {tab === 'holding' ? <HoldingReport /> : <HistoryReport />}
      </div>
    </div>
  );
}

function HoldingReport() {
  const [stages, setStages] = useState([]);
  const [stage, setStage] = useState('ALL');
  const [rows, setRows] = useState([]);
  const [label, setLabel] = useState('All stages');
  const [error, setError] = useState('');

  useEffect(() => {
    api.get('/api/reports/stages').then((d) => setStages(d.stages)).catch(() => {});
  }, []);
  useEffect(() => {
    api
      .get(`/api/reports/holding?stage=${stage}`)
      .then((d) => { setRows(d.holding); setLabel(d.stage_label); })
      .catch((e) => setError(e.message));
  }, [stage]);

  return (
    <div>
      <div className="mb-4 flex flex-wrap items-center gap-3 no-print">
        <label className="label mb-0">Select stage</label>
        <select className="input max-w-xs" value={stage} onChange={(e) => setStage(e.target.value)}>
          {stages.map((s) => (
            <option key={s.value} value={s.value}>{s.label}</option>
          ))}
        </select>
      </div>
      {error && <div className="mb-3 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>}

      <div className="card overflow-hidden">
        <div className="border-b border-slate-100 px-4 py-3">
          <h2 className="font-bold text-slate-800">Shop Holding — {label}</h2>
          <p className="text-xs text-slate-400">Generated {new Date().toLocaleString()}</p>
        </div>
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-slate-200">
            <thead className="bg-slate-50">
              <tr>
                <th className="table-th">Coach no.</th>
                <th className="table-th">Zone</th>
                <th className="table-th">Base</th>
                <th className="table-th">Type</th>
                <th className="table-th">Repair</th>
                <th className="table-th">Workshop in</th>
                <th className="table-th">Est. hrs</th>
                <th className="table-th">Stage</th>
                <th className="table-th">Days in stage</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-100 bg-white">
              {rows.map((r) => (
                <tr key={r.id} className="hover:bg-slate-50">
                  <td className="table-td font-semibold">{r.coach_no}</td>
                  <td className="table-td">{r.railway_zone || '—'}</td>
                  <td className="table-td">{r.alloted_base || '—'}</td>
                  <td className="table-td">{r.coach_type || '—'}</td>
                  <td className="table-td">{r.repair_type}</td>
                  <td className="table-td">{r.workshop_in}</td>
                  <td className="table-td">{r.estimated_hours}</td>
                  <td className="table-td"><StageBadge stage={r.current_stage} /></td>
                  <td className="table-td">{r.days_in_stage ?? '—'}</td>
                </tr>
              ))}
              {rows.length === 0 && (
                <tr>
                  <td className="table-td py-8 text-center text-slate-400" colSpan={9}>
                    No coaches in this stage.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}

function HistoryReport() {
  const [coachNo, setCoachNo] = useState('');
  const [result, setResult] = useState(null);
  const [error, setError] = useState('');

  const search = async (e) => {
    e.preventDefault();
    if (!coachNo.trim()) return;
    setError('');
    setResult(null);
    try {
      const d = await api.get(`/api/reports/history/${encodeURIComponent(coachNo.trim())}`);
      setResult(d);
      if (!d.coach && d.registrations.length === 0) {
        setError(`No records found for coach ${coachNo.trim()}`);
      }
    } catch (err) {
      setError(err.message);
    }
  };

  return (
    <div>
      <form onSubmit={search} className="mb-4 flex flex-wrap items-end gap-3 no-print">
        <div>
          <label className="label">Coach number</label>
          <input
            className="input"
            value={coachNo}
            onChange={(e) => setCoachNo(e.target.value)}
            placeholder="e.g. 8250"
          />
        </div>
        <button type="submit" className="btn-primary">Search history</button>
      </form>
      {error && <div className="mb-3 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700">{error}</div>}

      {result && (
        <div className="space-y-4">
          {/* Coach master card */}
          {result.coach && (
            <div className="card p-4">
              <h2 className="font-bold text-slate-800">Coach {result.coach.coach_no}</h2>
              <div className="mt-2 grid grid-cols-2 gap-x-6 gap-y-1 text-sm text-slate-600 sm:grid-cols-4">
                <span><strong>Zone:</strong> {result.coach.railway_zone || '—'}</span>
                <span><strong>Base:</strong> {result.coach.alloted_base || '—'}</span>
                <span><strong>Type:</strong> {result.coach.coach_type || '—'}</span>
                <span><strong>Category:</strong> {result.coach.category || '—'}</span>
                <span><strong>Make:</strong> {result.coach.make || '—'}</span>
                <span><strong>Brake:</strong> {result.coach.full_brake || '—'}</span>
                <span><strong>Built:</strong> {result.coach.built_date || '—'}</span>
              </div>
            </div>
          )}

          {/* Every registration with its stage timeline */}
          {result.registrations.map((reg) => (
            <div key={reg.id} className="card overflow-hidden">
              <div className="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 px-4 py-3">
                <div>
                  <h3 className="font-bold text-slate-800">
                    Registration #{reg.id} · {reg.repair_type}
                  </h3>
                  <p className="text-xs text-slate-400">
                    Workshop in {reg.workshop_in} · {reg.estimated_hours} est. hrs
                  </p>
                </div>
                <div className="flex items-center gap-2">
                  <StageBadge stage={reg.current_stage} label={reg.stage_label} />
                  <span className={`text-xs font-semibold ${reg.status === 'released' ? 'text-emerald-600' : 'text-amber-600'}`}>
                    {reg.status === 'released' ? 'Released' : 'In workshop'}
                  </span>
                </div>
              </div>
              <div className="overflow-x-auto">
                <table className="min-w-full divide-y divide-slate-200">
                  <thead className="bg-slate-50">
                    <tr>
                      <th className="table-th">Stage</th>
                      <th className="table-th">In</th>
                      <th className="table-th">Out</th>
                      <th className="table-th">Days</th>
                      <th className="table-th">Actual hrs</th>
                      <th className="table-th">Shop</th>
                      <th className="table-th">Fit</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-slate-100 bg-white">
                    {reg.events.map((ev) => (
                      <tr key={ev.id}>
                        <td className="table-td"><StageBadge stage={ev.stage} label={ev.stage_label} /></td>
                        <td className="table-td">{ev.in_at}</td>
                        <td className="table-td">{ev.out_at || '(open)'}</td>
                        <td className="table-td">{ev.duration_days ?? '—'}</td>
                        <td className="table-td">{ev.actual_hours ?? '—'}</td>
                        <td className="table-td">{ev.shop_no ?? '—'}</td>
                        <td className="table-td">{ev.fit ?? '—'}</td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}

