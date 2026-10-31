<?php

use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KhutbahController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kegiatan/{kegiatan}', [HomeController::class, 'showKegiatan'])->name('kegiatan.show');

// Login / logout admin (tanpa registrasi publik)
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

// Area admin — wajib login (middleware auth bawaan Laravel)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('slides', SlideController::class);
    Route::resource('khutbah', KhutbahController::class);
    Route::resource('pengurus', PengurusController::class);

    Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});
