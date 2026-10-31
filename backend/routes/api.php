<?php

use App\Http\Controllers\Api\PublicController;
use Illuminate\Support\Facades\Route;

// API publik read-only untuk frontend React. Hanya GET, tanpa auth.
// Penulisan data (tambah/edit/hapus) tetap lewat panel admin Blade.
// Prefix "/api" ditambahkan otomatis oleh Laravel (bootstrap/app.php).
Route::get('/kegiatan', [PublicController::class, 'kegiatan']);
Route::get('/kegiatan/{id}', [PublicController::class, 'kegiatanShow'])->whereNumber('id');
Route::get('/khutbah', [PublicController::class, 'khutbah']);
Route::get('/pengurus', [PublicController::class, 'pengurus']);
Route::get('/slides', [PublicController::class, 'slides']);
Route::get('/pengaturan', [PublicController::class, 'pengaturan']);
