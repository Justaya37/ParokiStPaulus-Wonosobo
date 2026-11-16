<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsitekturFilosofi extends Model
{
    use HasFactory;

    protected $table = 'arsitektur_filosofis';

    protected $fillable = [
        'nama_arsitektur',
        'konsep_utama',
        'inkulturasi',
        'deskripsi_lengkap',
        'foto_arsitektur',
    ];
}

