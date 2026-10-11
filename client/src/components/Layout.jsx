import { useState } from 'react';
import { NavLink, Outlet, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext.jsx';

const NAV = [
  { to: '/', label: 'Dashboard', icon: '📊', end: true },
  { to: '/coaches', label: 'Coach Management', icon: '🚋' },
  { to: '/registrations', label: 'Registration', icon: '📝' },
  { to: '/maintenance', label: 'Maintenance', icon: '🔧' },
  { to: '/reports', label: 'Reports', icon: '📈' },
  { to: '/users', label: 'Users', icon: '👥', adminOnly: true },
];

/**
 * App shell: fixed sidebar on desktop, slide-over drawer on mobile.
 */
export default function Layout() {
  const { user, isAdmin, logout } = useAuth();
  const [open, setOpen] = useState(false);
  const navigate = useNavigate();

  const items = NAV.filter((n) => !n.adminOnly || isAdmin);

  const handleLogout = async () => {
    await logout();
    navigate('/login');
  };

  const navLinks = items.map((n) => (
    <NavLink
      key={n.to}
      to={n.to}
      end={n.end}
      onClick={() => setOpen(false)}
      className={({ isActive }) =>
        `flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition-colors ${
          isActive
            ? 'bg-rail-800 text-white'
            : 'text-rail-100 hover:bg-rail-700 hover:text-white'
        }`
      }
    >
      <span aria-hidden>{n.icon}</span>
      {n.label}
    </NavLink>
  ));

  return (
    <div className="min-h-screen">
      {/* Mobile top bar */}
      <header className="sticky top-0 z-30 flex items-center justify-between bg-rail-900 px-4 py-3 text-white lg:hidden">
        <div className="flex items-center gap-2">
          <img src="/indian_rly_logo.png" alt="" className="h-8 w-8 rounded bg-white object-contain p-0.5" />
          <span className="font-bold">CRMS</span>
        </div>
        <button
          onClick={() => setOpen((v) => !v)}
          className="rounded-lg p-2 hover:bg-rail-700"
          aria-label="Toggle navigation"
        >
          <svg className="h-6 w-6" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
            {open ? (
              <path strokeLinecap="round" d="M6 18L18 6M6 6l12 12" />
            ) : (
              <path strokeLinecap="round" d="M4 6h16M4 12h16M4 18h16" />
            )}
          </svg>
        </button>
      </header>

      {/* Mobile drawer */}
      {open && (
        <div className="fixed inset-0 z-20 lg:hidden">
          <div className="absolute inset-0 bg-black/40" onClick={() => setOpen(false)} />
          <nav className="absolute left-0 top-14 w-64 rounded-r-2xl bg-rail-900 p-4 shadow-xl">
            <div className="flex flex-col gap-1">{navLinks}</div>
          </nav>
        </div>
      )}

      {/* Desktop sidebar */}
      <aside className="fixed inset-y-0 left-0 z-20 hidden w-64 flex-col bg-rail-900 p-4 lg:flex">
        <div className="mb-6 flex items-center gap-3 px-2">
          <img src="/indian_rly_logo.png" alt="" className="h-10 w-10 rounded bg-white object-contain p-1" />
          <div>
            <div className="text-lg font-bold text-white">CRMS</div>
            <div className="text-xs text-rail-200">SER Workshop, Kharagpur</div>
          </div>
        </div>
        <div className="flex flex-1 flex-col gap-1">{navLinks}</div>

        <div className="mt-4 border-t border-rail-700 pt-4">
          <div className="px-2 text-xs uppercase tracking-wide text-rail-300">Signed in</div>
          <div className="px-2 pt-1 text-sm font-semibold text-white">
            {user.firstname} {user.lastname}
          </div>
          <div className="px-2 text-xs text-rail-200">
            {user.username} · {isAdmin ? 'Admin' : 'Viewer'}
          </div>
          <button onClick={handleLogout} className="btn-secondary mt-3 w-full text-xs">
            Sign out
          </button>
        </div>
      </aside>

      {/* Content */}
      <main className="p-4 lg:ml-64 lg:p-8">
        <Outlet />
      </main>
    </div>
  );
}
