<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengurusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan' => ['required', 'integer', 'min:0'],
        ];
    }
}
