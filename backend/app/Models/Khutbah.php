<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khutbah extends Model
{
    use HasFactory;

    protected $table = 'khutbahs';

    protected $fillable = [
        'tanggal',
        'khatib',
        'imam',
        'muadzin',
        'tema',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}
