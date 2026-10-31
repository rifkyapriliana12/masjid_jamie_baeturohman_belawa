// ============================================================
//  API BACKEND LARAVEL — dipakai bila backend sudah live.
//  Base URL dari env Vite: VITE_API_URL
//  - Lokal (php artisan serve): http://127.0.0.1:8000
//  - Produksi: URL backend Laravel yang sudah live.
//  Bila tidak diisi di .env, default ke http://127.0.0.1:8000.
//  Bila backend tidak terjangkau, fungsi-fungsi di bawah melempar
//  error dan App.jsx akan memakai data statis dari data.js (fallback),
//  jadi situs React di Vercel tetap tampil walau backend belum live.
// ============================================================

export const API_BASE = (
  import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000'
).replace(/\/+$/, '')

const TIMEOUT_MS = 8000

async function fetchJson(path) {
  const controller = new AbortController()
  const timer = setTimeout(() => controller.abort(), TIMEOUT_MS)
  try {
    const res = await fetch(`${API_BASE}${path}`, {
      signal: controller.signal,
      headers: { Accept: 'application/json' },
    })
    if (!res.ok) {
      throw new Error(`API ${path} mengembalikan status ${res.status}`)
    }
    const json = await res.json()
    return json?.data ?? null
  } catch (err) {
    // Pesan ramah untuk log/debug; App.jsx yang memutuskan fallback.
    if (err?.name === 'AbortError') {
      throw new Error(`API ${path} timeout setelah ${TIMEOUT_MS} ms`)
    }
    throw err
  } finally {
    clearTimeout(timer)
  }
}

export const api = {
  getKegiatan: () => fetchJson('/api/kegiatan'),
  getKegiatanById: (id) => fetchJson(`/api/kegiatan/${id}`),
  getKhutbah: () => fetchJson('/api/khutbah'),
  getPengurus: () => fetchJson('/api/pengurus'),
  getSlides: () => fetchJson('/api/slides'),
  getPengaturan: () => fetchJson('/api/pengaturan'),
}

export default api
