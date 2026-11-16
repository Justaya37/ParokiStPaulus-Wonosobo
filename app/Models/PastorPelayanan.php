<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PastorPelayanan extends Model
{
    use HasFactory;

    protected $table = 'pastor_pelayanans';

    protected $fillable = [
        'pastor_id',
        'jabatan',
        'tahun_mulai',
        'tahun_selesai',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tahun_mulai' => 'integer',
            'tahun_selesai' => 'integer',
        ];
    }

    public function pastor(): BelongsTo
    {
        return $this->belongsTo(Pastor::class);
    }
}

