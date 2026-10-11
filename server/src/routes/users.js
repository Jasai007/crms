import { Router } from 'express';
import bcrypt from 'bcryptjs';
import { z } from 'zod';
import { db } from '../db.js';
import { requireAdmin } from '../middleware/auth.js';

const router = Router();
router.use(requireAdmin); // user management is admin-only, like the legacy app

const publicUser = (u) => ({
  id: u.id,
  username: u.username,
  role: u.role,
  firstname: u.firstname,
  lastname: u.lastname,
  email: u.email,
  doj: u.doj,
});

const userSchema = z.object({
  username: z.string().min(3).max(50).regex(/^[a-zA-Z0-9_]+$/),
  password: z.string().min(4).max(72),
  role: z.enum(['admin', 'viewer']),
  firstname: z.string().min(1).max(100),
  lastname: z.string().min(1).max(100),
  email: z.string().email(),
  doj: z.string().min(1),
});

// GET /api/users?q=term  — search by any field (legacy user.php search)
router.get('/', (req, res) => {
  const q = (req.query.q || '').toString().trim();
  let rows;
  if (q) {
    const like = `%${q}%`;
    rows = db
      .prepare(
        `SELECT id, username, role, firstname, lastname, email, doj FROM users
         WHERE username LIKE ? OR email LIKE ? OR firstname LIKE ? OR lastname LIKE ? OR doj LIKE ?
            OR CAST(id AS TEXT) = ?
         ORDER BY id`
      )
      .all(like, like, like, like, like, q);
  } else {
    rows = db
      .prepare(
        'SELECT id, username, role, firstname, lastname, email, doj FROM users ORDER BY id'
      )
      .all();
  }
  res.json({ users: rows });
});

// POST /api/users — admin adds a user (can create admins, unlike self-registration)
router.post('/', (req, res) => {
  const parsed = userSchema.safeParse(req.body);
  if (!parsed.success) {
    return res.status(400).json({ error: parsed.error.issues[0].message });
  }
  const { username, password, role, firstname, lastname, email, doj } = parsed.data;
  if (db.prepare('SELECT id FROM users WHERE username = ?').get(username)) {
    return res.status(409).json({ error: 'Username already taken' });
  }
  const hash = bcrypt.hashSync(password, 10);
  const info = db
    .prepare(
      `INSERT INTO users (username, password_hash, role, firstname, lastname, email, doj)
       VALUES (?, ?, ?, ?, ?, ?, ?)`
    )
    .run(username, hash, role, firstname, lastname, email, doj);
  const user = db.prepare('SELECT * FROM users WHERE id = ?').get(info.lastInsertRowid);
  res.status(201).json({ user: publicUser(user) });
});

// PUT /api/users/:id/role — promote / demote (legacy: "contact the admin")
router.put('/:id/role', (req, res) => {
  const role = req.body?.role;
  if (role !== 'admin' && role !== 'viewer') {
    return res.status(400).json({ error: "role must be 'admin' or 'viewer'" });
  }
  const id = Number(req.params.id);
  if (id === req.user.id) {
    return res.status(400).json({ error: 'You cannot change your own role' });
  }
  const info = db.prepare('UPDATE users SET role = ? WHERE id = ?').run(role, id);
  if (info.changes === 0) return res.status(404).json({ error: 'User not found' });
  const user = db.prepare('SELECT * FROM users WHERE id = ?').get(id);
  res.json({ user: publicUser(user) });
});

// DELETE /api/users/:id
router.delete('/:id', (req, res) => {
  const id = Number(req.params.id);
  if (id === req.user.id) {
    return res.status(400).json({ error: 'You cannot delete your own account' });
  }
  const info = db.prepare('DELETE FROM users WHERE id = ?').run(id);
  if (info.changes === 0) return res.status(404).json({ error: 'User not found' });
  res.json({ ok: true });
});

export default router;
