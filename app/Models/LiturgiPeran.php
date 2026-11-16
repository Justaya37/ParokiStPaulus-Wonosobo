<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiturgiPeran extends Model
{
    use HasFactory;

    protected $table = 'liturgi_perans';

    protected $fillable = [
        'nama_peran',
        'deskripsi',
    ];

    public function jadwalPetugasLiturgis(): HasMany
    {
        return $this->hasMany(JadwalPetugasLiturgi::class);
    }
}

