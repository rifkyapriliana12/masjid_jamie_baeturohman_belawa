<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'foto',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
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
