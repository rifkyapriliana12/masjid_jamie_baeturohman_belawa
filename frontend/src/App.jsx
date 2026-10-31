import { useEffect, useState } from 'react'
import { mosque, features, activities, prayerCity } from './data.js'
import { api, API_BASE } from './api.js'

// Tombol "Login Admin" di navbar mengarah ke halaman login admin
// backend Laravel, bukan ke halaman React. Alamatnya mengikuti
// VITE_API_URL (URL backend yang sudah live); bila variabel itu
// belum diisi, kode memakai default lokal http://127.0.0.1:8000,
// jadi di Vercel frontend wajib diisi VITE_API_URL = URL backend
// Vercel, lalu redeploy, supaya tombol ini tidak mengarah ke localhost.
const adminLoginUrl = `${API_BASE}/login`

function formatTanggal(tanggal) {
  if (!tanggal) return ''
  const d = new Date(`${tanggal}T00:00:00`)
  if (Number.isNaN(d.getTime())) return tanggal
  return d.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
  })
}

// Hero slide show: hanya dipakai bila API mengembalikan slide aktif.
// Bila tidak ada slide, App memakai hero teks seperti semula.
function HeroSlideshow({ slides }) {
  const [index, setIndex] = useState(0)
  const [paused, setPaused] = useState(false)

  useEffect(() => {
    if (slides.length < 2 || paused) return undefined
    const timer = setInterval(
      () => setIndex((i) => (i + 1) % slides.length),
      5000,
    )
    return () => clearInterval(timer)
  }, [slides.length, paused])

  const current = slides[index]
  return (
    <section
      id="beranda"
      className="relative overflow-hidden bg-emerald-950 text-white"
      onMouseEnter={() => setPaused(true)}
      onMouseLeave={() => setPaused(false)}
    >
      {slides.map((slide, i) => (
        <img
          key={slide.id ?? i}
          src={slide.foto_url}
          alt={slide.judul || 'Foto Masjid Jami Baeturohman'}
          className={`absolute inset-0 h-full w-full object-cover transition-opacity duration-700 ${
            i === index ? 'opacity-100' : 'opacity-0'
          }`}
        />
      ))}
      <div className="absolute inset-0 bg-emerald-950/75" />
      <div className="relative mx-auto max-w-6xl px-4 py-20 text-center sm:py-28">
        <p className="font-arabic text-3xl text-amber-300 sm:text-4xl">
          بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
        </p>
        <p className="mx-auto mt-4 max-w-xl text-sm text-emerald-200">
          Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang
        </p>
        <h1 className="mx-auto mt-8 max-w-3xl text-4xl font-extrabold leading-tight sm:text-6xl">
          {current?.judul || 'Masjid Jami Baeturohman'}
        </h1>
        <p className="mt-3 text-lg font-semibold tracking-[0.25em] text-amber-400">
          DESA BELAWA
        </p>
        <p className="mx-auto mt-5 max-w-xl text-base text-emerald-100 sm:text-lg">
          {current?.keterangan || `${mosque.tagline} — rumah ibadah dan pembinaan umat bagi warga Desa Belawa dan sekitarnya.`}
        </p>
        <div className="mt-8 flex flex-wrap justify-center gap-3">
          <a
            href="#jadwal"
            className="rounded-full bg-amber-400 px-6 py-3 text-sm font-extrabold text-emerald-950 hover:bg-amber-300"
          >
            Lihat Jadwal Sholat
          </a>
          <a
            href="#kegiatan"
            className="rounded-full border border-white/40 px-6 py-3 text-sm font-bold text-white hover:bg-white/10"
          >
            Kegiatan Masjid
          </a>
        </div>
        {slides.length > 1 && (
          <div className="mt-10 flex items-center justify-center gap-3">
            <button
              type="button"
              aria-label="Slide sebelumnya"
              onClick={() => setIndex((index - 1 + slides.length) % slides.length)}
              className="rounded-full bg-white/20 px-4 py-2 text-sm font-bold hover:bg-white/30"
            >
              ‹
            </button>
            {slides.map((slide, i) => (
              <button
                key={slide.id ?? i}
                type="button"
                aria-label={`Slide ${i + 1}`}
                onClick={() => setIndex(i)}
                className={`h-3 w-3 rounded-full ${i === index ? 'bg-amber-400' : 'bg-white/40'}`}
              />
            ))}
            <button
              type="button"
              aria-label="Slide berikutnya"
              onClick={() => setIndex((index + 1) % slides.length)}
              className="rounded-full bg-white/20 px-4 py-2 text-sm font-bold hover:bg-white/30"
            >
              ›
            </button>
          </div>
        )}
      </div>
    </section>
  )
}

const NAV = [
  { href: '#beranda', label: 'Beranda' },
  { href: '#tentang', label: 'Tentang' },
  { href: '#jadwal', label: 'Jadwal Sholat' },
  { href: '#kegiatan', label: 'Kegiatan' },
  { href: '#infaq', label: 'Infaq' },
  { href: '#kontak', label: 'Kontak' },
]

function DomeMark({ className = 'h-10 w-10' }) {
  return (
    <svg viewBox="0 0 64 64" className={className} aria-hidden="true">
      <rect width="64" height="64" rx="14" fill="#064e3b" />
      <path d="M32 10c-9 4-14 10-14 18v8h28v-8c0-8-5-14-14-18z" fill="#d4af37" />
      <rect x="30" y="4" width="4" height="8" rx="2" fill="#d4af37" />
      <circle cx="32" cy="5" r="2.4" fill="#d4af37" />
      <rect x="16" y="36" width="32" height="4" rx="2" fill="#f5f0e1" />
      <rect x="20" y="40" width="5" height="12" fill="#f5f0e1" />
      <rect x="39" y="40" width="5" height="12" fill="#f5f0e1" />
      <path d="M14 56h36" stroke="#d4af37" strokeWidth="3" strokeLinecap="round" />
    </svg>
  )
}

function PrayerTimes() {
  const [data, setData] = useState(null)
  const [error, setError] = useState(false)

  useEffect(() => {
    const url =
      `https://api.aladhan.com/v1/timingsByCity?city=${encodeURIComponent(prayerCity.city)}` +
      `&country=${encodeURIComponent(prayerCity.country)}&method=${prayerCity.method}`
    fetch(url)
      .then((r) => r.json())
      .then((j) => {
        if (j?.data?.timings) setData(j.data)
        else setError(true)
      })
      .catch(() => setError(true))
  }, [])

  const order = [
    ['Subuh', 'Fajr'],
    ['Dzuhur', 'Dhuhr'],
    ['Ashar', 'Asr'],
    ['Maghrib', 'Maghrib'],
    ['Isya', 'Isha'],
  ]

  return (
    <div className="rounded-3xl bg-emerald-950 p-6 text-white shadow-xl sm:p-8">
      <div className="flex flex-wrap items-baseline justify-between gap-2">
        <h3 className="text-xl font-bold">Jadwal Sholat Hari Ini</h3>
        <span className="text-sm text-emerald-200">
          Wilayah {prayerCity.city} &amp; sekitarnya
        </span>
      </div>
      {data?.hijri && (
        <p className="mt-1 text-sm text-amber-300">
          {data.hijri.day} {data.hijri.month.en} {data.hijri.year} H
          {' · '}
          {data.date?.readable}
        </p>
      )}
      {error && (
        <p className="mt-4 rounded-xl bg-white/10 p-4 text-sm text-emerald-100">
          Jadwal sholat tidak dapat dimuat saat ini. Silakan periksa koneksi
          internet Anda, atau lihat jadwal di papan pengumuman masjid.
        </p>
      )}
      {data && (
        <div className="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-5">
          {order.map(([label, key]) => (
            <div key={key} className="rounded-2xl bg-white/10 p-4 text-center">
              <p className="text-sm text-emerald-200">{label}</p>
              <p className="mt-1 text-xl font-bold tabular-nums">
                {data.timings[key]?.slice(0, 5)}
              </p>
            </div>
          ))}
        </div>
      )}
      <p className="mt-4 text-xs text-emerald-300">
        Sumber: Aladhan Prayer Times (metode Kemenag RI). Waktu dapat berbeda
        beberapa menit dengan jadwal resmi setempat.
      </p>
    </div>
  )
}

export default function App() {
  const [open, setOpen] = useState(false)
  // Data dari backend Laravel bila berhasil; bila API gagal/tidak
  // terjangkau, state ini tetap kosong dan tampilan memakai data
  // statis dari data.js (fallback) — situs tidak boleh blank.
  const [apiKegiatan, setApiKegiatan] = useState([])
  const [apiKhutbah, setApiKhutbah] = useState([])
  const [apiPengurus, setApiPengurus] = useState([])
  const [apiSlides, setApiSlides] = useState([])
  const [apiPengaturan, setApiPengaturan] = useState(null)

  useEffect(() => {
    let cancelled = false
    Promise.allSettled([
      api.getKegiatan(),
      api.getKhutbah(),
      api.getPengurus(),
      api.getSlides(),
      api.getPengaturan(),
    ]).then(([kegiatan, khutbah, pengurus, slides, pengaturan]) => {
      if (cancelled) return
      if (kegiatan.status === 'fulfilled' && Array.isArray(kegiatan.value)) {
        setApiKegiatan(kegiatan.value.filter((k) => k && k.judul))
      }
      if (khutbah.status === 'fulfilled' && Array.isArray(khutbah.value)) {
        setApiKhutbah(khutbah.value)
      }
      if (pengurus.status === 'fulfilled' && Array.isArray(pengurus.value)) {
        setApiPengurus(pengurus.value.filter((p) => p && p.nama))
      }
      if (slides.status === 'fulfilled' && Array.isArray(slides.value)) {
        setApiSlides(slides.value.filter((s) => s && s.foto_url))
      }
      if (pengaturan.status === 'fulfilled' && pengaturan.value) {
        setApiPengaturan(pengaturan.value)
      }
    })
    return () => {
      cancelled = true
    }
  }, [])

  const shownActivities =
    apiKegiatan.length > 0
      ? apiKegiatan.map((k) => ({
          title: k.judul,
          schedule: formatTanggal(k.tanggal) || 'Kegiatan masjid',
          text: k.deskripsi || '',
          foto_url: k.foto_url,
        }))
      : activities
  const info = {
    name: apiPengaturan?.nama_masjid || mosque.name,
    address: apiPengaturan?.alamat || mosque.address,
    phone: apiPengaturan?.telepon ?? mosque.contact.phone,
    email: apiPengaturan?.email ?? mosque.contact.email,
    rekening: apiPengaturan?.rekening_infaq ?? mosque.infaqAccount,
    bank: apiPengaturan?.nama_bank ?? null,
  }
  const navItems = [
    ...NAV,
    ...(apiKhutbah.length > 0 ? [{ href: '#khutbah', label: 'Khutbah' }] : []),
    ...(apiPengurus.length > 0 ? [{ href: '#struktur', label: 'Struktur DKM' }] : []),
  ]

  return (
    <div className="min-h-screen bg-sand font-sans text-stone-900">
      {/* Navbar */}
      <header className="sticky top-0 z-50 border-b border-emerald-900/10 bg-sand/90 backdrop-blur">
        <div className="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
          <a href="#beranda" className="flex items-center gap-3">
            <DomeMark />
            <span className="leading-tight">
              <span className="block text-base font-extrabold text-emerald-950">
                Masjid Jami Baeturohman
              </span>
              <span className="block text-xs font-semibold tracking-wide text-amber-600">
                DESA BELAWA
              </span>
            </span>
          </a>
          <nav className="hidden items-center gap-6 text-sm font-semibold text-stone-700 md:flex">
            {navItems.map((n) => (
              <a key={n.href} href={n.href} className="hover:text-emerald-800">
                {n.label}
              </a>
            ))}
          </nav>
          <a
            href={adminLoginUrl}
            target="_blank"
            rel="noreferrer"
            className="hidden rounded-full bg-emerald-800 px-4 py-2 text-sm font-bold text-white hover:bg-emerald-900 md:block"
          >
            Login Admin
          </a>
          <button
            onClick={() => setOpen(!open)}
            className="rounded-lg border border-stone-300 px-3 py-2 text-sm font-bold md:hidden"
          >
            Menu
          </button>
        </div>
        {open && (
          <nav className="flex flex-col gap-1 border-t border-stone-200 px-4 py-3 text-sm font-semibold md:hidden">
            {navItems.map((n) => (
              <a
                key={n.href}
                href={n.href}
                onClick={() => setOpen(false)}
                className="rounded-lg px-2 py-2 hover:bg-emerald-50"
              >
                {n.label}
              </a>
            ))}
            <a
              href={adminLoginUrl}
              target="_blank"
              rel="noreferrer"
              className="rounded-lg bg-emerald-800 px-2 py-2 text-white hover:bg-emerald-900"
            >
              Login Admin
            </a>
          </nav>
        )}
      </header>

      {/* Hero: slide show dari API bila ada, hero teks bila tidak ada */}
      {apiSlides.length > 0 ? (
        <HeroSlideshow slides={apiSlides} />
      ) : (
      <section id="beranda" className="pattern-dark relative overflow-hidden bg-emerald-950 text-white">
        <div className="mx-auto max-w-6xl px-4 py-20 text-center sm:py-28">
          <p className="font-arabic text-3xl text-amber-300 sm:text-4xl">
            بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
          </p>
          <p className="mx-auto mt-4 max-w-xl text-sm text-emerald-200">
            Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang
          </p>
          <h1 className="mx-auto mt-8 max-w-3xl text-4xl font-extrabold leading-tight sm:text-6xl">
            Masjid Jami Baeturohman
          </h1>
          <p className="mt-3 text-lg font-semibold tracking-[0.25em] text-amber-400">
            DESA BELAWA
          </p>
          <p className="mx-auto mt-5 max-w-xl text-base text-emerald-100 sm:text-lg">
            {mosque.tagline} — rumah ibadah dan pembinaan umat bagi warga
            Desa Belawa dan sekitarnya.
          </p>
          <div className="mt-8 flex flex-wrap justify-center gap-3">
            <a
              href="#jadwal"
              className="rounded-full bg-amber-400 px-6 py-3 text-sm font-extrabold text-emerald-950 hover:bg-amber-300"
            >
              Lihat Jadwal Sholat
            </a>
            <a
              href="#kegiatan"
              className="rounded-full border border-white/40 px-6 py-3 text-sm font-bold text-white hover:bg-white/10"
            >
              Kegiatan Masjid
            </a>
          </div>
        </div>
      </section>
      )}

      {/* Fitur */}
      <section className="mx-auto max-w-6xl px-4 py-14">
        <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          {features.map((f) => (
            <div key={f.title} className="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm">
              <span className="text-3xl">{f.icon}</span>
              <h3 className="mt-3 text-lg font-bold text-emerald-950">{f.title}</h3>
              <p className="mt-1 text-sm leading-relaxed text-stone-600">{f.text}</p>
            </div>
          ))}
        </div>
      </section>

      {/* Tentang */}
      <section id="tentang" className="bg-white py-16">
        <div className="mx-auto grid max-w-6xl gap-10 px-4 md:grid-cols-2">
          <div>
            <p className="text-sm font-extrabold tracking-widest text-amber-600">TENTANG MASJID</p>
            <h2 className="mt-2 text-3xl font-extrabold text-emerald-950">
              Rumah Allah, Pusat Komunitas
            </h2>
            <p className="mt-4 leading-relaxed text-stone-600">{mosque.description}</p>
            <p className="mt-4 leading-relaxed text-stone-600">
              DKM Masjid Jami Baeturohman mengajak seluruh jamaah untuk
              memakmurkan masjid: hadir berjamaah, mengikuti kajian, menyekolahkan
              anak di TPA/TPQ, serta berbagi melalui infaq dan sedekah.
            </p>
          </div>
          <div className="pattern rounded-3xl border border-amber-200 bg-amber-50 p-6">
            <h3 className="text-lg font-bold text-emerald-950">Informasi Masjid</h3>
            <dl className="mt-4 space-y-3 text-sm">
              <div>
                <dt className="font-bold text-stone-500">Nama</dt>
                <dd className="font-semibold">{mosque.name}</dd>
              </div>
              <div>
                <dt className="font-bold text-stone-500">Lokasi</dt>
                <dd className="font-semibold">{mosque.village}</dd>
              </div>
              <div>
                <dt className="font-bold text-stone-500">Alamat</dt>
                <dd className="font-semibold">{mosque.address}</dd>
              </div>
              <div>
                <dt className="font-bold text-stone-500">Pengelola</dt>
                <dd className="font-semibold">Dewan Kemakmuran Masjid (DKM)</dd>
              </div>
            </dl>
          </div>
        </div>
      </section>

      {/* Jadwal sholat */}
      <section id="jadwal" className="mx-auto max-w-6xl px-4 py-16">
        <p className="text-sm font-extrabold tracking-widest text-amber-600">JADWAL SHOLAT</p>
        <h2 className="mt-2 text-3xl font-extrabold text-emerald-950">
          Waktu Sholat Hari Ini
        </h2>
        <p className="mt-2 max-w-2xl text-stone-600">
          Jadwal diperbarui otomatis setiap hari. Datanglah lebih awal agar
          dapat mengikuti sholat berjamaah dengan khusyuk.
        </p>
        <div className="mt-6">
          <PrayerTimes />
        </div>
      </section>

      {/* Jadwal Khutbah — hanya tampil bila backend mengembalikan data */}
      {apiKhutbah.length > 0 && (
        <section id="khutbah" className="bg-white py-16">
          <div className="mx-auto max-w-6xl px-4">
            <p className="text-sm font-extrabold tracking-widest text-amber-600">JADWAL KHUTBAH</p>
            <h2 className="mt-2 text-3xl font-extrabold text-emerald-950">
              Khutbah Jumat
            </h2>
            <div className="mt-8 overflow-x-auto rounded-3xl border border-stone-200">
              <table className="w-full min-w-[640px] text-left text-sm">
                <thead>
                  <tr className="bg-emerald-950 text-white">
                    <th className="px-4 py-3">Tanggal</th>
                    <th className="px-4 py-3">Khatib</th>
                    <th className="px-4 py-3">Imam</th>
                    <th className="px-4 py-3">Muadzin</th>
                    <th className="px-4 py-3">Tema</th>
                  </tr>
                </thead>
                <tbody>
                  {apiKhutbah.map((k) => (
                    <tr key={k.id} className="border-t border-stone-200">
                      <td className="px-4 py-3 font-semibold">{formatTanggal(k.tanggal)}</td>
                      <td className="px-4 py-3">{k.khatib}</td>
                      <td className="px-4 py-3">{k.imam}</td>
                      <td className="px-4 py-3">{k.muadzin}</td>
                      <td className="px-4 py-3">{k.tema}</td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </section>
      )}

      {/* Struktur DKM — hanya tampil bila backend mengembalikan data */}
      {apiPengurus.length > 0 && (
        <section id="struktur" className="mx-auto max-w-6xl px-4 py-16">
          <p className="text-sm font-extrabold tracking-widest text-amber-600">STRUKTUR DKM</p>
          <h2 className="mt-2 text-3xl font-extrabold text-emerald-950">
            Pengurus Masjid
          </h2>
          <div className="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            {apiPengurus.map((p) => (
              <article key={p.id} className="rounded-3xl border border-stone-200 bg-white p-6 text-center shadow-sm">
                {p.foto_url ? (
                  <img
                    src={p.foto_url}
                    alt={p.nama}
                    className="mx-auto h-32 w-24 rounded-2xl object-cover object-top"
                  />
                ) : (
                  <div className="mx-auto flex h-32 w-24 items-center justify-center rounded-2xl bg-emerald-100 text-2xl font-extrabold text-emerald-900">
                    {p.nama.charAt(0)}
                  </div>
                )}
                <h3 className="mt-3 text-lg font-bold text-emerald-950">{p.nama}</h3>
                <p className="mt-1 text-sm text-stone-600">{p.jabatan}</p>
              </article>
            ))}
          </div>
        </section>
      )}

      {/* Kegiatan */}
      <section id="kegiatan" className="bg-emerald-950 py-16 text-white">
        <div className="mx-auto max-w-6xl px-4">
          <p className="text-sm font-extrabold tracking-widest text-amber-400">KEGIATAN</p>
          <h2 className="mt-2 text-3xl font-extrabold">Program &amp; Kegiatan Rutin</h2>
          <div className="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {shownActivities.map((a) => (
              <article key={a.title} className="overflow-hidden rounded-3xl bg-white/10">
                {a.foto_url && (
                  <img src={a.foto_url} alt={a.title} className="h-44 w-full object-cover" />
                )}
                <div className="p-6">
                  <span className="rounded-full bg-amber-400 px-3 py-1 text-xs font-extrabold text-emerald-950">
                    {a.schedule}
                  </span>
                  <h3 className="mt-3 text-lg font-bold">{a.title}</h3>
                  <p className="mt-1 text-sm leading-relaxed text-emerald-100">{a.text}</p>
                </div>
              </article>
            ))}
          </div>
          <p className="mt-6 text-sm text-emerald-200">
            Jadwal lengkap kegiatan dapat dikonfirmasi langsung kepada pengurus DKM.
          </p>
        </div>
      </section>

      {/* Infaq */}
      <section id="infaq" className="mx-auto max-w-6xl px-4 py-16">
        <div className="pattern rounded-3xl border border-amber-200 bg-amber-50 p-8 text-center sm:p-12">
          <h2 className="text-3xl font-extrabold text-emerald-950">Infaq &amp; Sedekah</h2>
          <p className="mx-auto mt-3 max-w-xl text-stone-600">
            Setiap infaq yang Anda titipkan digunakan untuk operasional masjid,
            kegiatan pembinaan umat, dan kemaslahatan jamaah. Semoga menjadi
            amal jariyah yang terus mengalir.
          </p>
          {info.rekening ? (
            <p className="mx-auto mt-4 max-w-xl rounded-2xl bg-white p-4 text-sm font-semibold text-stone-700">
              {info.bank ? `${info.bank} — ` : ''}{info.rekening}
              <span className="block text-xs font-normal text-stone-500">
                Rekening infaq resmi Masjid Jami Baeturohman
              </span>
            </p>
          ) : (
            <p className="mx-auto mt-4 max-w-xl rounded-2xl bg-white p-4 text-sm font-semibold text-stone-700">
              Rekening resmi infaq akan diumumkan oleh pengurus DKM. Untuk
              berinfaq, silakan hubungi pengurus DKM atau datang langsung ke
              masjid.
            </p>
          )}
          <a
            href="#kontak"
            className="mt-6 inline-block rounded-full bg-emerald-800 px-6 py-3 text-sm font-extrabold text-white hover:bg-emerald-900"
          >
            Hubungi Pengurus DKM
          </a>
        </div>
      </section>

      {/* Kontak */}
      <section id="kontak" className="bg-white py-16">
        <div className="mx-auto max-w-6xl px-4">
          <p className="text-sm font-extrabold tracking-widest text-amber-600">KONTAK &amp; LOKASI</p>
          <h2 className="mt-2 text-3xl font-extrabold text-emerald-950">
            Kunjungi Masjid Kami
          </h2>
          <div className="mt-6 grid gap-4 sm:grid-cols-3">
            <div className="rounded-3xl border border-stone-200 p-6">
              <h3 className="font-bold text-emerald-950">Alamat</h3>
              <p className="mt-1 text-sm text-stone-600">{info.address}</p>
              <a
                href={mosque.mapsUrl}
                target="_blank"
                rel="noreferrer"
                className="mt-3 inline-block rounded-full bg-emerald-800 px-4 py-2 text-xs font-extrabold text-white hover:bg-emerald-900"
              >
                Lihat di Google Maps
              </a>
              <p className="mt-2 text-xs text-stone-500">Plus Code: {mosque.plusCode}</p>
            </div>
            <div className="rounded-3xl border border-stone-200 p-6">
              <h3 className="font-bold text-emerald-950">Telepon / WhatsApp</h3>
              <p className="mt-1 text-sm text-stone-600">
                {info.phone ?? 'Menunggu konfirmasi pengurus DKM'}
              </p>
              {info.email && (
                <p className="mt-1 text-sm text-stone-600">{info.email}</p>
              )}
            </div>
            <div className="rounded-3xl border border-stone-200 p-6">
              <h3 className="font-bold text-emerald-950">Pengelola</h3>
              <p className="mt-1 text-sm text-stone-600">
                Dewan Kemakmuran Masjid (DKM) Masjid Jami Baeturohman
              </p>
            </div>
          </div>
        </div>
      </section>

      <footer className="bg-emerald-950 py-8 text-center text-sm text-emerald-200">
        <p className="font-bold text-white">Masjid Jami Baeturohman — Desa Belawa</p>
        <p className="mt-1">Dikelola oleh Dewan Kemakmuran Masjid (DKM)</p>
      </footer>
    </div>
  )
}
