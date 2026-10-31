<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;

class PengaturanController extends Controller
{
    public function edit()
    {
        return view('admin.pengaturan.edit', ['setting' => Setting::current()]);
    }

    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::query()->first();

        if ($setting) {
            $setting->update($request->validated());
        } else {
            Setting::create($request->validated());
        }

        return redirect()->route('admin.pengaturan.edit')->with('success', 'Pengaturan masjid berhasil disimpan.');
    }
}
