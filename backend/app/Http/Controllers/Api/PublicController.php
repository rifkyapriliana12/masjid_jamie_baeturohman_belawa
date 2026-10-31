<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Khutbah;
use App\Models\Pengurus;
use App\Models\Setting;
use App\Models\Slide;
use Illuminate\Http\JsonResponse;

/**
 * API publik read-only untuk frontend React.
 * Hanya GET, tanpa auth. Tidak ada endpoint tulis di sini;
 * semua penulisan data tetap lewat panel admin Blade (auth).
 */
class PublicController extends Controller
{
    /**
     * Ubah path foto relatif dari Storage (mis. "/storage/...") menjadi
     * URL lengkap berdasarkan APP_URL backend, supaya bisa dipakai
     * langsung oleh frontend di domain lain. Bila tidak ada foto,
     * kembalikan null — bukan URL palsu.
     */
    private function fullFotoUrl(?string $relative): ?string
    {
        if (! $relative) {
            return null;
        }

        if (str_starts_with($relative, 'http://') || str_starts_with($relative, 'https://')) {
            return $relative;
        }

        return url($relative);
    }

    private function kegiatanItem(Kegiatan $k): array
    {
        return [
            'id' => $k->id,
            'judul' => $k->judul,
            'deskripsi' => $k->deskripsi,
            'tanggal' => $k->tanggal?->toDateString(),
            'foto_url' => $this->fullFotoUrl($k->fotoUrl()),
        ];
    }

    private function khutbahItem(Khutbah $k): array
    {
        return [
            'id' => $k->id,
            'tanggal' => $k->tanggal?->toDateString(),
            'khatib' => $k->khatib,
            'imam' => $k->imam,
            'muadzin' => $k->muadzin,
            'tema' => $k->tema,
        ];
    }

    private function pengurusItem(Pengurus $p): array
    {
        return [
            'id' => $p->id,
            'nama' => $p->nama,
            'jabatan' => $p->jabatan,
            'urutan' => $p->urutan,
            'foto_url' => $this->fullFotoUrl($p->fotoUrl()),
        ];
    }

    private function slideItem(Slide $s): array
    {
        return [
            'id' => $s->id,
            'judul' => $s->judul,
            'keterangan' => $s->keterangan,
            'urutan' => $s->urutan,
            'foto_url' => $this->fullFotoUrl($s->fotoUrl()),
        ];
    }

    public function kegiatan(): JsonResponse
    {
        $items = Kegiatan::query()->orderBy('tanggal', 'desc')->get();

        return response()->json(['data' => $items->map(fn ($k) => $this->kegiatanItem($k))->all()]);
    }

    public function kegiatanShow(int $id): JsonResponse
    {
        $kegiatan = Kegiatan::query()->find($id);

        if (! $kegiatan) {
            return response()->json(['message' => 'Kegiatan tidak ditemukan.'], 404);
        }

        return response()->json(['data' => $this->kegiatanItem($kegiatan)]);
    }

    public function khutbah(): JsonResponse
    {
        $items = Khutbah::query()->orderBy('tanggal', 'desc')->get();

        return response()->json(['data' => $items->map(fn ($k) => $this->khutbahItem($k))->all()]);
    }

    public function pengurus(): JsonResponse
    {
        $items = Pengurus::query()->orderBy('urutan')->orderBy('nama')->get();

        return response()->json(['data' => $items->map(fn ($p) => $this->pengurusItem($p))->all()]);
    }

    public function slides(): JsonResponse
    {
        $items = Slide::query()->aktif()->orderBy('urutan')->orderBy('id')->get();

        return response()->json(['data' => $items->map(fn ($s) => $this->slideItem($s))->all()]);
    }

    public function pengaturan(): JsonResponse
    {
        $s = Setting::current();

        // Hanya field publik. Nilai kosong dikembalikan sebagai null,
        // bukan dikarang — frontend menampilkannya sebagai "belum diisi".
        return response()->json(['data' => [
            'nama_masjid' => $s->nama_masjid ?: null,
            'alamat' => $s->alamat ?: null,
            'telepon' => $s->telepon ?: null,
            'email' => $s->email ?: null,
            'rekening_infaq' => $s->rekening_infaq ?: null,
            'nama_bank' => $s->nama_bank ?: null,
        ]]);
    }
}
