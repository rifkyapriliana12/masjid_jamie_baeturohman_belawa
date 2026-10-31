<?php

namespace Database\Seeders;

use App\Models\Khutbah;
use Illuminate\Database\Seeder;

class KhutbahSeeder extends Seeder
{
    public function run(): void
    {
        // DATA CONTOH — nama khatib/imam/muadzin di bawah ini BUKAN nama
        // pengurus asli. Ganti dengan jadwal asli lewat Admin > Jadwal Khutbah.
        $items = [
            ['tanggal' => '2026-11-06', 'khatib' => 'Contoh: Ustadz Ahmad', 'imam' => 'Contoh: Ustadz Budi', 'muadzin' => 'Contoh: Bapak Candra', 'tema' => 'Contoh tema khutbah — ganti dengan tema asli'],
            ['tanggal' => '2026-11-13', 'khatib' => 'Contoh: Ustadz Ahmad', 'imam' => 'Contoh: Ustadz Budi', 'muadzin' => 'Contoh: Bapak Candra', 'tema' => 'Contoh tema khutbah — ganti dengan tema asli'],
        ];

        foreach ($items as $item) {
            Khutbah::updateOrCreate(['tanggal' => $item['tanggal']], $item);
        }
    }
}
