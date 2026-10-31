<?php

namespace Database\Seeders;

use App\Models\Pengurus;
use Illuminate\Database\Seeder;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        // DATA CONTOH — jabatan di bawah ini hanya kerangka struktur DKM.
        // Nama asli pengurus TIDAK dikarang di sini; isi lewat Admin > Struktur DKM.
        $items = [
            ['nama' => 'Belum diisi', 'jabatan' => 'Ketua DKM', 'urutan' => 1],
            ['nama' => 'Belum diisi', 'jabatan' => 'Wakil Ketua DKM', 'urutan' => 2],
            ['nama' => 'Belum diisi', 'jabatan' => 'Sekretaris', 'urutan' => 3],
            ['nama' => 'Belum diisi', 'jabatan' => 'Bendahara', 'urutan' => 4],
        ];

        foreach ($items as $item) {
            Pengurus::updateOrCreate(['jabatan' => $item['jabatan']], $item);
        }
    }
}
