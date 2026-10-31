<?php

// CORS untuk frontend React (arsitektur split).
// Origin yang diizinkan diambil dari env FRONTEND_URL (boleh beberapa,
// dipisah koma). Bila tidak diisi, hanya Vite dev lokal yang diizinkan —
// di production JANGAN biarkan '*' : isi FRONTEND_URL dengan URL Vercel
// frontend, mis. https://masjid-jamie-baeturohman.vercel.app
$frontendOrigins = array_values(array_filter(array_map(
    fn ($o) => rtrim(trim($o), '/'),
    explode(',', (string) env('FRONTEND_URL', '')),
)));

if ($frontendOrigins === []) {
    $frontendOrigins = ['http://localhost:5173'];
}

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['GET', 'HEAD', 'OPTIONS'],
    'allowed_origins' => $frontendOrigins,
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    // API publik ini read-only dan tanpa cookie/session, jadi tidak
    // perlu supports_credentials.
    'supports_credentials' => false,
];
