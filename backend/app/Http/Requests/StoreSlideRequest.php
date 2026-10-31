<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'judul' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'urutan' => ['required', 'integer', 'min:0'],
            'aktif' => ['required', 'boolean'],
        ];
    }
}
