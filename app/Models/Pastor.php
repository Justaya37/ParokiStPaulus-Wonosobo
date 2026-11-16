<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pastor extends Model
{
    use HasFactory;

    protected $table = 'pastors';

    protected $fillable = [
        'nama_lengkap',
        'gelar_sebutan',
        'tahbisan_date',
        'status_pelayanan',
        'foto',
        'keterangan',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'tahbisan_date' => 'date',
            'urutan' => 'integer',
        ];
    }

    public function pelayanans(): HasMany
    {
        return $this->hasMany(PastorPelayanan::class)->orderBy('tahun_mulai', 'asc');
    }
}

