<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        return view('admin.slides.index', [
            'items' => Slide::query()->orderBy('urutan')->orderBy('id')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(StoreSlideRequest $request)
    {
        $data = $request->validated();
        $data['foto'] = $request->file('foto')->store('slides', 'public');

        Slide::create($data);

        return redirect()->route('admin.slides.index')->with('success', 'Slide show berhasil ditambahkan.');
    }

    public function show(Slide $slide)
    {
        return view('admin.slides.show', ['item' => $slide]);
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', ['item' => $slide]);
    }

    public function update(UpdateSlideRequest $request, Slide $slide)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($slide->foto) {
                Storage::disk('public')->delete($slide->foto);
            }
            $data['foto'] = $request->file('foto')->store('slides', 'public');
        }

        $slide->update($data);

        return redirect()->route('admin.slides.index')->with('success', 'Slide show berhasil diperbarui.');
    }

    public function destroy(Slide $slide)
    {
        if ($slide->foto) {
            Storage::disk('public')->delete($slide->foto);
        }

        $slide->delete();

        return redirect()->route('admin.slides.index')->with('success', 'Slide show berhasil dihapus.');
    }
}
