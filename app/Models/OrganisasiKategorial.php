<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiKategorial extends Model
{
    use HasFactory;

    protected $table = 'organisasi_kategorials';

    protected $fillable = [
        'kode_organisasi',
        'nama_organisasi',
        'deskripsi',
        'visi_misi',
        'ketua',
        'pembina',
        'jadwal_kegiatan_rutin',
        'kontak',
        'logo',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
        ];
    }
}

