<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    public function run(): void
    {
        // SENGAJA TIDAK MEMBUAT SLIDE CONTOH BERFOTO.
        // Tidak ada foto asli masjid yang diberikan, dan foto masjid
        // TIDAK BOLEH dikarang. Selama belum ada slide yang diupload,
        // beranda tetap menampilkan hero teks seperti sekarang.
        // Admin wajib mengupload foto masjid asli lewat
        // Panel Admin > Slide Show > Tambah Slide Show.
    }
}
