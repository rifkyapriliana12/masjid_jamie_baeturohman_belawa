# Masjid Jami Baeturohman — Frontend React

Frontend publik **Masjid Jami Baeturohman, Desa Belawa** (Vite + React +
Tailwind 4). Ini adalah sisi tampilan dari arsitektur split:

- **Frontend:** React ini (bisa di-deploy ke Vercel).
- **Backend:** Laravel di folder `masjid-baeturohman-laravel` — API publik
  read-only + panel admin Blade. Admin **tetap di Laravel**, bukan di React.

## Yang ditampilkan

- Beranda (hero teks, atau slide show bila backend mengembalikan slide aktif)
- Tentang, jadwal sholat live dari Aladhan (metode Kemenag RI, Cirebon)
- Jadwal Khutbah, Struktur DKM, dan Kegiatan — dari API Laravel bila
  berhasil, dari data statis `src/data.js` bila API tidak terjangkau
- Infaq dan Kontak — rekening, telepon, dan email dari API bila ada;
  bila kosong, tampil sebagai "belum diisi" (tidak dikarang)

## Jalankan secara lokal (bersandingan dengan backend)

Terminal 1 — backend Laravel (di folder `masjid-baeturohman-laravel`):

```powershell
php artisan serve
```

Backend jalan di http://127.0.0.1:8000.

Terminal 2 — frontend React (di folder ini):

```powershell
npm install
npm run dev
```

Frontend jalan di http://localhost:5173 (port default Vite).

## Variabel environment

Salin `.env.example` menjadi `.env` bila ingin mengubahnya:

```powershell
copy .env.example .env
```

Isi file `.env`:

```
VITE_API_URL=http://127.0.0.1:8000
```

Catatan penting tentang Vite: variabel `VITE_*` dibaca **saat build**,
bukan saat runtime. Jadi setelah mengubah `VITE_API_URL`, jalankan ulang
`npm run dev` (lokal) atau redeploy (Vercel).

Bila `VITE_API_URL` tidak diisi, kode memakai default
`http://127.0.0.1:8000`. Bila backend tidak terjangkau (mis. backend belum
live, atau URL salah), situs **tidak blank**: kegiatan, khutbah, struktur
DKM, slide show, dan kontak memakai data statis dari `src/data.js`, dan
jadwal sholat tetap dari Aladhan.

## Deploy frontend ke Vercel

1. Di Vercel, buat proyek baru dan import **folder React ini sebagai
   proyek terpisah** (bukan root repo Laravel). Bila repo GitHub berisi
   kedua folder, atur Root Directory ke folder React ini.
2. Framework Preset: Vite (atau Other bila Vite tidak terdeteksi).
   Build Command: `npm run build`, Output Directory: `dist`.
3. Tambahkan Environment Variable di Vercel:
   - `VITE_API_URL` = URL backend Laravel yang sudah live
     (mis. URL hosting PHP / Railway / Laravel Cloud backend).
   - Bila backend belum live, variabel ini boleh dikosongkan — situs
     tetap tampil dengan data fallback dari `src/data.js`.
4. Deploy. Setiap push ke branch utama memicu deploy ulang.

## Batasan (jujur)

- Frontend React di Vercel bisa live **tanpa** backend, tapi data terbaru
  dari panel admin Laravel (kegiatan, khutbah, pengurus, slide, rekening)
  hanya tampil setelah backend Laravel juga live **dan** `VITE_API_URL`
  diarahkan ke URL backend itu, lalu frontend di-redeploy (karena
  `VITE_*` dibaca saat build).
- Panel admin, login, tambah/edit/hapus data, dan upload foto tetap di
  Laravel (Blade), bukan di React. React ini hanya membaca API publik.
- Foto dari API adalah URL lengkap dari backend (`foto_url`); bila
  backend tidak live, foto API tidak tampil dan kartu memakai data
  statis tanpa foto.
