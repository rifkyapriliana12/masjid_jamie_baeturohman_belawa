# Masjid Jami Baeturohman — Website Laravel

Website resmi **Masjid Jami Baeturohman, Desa Belawa** (Jl. Wangkelang, Belawa,
Kec. Lemahabang, Kab. Cirebon, Jawa Barat 45183) — lanjutan dari versi React lama
di folder `masjid-baeturohman`, sekarang dengan panel admin Laravel.

Tagline: *Pusat Ibadah, Ilmu, dan Kebersamaan Umat.*

## Fitur

### Halaman publik (bisa dibuka siapa saja)
- **Beranda** — nama masjid, tagline, dan 4 program unggulan (Sholat Jumat,
  Pengajian Rutin, TPA & TPQ Anak, Hari Besar Islam).
- **Tentang** — deskripsi masjid dari versi lama, alamat, dan pengelola (DKM).
- **Jadwal Sholat hari ini** — diambil live dari API Aladhan, metode Kemenag RI
  (metode 20), wilayah Cirebon. Bila API tidak bisa dihubungi, halaman tetap
  tampil dengan pesan ramah, bukan error.
- **Kegiatan** — daftar kegiatan dari database, lengkap dengan foto dan halaman detail.
- **Jadwal Khutbah Jumat** — tabel tanggal Jumat, khatib, imam, muadzin, dan tema.
- **Struktur DKM** — daftar pengurus dengan foto, diurutkan sesuai urutan tampil.
- **Infaq** — bila rekening belum diisi, tampil jelas **"Rekening infaq: belum
  diisi DKM"**. Nomor rekening TIDAK dikarang.
- **Kontak** — alamat, link Google Maps (Plus Code 5H8M+FCH), telepon/WA, dan
  email. Telepon dan email yang belum dikonfirmasi tampil sebagai
  "belum diisi DKM".

### Panel admin (wajib login)
- Login dan logout. Tidak ada registrasi publik.
- **CRUD Kegiatan** — judul, deskripsi, tanggal, foto upload (JPG/PNG/WebP,
  maks 2 MB, disk `public`). Foto lama dihapus saat diganti atau saat data dihapus.
- **CRUD Jadwal Khutbah** — tanggal Jumat, khatib, imam, muadzin, tema.
- **CRUD Struktur DKM** — nama, jabatan, foto upload, urutan tampil.
- **Slide Show beranda** — foto-foto di bagian atas beranda, diatur dari
  panel admin (lihat bagian "Slide Show" di bawah). Selama belum ada slide
  yang diupload, beranda tetap menampilkan hero teks seperti sebelumnya.
- **Pengaturan Masjid** — nama masjid, alamat, telepon/WA, email, rekening
  infaq, nama bank. Kosongkan rekening bila belum ada nomor resmi.

## Akun admin bawaan (DEMO, bukan akun asli siapa pun)

> Email: **admin@baeturohman.test**
> Password: **admin12345**

Akun ini dibuat oleh seeder (`database/seeders/AdminSeeder.php`) hanya untuk
percobaan lokal. **Segera ganti passwordnya setelah login pertama**, dengan
salah satu cara berikut:

```powershell
# Cara 1 — lewat tinker (di folder project):
php artisan tinker
# lalu ketik di prompt tinker:
# \App\Models\User::where('email', 'admin@baeturohman.test')->update(['password' => 'PASSWORD-BARU-ANDA']);
# exit
```

```powershell
# Cara 2 — lewat perintah artisan (buat user baru lalu hapus akun demo):
php artisan tinker --execute="\App\Models\User::create(['name' => 'Admin', 'email' => 'email-baru@contoh.com', 'password' => 'PASSWORD-BARU-ANDA']);"
```

Jangan pernah memakai password `admin12345` di server publik, dan jangan
membagikan password admin ke orang yang tidak berwenang.

## Persyaratan

- PHP **8.2 atau lebih baru**
- Composer (versi terbaru)
- MySQL/MariaDB (Laragon/XAMPP) **atau** SQLite bawaan (paling mudah untuk coba-coba)
- Koneksi internet untuk jadwal sholat Aladhan (opsional — halaman tetap jalan
  tanpa internet, hanya jadwal sholat yang menampilkan pesan tidak dapat dimuat)

## Langkah install di Windows (Laragon / XAMPP) — langkah demi langkah

### 1. Install PHP dan Composer
1. Install **Laragon** (sudah berisi PHP + MySQL) atau **XAMPP**.
2. Pastikan PHP 8.2+ terinstall. Cek di PowerShell:
   ```powershell
   php -v
   composer -V
   ```
   Keduanya harus menampilkan versi, bukan error "not recognized".
3. Bila `php` tidak dikenali, tambahkan folder PHP Laragon/XAMPP ke PATH
   Windows, lalu tutup dan buka lagi PowerShell.

### 2. Masuk ke folder project
```powershell
cd C:\laragon\www\masjid-baeturohman-laravel
```
Sesuaikan path dengan lokasi Anda mengekstrak zip ini. Di XAMPP, folder
yang setara adalah `C:\xampp\htdocs\masjid-baeturohman-laravel`.

### 3. Install dependensi Laravel
```powershell
composer install
```
Perintah ini mengunduh folder `vendor/` (tidak ikut di dalam zip). Tunggu
sampai selesai tanpa error.

### 4. Salin file environment dan buat application key
```powershell
copy .env.example .env
php artisan key:generate
```

### 5. Atur database
**Opsi A — SQLite (paling mudah, tanpa MySQL):**
Di file `.env`, pastikan:
```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```
Lalu buat file databasenya bila belum ada:
```powershell
New-Item -ItemType File -Force database\database.sqlite
```

**Opsi B — MySQL di Laragon/XAMPP:**
Buat database kosong bernama `masjid_baeturohman` lewat phpMyAdmin
(`http://localhost/phpmyadmin`), lalu di `.env` ubah menjadi:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=masjid_baeturohman
DB_USERNAME=root
DB_PASSWORD=
```
Isi `DB_PASSWORD` sesuai password MySQL Anda (di Laragon default biasanya kosong).

### 6. Migrasi dan isi data awal
```powershell
php artisan migrate --seed
```
Perintah ini membuat tabel `users`, `kegiatans`, `khutbahs`, `pengurus`,
`settings`, `sessions`, `cache`, dan `jobs`, lalu mengisi:
- akun admin demo di atas,
- pengaturan masjid (kontak dan rekening masih kosong = belum diisi),
- 6 kegiatan contoh dari versi React lama,
- 2 jadwal khutbah contoh (nama dan tema contoh — ganti dengan jadwal asli),
- 4 jabatan struktur DKM dengan nama "Belum diisi" (ganti dengan nama asli).

### 7. Buat symlink storage (agar foto upload bisa dibuka)
```powershell
php artisan storage:link
```
Bila di Windows muncul error symlink, jalankan PowerShell sebagai
Administrator lalu ulangi perintah ini.

### 8. Jalankan server
```powershell
php artisan serve
```
Buka di browser: **http://127.0.0.1:8000**

> Catatan Laragon: Anda juga bisa mengakses project lewat virtual host
> Laragon (misalnya `http://masjid-baeturohman-laravel.test`) bila "Pretty URL"
> Laragon aktif — pastikan document root mengarah ke folder `public/`, bukan
> ke root project.

## Cara login dan mengisi konten

1. Buka **http://127.0.0.1:8000/login**
2. Login dengan email `admin@baeturohman.test` dan password `admin12345`.
3. Setelah login, Anda masuk ke dasbor `/admin`.
4. **Kegiatan:** Admin → Kegiatan → "Tambah Kegiatan". Isi judul, deskripsi,
   tanggal, dan foto bila ada. Foto tersimpan di `storage/app/public/kegiatan/`.
5. **Jadwal Khutbah:** Admin → Khutbah → "Tambah Jadwal Khutbah". Isi tanggal
   Jumat, khatib, imam, muadzin, dan tema.
6. **Struktur DKM:** Admin → Struktur DKM → "Tambah Pengurus". Isi nama,
   jabatan, foto, dan urutan tampil (angka kecil tampil lebih dulu).
7. **Pengaturan:** Admin → Pengaturan. Isi telepon/WA, email, dan rekening
   infaq **hanya bila sudah dikonfirmasi DKM**. Bila dikosongkan, halaman
   publik menampilkan "belum diisi DKM".
8. **Menghapus / mengganti foto:** edit data lalu upload foto baru (foto lama
   otomatis dihapus), atau hapus data — fotonya ikut terhapus dari storage.
   Di halaman Edit, foto yang sudah tersimpan ditampilkan di atas kolom
   foto, jadi Anda bisa memastikan foto mana yang sedang dipakai sebelum
   menggantinya.
9. **Logout:** klik "Logout" di pojok kanan atas panel admin.

## Slide Show (foto di bagian atas beranda)

Slide show menampilkan foto-foto masjid bergantian di bagian atas beranda,
dengan teks nama masjid di atasnya. Foto harus foto masjid asli — tidak ada
foto contoh yang dibuatkan, karena tidak ada foto asli yang diberikan.

### Menambah slide baru
1. Login, lalu buka **Panel Admin → Slide Show → "Tambah Slide Show"**
   (atau dari dasbor, tombol "+ Tambah Slide Show").
2. Pilih **foto** (wajib, JPG/PNG/WebP, maks 2 MB). Foto tersimpan di
   `storage/app/public/slides/`.
3. Isi **judul** dan **keterangan** bila perlu — keduanya opsional.
4. Isi **urutan tampil** (angka kecil tampil lebih dulu, misalnya 1, 2, 3).
5. Pilih **"Ya, tampilkan"** pada "Tampilkan di Beranda?", lalu klik Simpan.

### Mengganti urutan / menonaktifkan slide
- **Ubah urutan:** buka Slide Show → Edit slide itu → ubah angka "Urutan
  Tampil" → Simpan Perubahan. Tidak perlu upload ulang foto bila foto
  tidak ingin diganti — kosongkan saja kolom foto.
- **Sembunyikan sementara:** buka Edit slide → ubah "Tampilkan di Beranda?"
  menjadi "Tidak, sembunyikan dulu" → Simpan Perubahan. Slide tidak tampil
  di beranda, tapi datanya tidak hilang dan bisa ditampilkan lagi kapan saja.
- **Hapus permanen:** tombol Hapus di daftar Slide Show. Foto yang terupload
  ikut dihapus dari storage.

### Perilaku di beranda
- Bila ada **2 slide aktif atau lebih**: foto bergeser otomatis tiap
  ~5 detik, dengan tombol slide sebelumnya/berikutnya dan titik navigasi.
  Geseran berhenti sementara saat kursor diarahkan ke hero atau saat layar
  disentuh, lalu jalan lagi setelahnya.
- Bila hanya **1 slide aktif**: foto tampil statis, tanpa tombol geser
  yang membingungkan.
- Bila **tidak ada slide aktif**: beranda menampilkan hero teks seperti
  sebelumnya (bukan foto karangan).

### Perintah migrate untuk tabel baru (di laptop Anda)
Fitur ini menambah tabel baru `slides`. Setelah menyalin file project yang
baru, jalankan SATU perintah ini di folder project — **tanpa `--seed`
ulang**, supaya data lama (kegiatan, khutbah, pengurus, pengaturan) tidak
berubah:

```powershell
php artisan migrate
```

Perintah itu hanya membuat tabel `slides` yang baru. Tidak perlu
`composer install` ulang dan tidak perlu mengulang `key:generate`,
`storage:link`, atau migrate yang lama. Setelah migrate, refresh beranda
dan isi slide dari panel admin seperti langkah di atas. Bila muncul error
"table slides already exists", berarti migrate sudah pernah jalan —
lanjutkan saja, tidak perlu diulang.

## Struktur project (file utama)

```
app/Http/Controllers/HomeController.php       Halaman publik + jadwal sholat
app/Http/Controllers/Auth/LoginController.php  Login/logout
app/Http/Controllers/Admin/                  CRUD Kegiatan, Slide Show, Khutbah, Pengurus, Pengaturan
app/Http/Requests/                           Validasi form admin
app/Models/                                  User, Kegiatan, Slide, Khutbah, Pengurus, Setting
app/Services/PrayerTimesService.php          API Aladhan (metode Kemenag 20, Cirebon)
config/mosque.php                            Konten awal dari versi React lama
database/migrations/                         Tabel users, kegiatan, slides, khutbah, pengurus, settings
database/seeders/                            Admin demo + data contoh (ditandai CONTOH)
resources/views/home.blade.php               Beranda publik (semua seksi)
resources/views/layouts/                     Layout publik dan layout admin
resources/views/admin/                       Dasbor + CRUD + pengaturan
routes/web.php                               Rute publik + rute admin (middleware auth)
```

## Catatan kejujuran data

- Alamat masjid, Plus Code, link Google Maps, tagline, deskripsi, dan 4 program
  unggulan diambil dari versi React lama (`masjid-baeturohman/src/data.js`).
- **Tidak ada** nomor telepon, email DKM, rekening infaq, atau nama pengurus
  asli yang dikarang di project ini. Semua yang belum dikonfirmasi tampil
  kosong / "belum diisi" dan harus diisi lewat panel admin setelah
  dikonfirmasi pengurus DKM.
- Data seeder khutbah dan pengurus diberi label "Contoh" / "Belum diisi"
  secara eksplisit dan wajib diganti sebelum diumumkan ke jamaah.

## Tampilan ramah pengguna dan responsif

Antarmuka dibuat untuk orang awam, bukan hanya programmer:

- Semua tombol berlabel jelas dalam Bahasa Indonesia: "Tambah Kegiatan",
  "Simpan", "Simpan Perubahan", "Batal", "Hapus", "Lihat", "Edit".
- Setiap kolom form punya label dan contoh isian (placeholder), misalnya
  "Contoh: Pengajian Rutin Ahad Pagi", plus penjelasan singkat di bawah kolom.
- Setelah simpan, ubah, atau hapus, muncul pesan sukses yang jelas di atas
  halaman; bila ada kolom yang salah, muncul daftar kesalahan yang jelas.
- Tidak ada istilah teknis di menu admin (tidak ada kata "CRUD", "migration",
  atau "database" di antarmuka).

### Responsif di HP, tablet, dan laptop (uji logika)

Catatan jujur: PHP tidak tersedia di mesin pembangun, sehingga pengujian di
sini adalah penalaran atas aturan CSS dan struktur HTML (bukan uji perangkat
nyata atau tangkapan layar). Setelah `php artisan serve` berjalan, buka
website di HP/tablet/laptop sungguhan dan periksa lagi daftar di bawah ini.

| Lebar layar | Yang diharapkan |
| --- | --- |
| HP kecil (~360 px) | Header menumpuk ke bawah, menu membungkus dan tetap terlihat semua (tidak ada menu hamburger tersembunyi yang bisa gagal dibuka); kartu kegiatan/pengurus 1 kolom; jadwal sholat 2 kolom; tombol hero melebar penuh agar mudah ditekan; tabel khutbah dan tabel admin tidak memecah halaman — tabel bergeser mendatar di dalam kotaknya sendiri; foto kegiatan/pengurus melebar penuh dengan rasio 16:9 dan tidak terpotong; kolom form selebar layar dengan huruf minimal 16–17 px agar tidak terjadi zoom otomatis di HP. |
| Tablet (~768 px) | Kartu 2 kolom; padding mengecil dari versi laptop; header dan form tetap satu kolom penuh; tabel masih bergeser mendatar bila kolomnya banyak. |
| Laptop (~1280 px) | Konten terpusat dengan lebar maks 1020 px; kartu kegiatan 3–4 kolom; jadwal sholat 5 kolom; tabel tampil penuh tanpa perlu geser. |

Aturan yang menopang hasil di atas: `viewport` meta, `box-sizing: border-box`
di semua elemen, `img { max-width: 100% }`, foto dengan `aspect-ratio: 16/9`
dan `object-fit: cover`, breakpoint `@media (max-width: 768px)` dan
`@media (max-width: 640px)`, target sentuh minimal 44 px untuk tautan menu dan
48 px untuk tombol utama, serta `.table-wrap { overflow-x: auto }` untuk
semua tabel. Tidak ada lebar tetap di atas 360 px di luar `min-width` tabel
yang sengaja berada di dalam pembungkus geser tersebut.

## Deploy ke Vercel

Bagian ini jujur soal apa yang bisa dan tidak bisa jalan di Vercel, supaya
tidak ada ekspektasi yang salah.

### File deployment yang ditambahkan

- `api/index.php` — titik masuk Vercel. Isinya hanya
  `require __DIR__ . '/../public/index.php'`, jadi semua request diteruskan
  ke aplikasi Laravel yang sudah ada. File `public/index.php` tidak diubah.
- `vercel.json` — framework `null`, fungsi `api/index.php` memakai runtime
  `vercel-php@0.7.3` (cocok untuk PHP 8.3), dan semua route (`/(.*)`)
  diarahkan ke `/api/index.php`. File ini tidak berisi secret apa pun.
- `.vercelignore` — mengecualikan file lokal yang tidak perlu di-deploy
  (misalnya `.git`, log, view hasil compile, dan `database/*.sqlite`).
  `vendor/` sengaja tidak dikecualikan di sini, tetapi `vendor/` memang
  tidak ada di repo Git (sudah ada di `.gitignore`); runtime PHP Vercel
  memasang dependensi dari `composer.lock` saat build.
- `bootstrap/app.php` — ditambahkan `trustProxies(at: '*')` dengan cara
  Laravel 12, karena Vercel berada di belakang proxy. Ini supaya URL dan
  skema `https` yang dihasilkan aplikasi benar saat diakses lewat Vercel.
  Konfigurasi lain di file itu tidak diubah.

### Batasan penting — baca dulu sebelum deploy

1. **Database eksternal itu WAJIB untuk fungsi penuh.** Filesystem Vercel
   bersifat read-only dan tidak persisten antar deploy. Database SQLite
   lokal (`database/database.sqlite`) TIDAK akan bertahan di Vercel dan
   TIDAK boleh di-push ke repo. Tanpa database eksternal, login admin,
   CRUD kegiatan/khutbah/pengurus/slide, dan session tidak akan jalan.
2. **Upload foto tidak akan tersimpan permanen di Vercel.** Foto yang
   di-upload lewat panel admin tersimpan di disk lokal, yang di Vercel
   bersifat sementara dan bisa hilang saat redeploy. Proyek ini belum
   dikonfigurasi untuk penyimpanan eksternal (misalnya S3), jadi untuk
   pemakaian produksi di Vercel, upload admin harus dianggap tidak
   persisten sampai penyimpanan eksternal ditambahkan.
3. **Halaman publik read-only bisa jalan** bila database eksternal sudah
   di-migrate dan di-seed (lihat di bawah), karena halaman publik hanya
   membaca kegiatan, khutbah, pengurus, dan slide dari database.
4. **Jangan pernah menulis secret ke repo.** `APP_KEY` asli, host database,
   username, dan password database HANYA diisi lewat Environment Variables
   di dashboard Vercel, bukan di `vercel.json`, bukan di `.env.example`,
   dan bukan di file lain yang di-commit. Nilai-nilai di bawah ini yang
   berbentuk `<...>` adalah placeholder — ganti dengan nilai Anda sendiri,
   jangan dipakai mentah-mentah.

### Langkah di dashboard Vercel

Proyek Vercel untuk repo ini sudah dibuat sebelumnya
(`masjid-jamie-baeturohman`), jadi langkahnya adalah melengkapi, bukan
membuat dari nol:

1. Di dashboard Vercel, buka proyek `masjid-jamie-baeturohman`.
2. Pastikan proyek terhubung ke repo GitHub
   `rifkyapriliana12/Masjid_jamie_baeturohman` (nama repo sesuai repo
   yang sudah di-push; ejaan `jamie` di sini mengikuti nama repo tersebut).
3. Framework Preset: pilih **None / Other** (bukan Laravel, bukan Next.js).
   Root Directory: biarkan default (root repo).
4. Isi Environment Variables di bawah ini (Settings → Environment
   Variables), lalu redeploy. Environment Variables yang diubah tidak
   berlaku sampai ada deploy baru.

### Environment Variables yang harus diisi di Vercel

| Variabel | Nilai |
| --- | --- |
| `APP_NAME` | `Masjid Jami Baeturohman` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://masjid-jamie-baeturohman.vercel.app` |
| `APP_KEY` | Hasil dari `php artisan key:generate --show` yang dijalankan di lokal (lihat catatan di bawah). Formatnya diawali `base64:`. JANGAN mengarang nilai ini dan JANGAN memakai kunci lokal Laragon Anda apa adanya tanpa sadar — kunci ini akan dipakai untuk mengenkripsi session/cookie di Vercel. |
| `DB_CONNECTION` | `mysql` atau `pgsql`, sesuai database eksternal yang Anda pakai (bukan `sqlite`) |
| `DB_HOST` | `<HOST-DATABASE-EKSTERNAL-ANDA>` |
| `DB_PORT` | `<PORT-DATABASE-ANDA, mis. 3306 untuk MySQL atau 5432 untuk Postgres>` |
| `DB_DATABASE` | `<NAMA-DATABASE-ANDA>` |
| `DB_USERNAME` | `<USERNAME-DATABASE-ANDA>` |
| `DB_PASSWORD` | `<PASSWORD-DATABASE-ANDA>` |
| `SESSION_DRIVER` | `database` (sesuai `.env.example` proyek ini; tabel `sessions` harus sudah di-migrate) |
| `CACHE_STORE` | `database` (sesuai `.env.example` proyek ini; tabel `cache` harus sudah di-migrate) |
| `QUEUE_CONNECTION` | `database` (sesuai `.env.example` proyek ini; tabel `jobs` harus sudah di-migrate) |
| `FILESYSTEM_DISK` | `local` (dengan batasan upload di atas: tidak persisten di Vercel) |

Catatan soal `APP_KEY`: jalankan `php artisan key:generate --show` di
terminal lokal (di folder proyek Laragon, bukan di server Vercel), salin
keluaran yang diawali `base64:` itu ke Environment Variables Vercel, dan
jangan pernah menempelkan kunci tersebut ke repo, chat publik, atau
screenshot.

### Migrate database eksternal dari lokal

Vercel tidak menyediakan terminal untuk menjalankan `php artisan migrate`
di servernya, jadi migrate dilakukan dari laptop Anda dengan cara
mengarahkan `.env` lokal SEMENTARA ke database eksternal:

1. Cadangkan `.env` lokal Anda dulu (salin ke tempat aman di luar proyek,
   misalnya `C:\laragon\www\masjid-baeturohman-laravel\.env.lokal.bak`
   — file cadangan ini JANGAN di-commit).
2. Di `.env` lokal, ubah sementara `DB_CONNECTION`, `DB_HOST`, `DB_PORT`,
   `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` ke nilai database
   eksternal yang sama dengan yang Anda isi di Vercel.
3. Jalankan dari folder proyek (satu perintah):
   ```powershell
   php artisan migrate --seed
   ```
   Perintah ini membuat tabel `users`, `sessions`, `cache`, `jobs`,
   `kegiatans`, `khutbahs`, `pengurus`, `settings`, dan `slides` di
   database eksternal, plus data contoh dari seeder (termasuk akun admin
   demo — segera ganti passwordnya setelah deploy, lihat bagian akun
   admin di atas).
4. **Kembalikan `.env` lokal ke pengaturan SQLite/Laragon semula**
   segera setelah migrate selesai, supaya pengembangan lokal tidak
   terganggu dan tidak ada kredensial database eksternal yang tertinggal
   di `.env` lokal lebih lama dari perlu. Hapus file cadangan bila sudah
   tidak dibutuhkan, dan pastikan `.env` tidak pernah di-commit
   (sudah ada di `.gitignore`).

Alternatif yang lebih aman bila Anda tidak nyaman mengubah `.env` lokal:
buat database eksternal, lalu migrate dari mesin lain yang memang
disiapkan untuk itu (misalnya VPS) — intinya, database eksternal harus
sudah termigrate sebelum situs Vercel dibuka untuk umum.

### Redeploy

Setiap `git push` ke branch utama repo GitHub akan memicu deploy otomatis
di Vercel. Urutan yang benar setelah perubahan ini:

1. `git add` file-file baru/berubah (lihat daftar di bawah).
2. `git commit` dengan pesan yang jelas.
3. `git push` — tunggu status deployment di dashboard Vercel sampai
   `Ready` sebelum membuka situsnya.
4. Bila Environment Variables baru saja diubah, lakukan redeploy manual
   dari dashboard Vercel (Deployments → ⋯ → Redeploy), karena deploy
   lama tidak otomatis memakai variabel baru.

Bila setelah `Ready` situs masih menampilkan sepotong kode PHP atau error,
periksa Build Logs dan Function Logs di dashboard Vercel terlebih dahulu —
itu menunjukkan apakah runtime PHP gagal dipasang, apakah `composer`
gagal, atau apakah koneksi database ditolak — sebelum mengubah kode.

## Arsitektur split: Frontend React + Backend Laravel (API)

Proyek ini sekarang dibagi dua:

- **Frontend:** React di folder `masjid-baeturohman` (Vite + Tailwind 4),
  bisa di-deploy ke Vercel sebagai proyek terpisah.
- **Backend:** Laravel ini — API publik read-only di bawah + panel admin
  Blade yang sudah ada. Panel admin tetap di sini, bukan di React.

### Menjalankan backend (bersandingan dengan frontend)

Terminal 1 — backend (di folder ini):

```powershell
php artisan serve
```

Backend jalan di http://127.0.0.1:8000. Terminal 2 — frontend React
(di folder `masjid-baeturohman`): `npm install`, lalu `npm run dev`
(jalan di http://localhost:5173).

### CORS untuk frontend

Origin yang diizinkan diatur di `config/cors.php` dari env
`FRONTEND_URL` (boleh beberapa, dipisah koma). Contoh di `.env`:

```
FRONTEND_URL=http://localhost:5173
```

Di production, isi `FRONTEND_URL` dengan URL Vercel frontend
(mis. `https://masjid-jamie-baeturohman.vercel.app`). Bila
`FRONTEND_URL` tidak diisi, hanya `http://localhost:5173` yang
diizinkan — sengaja tidak dibuka ke `*` di production. API ini hanya
mengizinkan `GET`, `HEAD`, dan `OPTIONS` pada path `api/*`, dan tidak
memakai cookie/session.

### API publik (read-only, tanpa auth, hanya GET)

Semua respons memakai bentuk konsisten `{"data": [...]}` untuk daftar
dan `{"data": {...}}` untuk satu objek. `foto_url` adalah URL lengkap
berdasarkan `APP_URL` backend; bila tidak ada foto, nilainya `null`,
bukan URL palsu. Tidak ada endpoint tulis di API ini — tambah/edit/
hapus data tetap lewat panel admin Blade (wajib login).

| Endpoint | Isi |
|---|---|
| `GET /api/kegiatan` | Daftar kegiatan, terbaru dulu |
| `GET /api/kegiatan/{id}` | Satu kegiatan; 404 JSON bila tidak ada |
| `GET /api/khutbah` | Daftar jadwal khutbah, terbaru dulu |
| `GET /api/pengurus` | Daftar pengurus, urut `urutan` lalu nama |
| `GET /api/slides` | Hanya slide aktif, urut `urutan` lalu id |
| `GET /api/pengaturan` | Hanya field publik |

Contoh respons `GET /api/kegiatan` (disingkat):

```json
{
  "data": [
    {
      "id": 1,
      "judul": "Pengajian Rutin",
      "deskripsi": "Kajian mingguan bersama jamaah.",
      "tanggal": "2026-10-31",
      "foto_url": "http://127.0.0.1:8000/storage/kegiatan/contoh.jpg"
    }
  ]
}
```

Contoh respons `GET /api/pengaturan`:

```json
{
  "data": {
    "nama_masjid": "Masjid Jami Baeturohman",
    "alamat": "Jl. Wangkelang, Belawa, Kec. Lemahabang, Kab. Cirebon, Jawa Barat 45183",
    "telepon": null,
    "email": null,
    "rekening_infaq": null,
    "nama_bank": null
  }
}
```

Nilai `null` di atas artinya belum diisi/dikonfirmasi DKM — bukan
dikarang. File-file API: `routes/api.php`,
`app/Http/Controllers/Api/PublicController.php`, `config/cors.php`,
dan pendaftaran `api:` di `bootstrap/app.php` (route web/admin yang
sudah ada tidak diubah).

### Batasan split ini (jujur)

- Frontend React di Vercel bisa live tanpa backend, tapi data terbaru
  dari panel admin hanya tampil setelah backend Laravel juga live dan
  `VITE_API_URL` di frontend diarahkan ke URL backend itu, lalu
  frontend di-redeploy (variabel `VITE_*` dibaca saat build).
- Upload foto di panel admin tersimpan di disk `public` backend; bila
  backend di-deploy ke platform serverless yang filesystem-nya
  read-only (mis. Vercel), upload tidak persisten — untuk fungsi admin
  penuh, backend sebaiknya di hosting PHP biasa (lihat bagian Vercel
  di README ini).
