<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKhutbahRequest;
use App\Http\Requests\UpdateKhutbahRequest;
use App\Models\Khutbah;

class KhutbahController extends Controller
{
    public function index()
    {
        return view('admin.khutbah.index', [
            'items' => Khutbah::query()->orderBy('tanggal', 'desc')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.khutbah.create');
    }

    public function store(StoreKhutbahRequest $request)
    {
        Khutbah::create($request->validated());

        return redirect()->route('admin.khutbah.index')->with('success', 'Jadwal khutbah berhasil ditambahkan.');
    }

    public function show(Khutbah $khutbah)
    {
        return view('admin.khutbah.show', ['item' => $khutbah]);
    }

    public function edit(Khutbah $khutbah)
    {
        return view('admin.khutbah.edit', ['item' => $khutbah]);
    }

    public function update(UpdateKhutbahRequest $request, Khutbah $khutbah)
    {
        $khutbah->update($request->validated());

        return redirect()->route('admin.khutbah.index')->with('success', 'Jadwal khutbah berhasil diperbarui.');
    }

    public function destroy(Khutbah $khutbah)
    {
        $khutbah->delete();

        return redirect()->route('admin.khutbah.index')->with('success', 'Jadwal khutbah berhasil dihapus.');
    }
}
