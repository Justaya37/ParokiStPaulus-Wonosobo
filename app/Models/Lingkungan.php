<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lingkungan extends Model
{
    use HasFactory;

    protected $table = 'lingkungans';

    protected $fillable = [
        'nomor_lingkungan',
        'nama_lingkungan',
        'nama_pelindung',
        'wilayah',
        'ketua_lingkungan',
        'kontak',
        'jumlah_kk',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_kk' => 'integer',
        ];
    }

    public function jadwalPetugasLiturgis(): HasMany
    {
        return $this->hasMany(JadwalPetugasLiturgi::class);
    }
}

