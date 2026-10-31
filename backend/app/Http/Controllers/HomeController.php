<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Khutbah;
use App\Models\Pengurus;
use App\Models\Setting;
use App\Models\Slide;
use App\Services\PrayerTimesService;

class HomeController extends Controller
{
    public function index(PrayerTimesService $prayer)
    {
        return view('home', [
            'setting' => Setting::current(),
            'prayer' => $prayer->today(),
            'kegiatans' => Kegiatan::query()->orderBy('tanggal', 'desc')->take(9)->get(),
            'khutbahs' => Khutbah::query()->orderBy('tanggal', 'desc')->take(6)->get(),
            'pengurus' => Pengurus::query()->orderBy('urutan')->orderBy('nama')->get(),
            'slides' => Slide::query()->aktif()->orderBy('urutan')->orderBy('id')->get(),
        ]);
    }

    public function showKegiatan(Kegiatan $kegiatan)
    {
        return view('kegiatan-show', [
            'setting' => Setting::current(),
            'kegiatan' => $kegiatan,
            'lainnya' => Kegiatan::query()->where('id', '!=', $kegiatan->id)->orderBy('tanggal', 'desc')->take(3)->get(),
        ]);
    }
}
