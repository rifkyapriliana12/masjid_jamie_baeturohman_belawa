<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // Kontak dan rekening sengaja kosong: belum dikonfirmasi DKM.
        // Jangan diisi nomor karangan — isi lewat menu Admin > Pengaturan.
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'nama_masjid' => config('mosque.name'),
                'alamat' => config('mosque.address'),
                'telepon' => null,
                'email' => null,
                'rekening_infaq' => null,
                'nama_bank' => null,
            ]
        );
    }
}
