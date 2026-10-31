<?php

// Titik masuk Vercel untuk aplikasi Laravel ini.
// Vercel menjalankan fungsi serverless dari folder api/, sedangkan
// aplikasi Laravel sendiri tetap dilayani dari public/index.php.
// File ini HANYA meneruskan request ke sana, tanpa mengubah
// public/index.php dan tanpa logika aplikasi apa pun.
require __DIR__ . '/../public/index.php';
