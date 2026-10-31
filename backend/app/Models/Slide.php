<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';

    protected $fillable = [
        'foto',
        'judul',
        'keterangan',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
            'aktif' => 'boolean',
        ];
    }

    public function fotoUrl(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        return Storage::disk('public')->url($this->foto);
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}
