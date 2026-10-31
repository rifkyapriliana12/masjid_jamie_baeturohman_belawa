<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        // DATA CONTOH — berasal dari versi React lama (src/data.js).
        // Hapus / ubah lewat panel admin setelah data asli dimasukkan.
        $items = [
            ['judul' => 'Sholat Lima Waktu Berjamaah', 'deskripsi' => 'Sholat Subuh, Dzuhur, Ashar, Maghrib, dan Isya dilaksanakan berjamaah di masjid.', 'tanggal' => '2026-10-31'],
            ['judul' => 'Sholat Jumat', 'deskripsi' => 'Khutbah dan Sholat Jumat berjamaah bersama seluruh jamaah Desa Belawa.', 'tanggal' => '2026-10-30'],
            ['judul' => 'Pengajian Rutin', 'deskripsi' => 'Kajian kitab dan tausiyah bersama ustadz, untuk jamaah bapak, ibu, dan remaja.', 'tanggal' => '2026-10-29'],
            ['judul' => 'TPA & TPQ', 'deskripsi' => 'Belajar membaca Al-Qur’an, hafalan surat pendek, dan praktik ibadah untuk anak-anak.', 'tanggal' => '2026-10-28'],
            ['judul' => 'Peringatan Hari Besar Islam', 'deskripsi' => 'Isra Mi’raj, Maulid Nabi Muhammad SAW, pesantren kilat Ramadhan, dan qurban Idul Adha.', 'tanggal' => '2026-10-27'],
            ['judul' => 'Kegiatan Sosial', 'deskripsi' => 'Santunan, bakti sosial, dan gotong royong jamaah untuk kemaslahatan warga sekitar.', 'tanggal' => '2026-10-26'],
        ];

        foreach ($items as $item) {
            Kegiatan::updateOrCreate(['judul' => $item['judul']], $item);
        }
    }
}
