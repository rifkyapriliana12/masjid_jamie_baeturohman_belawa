<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nama_masjid' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:500'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'rekening_infaq' => ['nullable', 'string', 'max:100'],
            'nama_bank' => ['nullable', 'string', 'max:100'],
        ];
    }
}
