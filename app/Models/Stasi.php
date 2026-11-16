<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stasi extends Model
{
    use HasFactory;

    protected $table = 'stasis';

    protected $fillable = [
        'nama_stasi',
        'nama_pelindung',
        'lokasi_desa_kecamatan',
        'jarak_dari_pusat_km',
        'ketua_stasi',
        'kontak',
        'kapasitas_umat',
        'foto_gereja_stasi',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jarak_dari_pusat_km' => 'decimal:2',
            'kapasitas_umat' => 'integer',
        ];
    }

    public function jadwalEkaristis(): HasMany
    {
        return $this->hasMany(JadwalEkaristi::class);
    }
}

