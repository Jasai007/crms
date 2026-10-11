/** Coloured pill for a workshop stage; falls back to plain for unknown. */
export default function StageBadge({ stage, label }) {
  if (!stage) return <span className="text-slate-400">—</span>;
  return (
    <span className={`stage-badge stage-${stage}`}>{label || stage}</span>
  );
}
