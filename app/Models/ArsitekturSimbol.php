<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsitekturSimbol extends Model
{
    use HasFactory;

    protected $table = 'arsitektur_simbols';

    protected $fillable = [
        'nomor_simbol',
        'nama_simbol',
        'arti_filosofis',
        'makna_teologis',
        'lokasi_pada_gereja',
        'foto_simbol',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'nomor_simbol' => 'integer',
            'urutan' => 'integer',
        ];
    }
}

