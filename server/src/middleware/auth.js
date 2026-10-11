import jwt from 'jsonwebtoken';
import { db } from '../db.js';

const SECRET = process.env.JWT_SECRET || 'crms-dev-secret-change-in-production';
const COOKIE_NAME = 'crms_token';

export function setAuthCookie(res, user) {
  const token = jwt.sign({ id: user.id, username: user.username, role: user.role }, SECRET, {
    expiresIn: '12h',
  });
  res.cookie(COOKIE_NAME, token, {
    httpOnly: true,
    sameSite: 'lax',
    secure: process.env.NODE_ENV === 'production',
    maxAge: 12 * 60 * 60 * 1000,
  });
}

export function clearAuthCookie(res) {
  res.clearCookie(COOKIE_NAME);
}

/** Populates req.user for any valid session; never rejects. */
export function loadUser(req, _res, next) {
  const token = req.cookies?.[COOKIE_NAME];
  if (token) {
    try {
      const payload = jwt.verify(token, SECRET);
      const user = db
        .prepare(
          'SELECT id, username, role, firstname, lastname, email, doj FROM users WHERE id = ?'
        )
        .get(payload.id);
      if (user) req.user = user;
    } catch {
      /* invalid/expired token -> anonymous */
    }
  }
  next();
}

export function requireAuth(req, res, next) {
  if (!req.user) {
    return res.status(401).json({ error: 'Authentication required' });
  }
  next();
}

export function requireAdmin(req, res, next) {
  if (!req.user) {
    return res.status(401).json({ error: 'Authentication required' });
  }
  if (req.user.role !== 'admin') {
    return res.status(403).json({ error: 'Admin privileges required' });
  }
  next();
}
