<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilParoki extends Model
{
    use HasFactory;

    protected $table = 'profil_paroki';

    protected $fillable = [
        'nama_paroki',
        'keuskupan',
        'pelindung',
        'pesta_nama',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'telepon',
        'email',
        'whatsapp',
        'google_maps_embed',
        'latitude',
        'longitude',
        'deskripsi_singkat',
        'sambutan_pastor',
        'visi',
        'misi',
        'foto_gereja_utama',
    ];
}

