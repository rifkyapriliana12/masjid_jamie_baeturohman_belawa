<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PrayerTimesService
{
    /**
     * Jadwal sholat hari ini dari API Aladhan, metode Kemenag RI (20),
     * wilayah Cirebon — sama seperti versi React lama.
     * Mengembalikan null bila API tidak dapat dihubungi, agar halaman
     * publik tetap tampil dengan pesan ramah, bukan error 500.
     *
     * @return array{timings: array<string,string>, hijri: array, date: array}|null
     */
    public function today(): ?array
    {
        try {
            $response = Http::timeout(10)->get('https://api.aladhan.com/v1/timingsByCity', [
                'city' => config('mosque.prayer_city', 'Cirebon'),
                'country' => config('mosque.prayer_country', 'Indonesia'),
                'method' => config('mosque.prayer_method', 20),
            ]);

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json('data');

            if (! is_array($data) || empty($data['timings'])) {
                return null;
            }

            return $data;
        } catch (\Throwable $e) {
            report($e);

            return null;
        }
    }
}
