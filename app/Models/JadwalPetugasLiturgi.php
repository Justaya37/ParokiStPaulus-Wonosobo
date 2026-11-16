<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPetugasLiturgi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_petugas_liturgis';

    protected $fillable = [
        'jadwal_ekaristi_id',
        'liturgi_peran_id',
        'lingkungan_id',
        'nama_petugas',
        'kontak',
        'catatan',
    ];

    public function jadwalEkaristi(): BelongsTo
    {
        return $this->belongsTo(JadwalEkaristi::class);
    }

    public function peran(): BelongsTo
    {
        return $this->belongsTo(LiturgiPeran::class, 'liturgi_peran_id');
    }

    public function lingkungan(): BelongsTo
    {
        return $this->belongsTo(Lingkungan::class);
    }
}

