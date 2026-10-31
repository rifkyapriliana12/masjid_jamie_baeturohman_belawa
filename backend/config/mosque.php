<?php

// Konten awal dari versi React lama (src/data.js). Nilai yang belum
// dikonfirmasi DKM sengaja dikosongkan dan akan ditampilkan sebagai
// "belum diisi" di halaman publik, bukan dikarang.
return [
    'name' => 'Masjid Jami Baeturohman',
    'village' => 'Desa Belawa',
    'tagline' => 'Pusat Ibadah, Ilmu, dan Kebersamaan Umat',
    'description' => 'Masjid Jami Baeturohman adalah masjid jami kebanggaan warga Desa Belawa. '
        . 'Selain menjadi pusat pelaksanaan sholat lima waktu dan Sholat Jumat, masjid ini '
        . 'menjadi pusat pembinaan umat: pengajian rutin, pendidikan Al-Qur’an bagi anak-anak, '
        . 'peringatan hari besar Islam, serta kegiatan sosial kemasyarakatan. '
        . 'Dikelola oleh Dewan Kemakmuran Masjid (DKM) bersama jamaah, masjid ini terbuka '
        . 'untuk seluruh umat yang ingin beribadah, belajar, dan berbagi.',
    'address' => 'Jl. Wangkelang, Belawa, Kec. Lemahabang, Kab. Cirebon, Jawa Barat 45183',
    'maps_url' => 'https://www.google.com/maps/place/Masjid+Baiturrohman+Desa+Belawa/@-6.8338184,108.5836161,17z',
    'plus_code' => '5H8M+FCH',
    'prayer_city' => 'Cirebon',
    'prayer_country' => 'Indonesia',
    'prayer_method' => 20, // Metode Kemenag RI, sama seperti versi React lama.
    'features' => [
        ['icon' => '🕌', 'title' => 'Sholat Jumat', 'text' => 'Sholat Jumat berjamaah setiap pekan, terbuka untuk seluruh jamaah Desa Belawa dan sekitarnya.'],
        ['icon' => '📖', 'title' => 'Pengajian Rutin', 'text' => 'Kajian dan pengajian rutin untuk memperdalam ilmu agama bagi bapak, ibu, dan remaja masjid.'],
        ['icon' => '🧒', 'title' => 'TPA & TPQ Anak', 'text' => 'Pendidikan Al-Qur’an bagi anak-anak: belajar membaca, menghafal, dan adab Islami sejak dini.'],
        ['icon' => '🌙', 'title' => 'Hari Besar Islam', 'text' => 'Peringatan Isra Mi’raj, Maulid Nabi, Ramadhan, Idul Fitri, dan Idul Adha bersama jamaah.'],
    ],
];
