<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        return view('admin.kegiatan.index', [
            'items' => Kegiatan::query()->orderBy('tanggal', 'desc')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(StoreKegiatanRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.show', ['item' => $kegiatan]);
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', ['item' => $kegiatan]);
    }

    public function update(UpdateKegiatanRequest $request, Kegiatan $kegiatan)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $data['foto'] = $request->file('foto')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
