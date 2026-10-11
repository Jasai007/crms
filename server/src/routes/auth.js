import { Router } from 'express';
import bcrypt from 'bcryptjs';
import { z } from 'zod';
import { db } from '../db.js';
import { setAuthCookie, clearAuthCookie, requireAuth } from '../middleware/auth.js';

const router = Router();

const publicUser = (u) => ({
  id: u.id,
  username: u.username,
  role: u.role,
  firstname: u.firstname,
  lastname: u.lastname,
  email: u.email,
  doj: u.doj,
});

const loginSchema = z.object({
  username: z.string().min(1, 'Username is required'),
  password: z.string().min(1, 'Password is required'),
});

const registerSchema = z.object({
  username: z.string().min(3).max(50).regex(/^[a-zA-Z0-9_]+$/, 'Letters, digits and _ only'),
  password: z.string().min(4, 'Password must be at least 4 characters').max(72),
  firstname: z.string().min(1, 'First name is required').max(100),
  lastname: z.string().min(1, 'Last name is required').max(100),
  email: z.string().email('Invalid email'),
  doj: z.string().min(1, 'Date of joining is required'),
});

router.post('/login', (req, res) => {
  const parsed = loginSchema.safeParse(req.body);
  if (!parsed.success) {
    return res.status(400).json({ error: parsed.error.issues[0].message });
  }
  const { username, password } = parsed.data;
  const user = db.prepare('SELECT * FROM users WHERE username = ?').get(username);
  if (!user || !bcrypt.compareSync(password, user.password_hash)) {
    return res.status(401).json({ error: 'Invalid username or password' });
  }
  setAuthCookie(res, user);
  res.json({ user: publicUser(user) });
});

router.post('/register', (req, res) => {
  const parsed = registerSchema.safeParse(req.body);
  if (!parsed.success) {
    return res.status(400).json({ error: parsed.error.issues[0].message });
  }
  const { username, password, firstname, lastname, email, doj } = parsed.data;
  const exists = db.prepare('SELECT id FROM users WHERE username = ?').get(username);
  if (exists) {
    return res.status(409).json({ error: 'Username already taken' });
  }
  // Self-registration always yields a viewer; admin role is granted by an admin.
  const hash = bcrypt.hashSync(password, 10);
  const info = db
    .prepare(
      `INSERT INTO users (username, password_hash, role, firstname, lastname, email, doj)
       VALUES (?, ?, 'viewer', ?, ?, ?, ?)`
    )
    .run(username, hash, firstname, lastname, email, doj);
  const user = db.prepare('SELECT * FROM users WHERE id = ?').get(info.lastInsertRowid);
  setAuthCookie(res, user);
  res.status(201).json({ user: publicUser(user) });
});

router.post('/logout', (_req, res) => {
  clearAuthCookie(res);
  res.json({ ok: true });
});

router.get('/me', requireAuth, (req, res) => {
  res.json({ user: req.user });
});

export default router;
