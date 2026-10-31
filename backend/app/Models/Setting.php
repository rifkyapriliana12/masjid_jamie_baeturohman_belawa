<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'nama_masjid',
        'alamat',
        'telepon',
        'email',
        'rekening_infaq',
        'nama_bank',
    ];

    /**
     * Ambil baris pengaturan tunggal. Jika belum ada, kembalikan model
     * baru berisi nilai default dari config/mosque.php (kontak dan
     * rekening tetap kosong = "belum diisi").
     */
    public static function current(): self
    {
        $setting = self::query()->first();

        if ($setting) {
            return $setting;
        }

        return new self([
            'nama_masjid' => config('mosque.name'),
            'alamat' => config('mosque.address'),
            'telepon' => null,
            'email' => null,
            'rekening_infaq' => null,
            'nama_bank' => null,
        ]);
    }

    public function infaqTersedia(): bool
    {
        return filled($this->rekening_infaq);
    }
}
