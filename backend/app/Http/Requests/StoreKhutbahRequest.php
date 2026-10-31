<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKhutbahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'tanggal' => ['required', 'date'],
            'khatib' => ['required', 'string', 'max:255'],
            'imam' => ['required', 'string', 'max:255'],
            'muadzin' => ['required', 'string', 'max:255'],
            'tema' => ['nullable', 'string', 'max:255'],
        ];
    }
}
