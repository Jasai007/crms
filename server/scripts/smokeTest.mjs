// Quick end-to-end API smoke test. Run with server started:
//   node scripts/smokeTest.mjs
const BASE = process.env.API_URL || 'http://localhost:3001';

let cookie = '';
async function api(method, path, body) {
  const res = await fetch(BASE + path, {
    method,
    headers: {
      'Content-Type': 'application/json',
      ...(cookie ? { Cookie: cookie } : {}),
    },
    body: body ? JSON.stringify(body) : undefined,
    redirect: 'manual',
  });
  const setCookie = res.headers.getSetCookie?.() || [];
  for (const c of setCookie) {
    const pair = c.split(';')[0];
    if (pair.startsWith('crms_token=')) cookie = pair;
  }
  const json = await res.json().catch(() => ({}));
  return { status: res.status, json };
}

const assert = (cond, msg) => {
  if (!cond) {
    console.error('FAIL:', msg);
    process.exitCode = 1;
  } else console.log('ok  :', msg);
};

// 1. login as admin
let r = await api('POST', '/api/auth/login', { username: 'jasai007', password: 'jasai' });
assert(r.status === 200 && r.json.user?.role === 'admin', 'admin login');

// 2. viewer role cannot mutate
const viewerCookie = cookie;
r = await api('POST', '/api/auth/login', { username: 'monty99', password: 'monty' });
assert(r.status === 200 && r.json.user?.role === 'viewer', 'viewer login');
const viewerSession = cookie;
r = await api('POST', '/api/coaches', { coach_no: 'T1' });
assert(r.status === 403, 'viewer cannot add coach (403)');
r = await api('GET', '/api/coaches');
assert(r.status === 200 && Array.isArray(r.json.coaches), 'viewer can read coaches');
cookie = viewerSession;

// back to admin
r = await api('POST', '/api/auth/login', { username: 'jasai007', password: 'jasai' });

// 3. add coach + register
r = await api('POST', '/api/coaches', {
  coach_no: 'T1', railway_zone: 'SER', alloted_base: 'KGP', full_brake: 'AB',
  coach_type: 'ERT', make: 'IRS', category: 'AC', built_date: '2024-01-01',
});
assert(r.status === 201, 'add coach T1');
r = await api('POST', '/api/coaches', { coach_no: 'T1' });
assert(r.status === 409, 'duplicate coach rejected (409)');

r = await api('POST', '/api/registrations', {
  coach_no: 'T1', repair_type: 'POH', workshop_in: '2026-01-01', estimated_hours: 400,
});
assert(r.status === 201 && r.json.registration.current_stage === 'REGISTERED', 'create registration');
const regId = r.json.registration.id;
r = await api('POST', '/api/registrations', {
  coach_no: 'T1', repair_type: 'MCR', workshop_in: '2026-01-02', estimated_hours: 100,
});
assert(r.status === 409, 'duplicate in-progress registration rejected (409)');

// 4. walk the flow: REGISTERED -> STRIPPING -> POH -> PAINTING -> LIFTING -> BRAKE -> NTXR
const move = (body) => api('POST', `/api/registrations/${regId}/move`, body);
r = await move({ direction: 'forward' });
assert(r.status === 200 && r.json.registration.current_stage === 'STRIPPING', 'REGISTERED -> STRIPPING');
r = await move({ direction: 'forward', shopNo: 99, actualHours: 10 });
assert(r.status === 400, 'invalid shop rejected');
r = await move({ direction: 'forward', actualHours: 300, shopNo: 25 });
assert(r.status === 200 && r.json.registration.current_stage === 'POH', 'STRIPPING -> POH (shop 25)');
r = await move({ direction: 'forward' });
assert(r.json.registration.current_stage === 'PAINTING', 'POH -> PAINTING');
r = await move({ direction: 'forward' });
assert(r.json.registration.current_stage === 'LIFTING', 'PAINTING -> LIFTING');
r = await move({ direction: 'forward' });
assert(r.json.registration.current_stage === 'BRAKE', 'BRAKE reached via LIFTING');
r = await move({ direction: 'forward' });
assert(r.json.registration.current_stage === 'NTXR', 'BRAKE -> NTXR');

// 5. backward once
r = await move({ direction: 'backward' });
assert(r.status === 200 && r.json.registration.current_stage === 'BRAKE', 'backward NTXR -> BRAKE');
r = await move({ direction: 'forward' });
assert(r.json.registration.current_stage === 'NTXR', 'forward again -> NTXR');

// 6. fit = NO -> REPAIR -> not done -> NTXR -> fit YES -> released
r = await move({ direction: 'forward', fit: 'NO' });
assert(r.status === 200 && r.json.registration.current_stage === 'REPAIR', 'NTXR fit=NO -> REPAIR');
r = await move({ direction: 'forward', done: false });
assert(r.json.registration.current_stage === 'NTXR', 'REPAIR done=false -> NTXR');
r = await move({ direction: 'forward', fit: 'YES' });
assert(r.status === 200 && r.json.registration.current_stage === 'TRAFFIC_OUT'
  && r.json.registration.status === 'released', 'NTXR fit=YES -> TRAFFIC_OUT/released');
r = await move({ direction: 'forward' });
assert(r.status === 400, 'no move after release (400)');
r = await move({ direction: 'backward' });
assert(r.status === 400, 'no backward after release (400)');

// 7. history + holding report
r = await api('GET', '/api/reports/history/T1');
assert(r.status === 200 && r.json.registrations[0].events.length >= 9, 'coach history timeline');
r = await api('GET', '/api/reports/holding?stage=NTXR');
assert(r.status === 200 && Array.isArray(r.json.holding), 'holding report');

// 8. user management
r = await api('POST', '/api/users', {
  username: 'smoke1', password: 'test1234', role: 'viewer',
  firstname: 'S', lastname: 'M', email: 's@m.com', doj: '2026-01-01',
});
assert(r.status === 201, 'admin adds user');
const newUserId = r.json.user.id;
r = await api('PUT', `/api/users/${newUserId}/role`, { role: 'admin' });
assert(r.status === 200 && r.json.user.role === 'admin', 'promote to admin');
r = await api('DELETE', `/api/users/${newUserId}`);
assert(r.status === 200, 'delete user');
r = await api('DELETE', '/api/users/15');
assert(r.status === 400, 'cannot delete self');

// 9. logout
r = await api('POST', '/api/auth/logout');
r = await api('GET', '/api/auth/me');
assert(r.status === 401, 'logged out');

console.log(process.exitCode ? '\nSMOKE TEST FAILED' : '\nALL SMOKE TESTS PASSED');
