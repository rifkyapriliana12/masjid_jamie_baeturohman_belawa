<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Akun demo lokal saja, BUKAN kredensial asli siapa pun.
        // Segera ganti passwordnya setelah login pertama (lihat README).
        User::updateOrCreate(
            ['email' => 'admin@baeturohman.test'],
            [
                'name' => 'Admin Masjid',
                'password' => Hash::make('admin12345'),
            ]
        );
    }
}
