<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengurusRequest;
use App\Http\Requests\UpdatePengurusRequest;
use App\Models\Pengurus;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        return view('admin.pengurus.index', [
            'items' => Pengurus::query()->orderBy('urutan')->orderBy('nama')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.pengurus.create');
    }

    public function store(StorePengurusRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        Pengurus::create($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus)
    {
        return view('admin.pengurus.show', ['item' => $pengurus]);
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.edit', ['item' => $pengurus]);
    }

    public function update(UpdatePengurusRequest $request, Pengurus $pengurus)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil dihapus.');
    }
}
