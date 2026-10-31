# Masjid Jami Baeturohman — Frontend React + Backend Laravel (satu repo)

Repo ini disatukan dalam satu repo, tapi tetap dua aplikasi:

- `frontend/` — React + Vite + Tailwind, yang di-deploy ke Vercel.
  Jalankan: `npm install`, lalu `npm run dev` (http://localhost:5173).
  Deploy Vercel: import repo ini, atur Root Directory ke `frontend`,
  Framework Vite, Build `npm run build`, Output `dist`.
  Environment Variable: `VITE_API_URL` = URL backend bila sudah live,
  boleh dikosongkan dulu — situs tetap tampil dengan data fallback.

- `backend/` — Laravel 12, API publik + panel admin Blade.
  Jalankan: `php artisan serve` (http://127.0.0.1:8000).
  Endpoint publik: `/api/kegiatan`, `/api/khutbah`, `/api/pengurus`,
  `/api/slides`, `/api/pengaturan`.
  Deploy backend: import repo ini ke hosting PHP (Railway/Render/hosting PHP),
  atur Root Directory ke `backend`, isi environment variable Laravel
  (APP_KEY, DB_*, FRONTEND_URL = URL frontend Vercel).
  Admin panel tetap di backend, bukan di React.

Catatan: satu repo, dua deployment. Push sekali ke GitHub akan memicu
deploy di kedua proyek yang terhubung, masing-masing dengan Root Directory-nya.
Jangan commit `frontend/node_modules`, `frontend/dist`, `backend/vendor`,
`backend/.env`, dan `backend/database/*.sqlite` — semuanya sudah di .gitignore.
