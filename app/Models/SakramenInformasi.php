<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakramenInformasi extends Model
{
    use HasFactory;

    protected $table = 'sakramen_informasis';

    protected $fillable = [
        'kode_sakramen',
        'nama_sakramen',
        'deskripsi_teologis',
        'persyaratan',
        'prosedur_pelayanan',
        'jadwal_pelayanan_rutin',
        'kontak_layanan',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
        ];
    }
}

