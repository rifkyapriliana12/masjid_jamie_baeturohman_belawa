<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
        ];
    }

    public function fotoUrl(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        return Storage::disk('public')->url($this->foto);
    }
}
