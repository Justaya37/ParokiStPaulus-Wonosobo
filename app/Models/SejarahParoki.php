<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahParoki extends Model
{
    use HasFactory;

    protected $table = 'sejarah_parokis';

    protected $fillable = [
        'tahun',
        'judul_peristiwa',
        'deskripsi',
        'foto',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
        ];
    }
}

