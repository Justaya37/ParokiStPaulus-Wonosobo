<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalEkaristi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ekaristis';

    protected $fillable = [
        'stasi_id',
        'nama_perayaan',
        'tipe_perayaan',
        'lokasi_keterangan',
        'hari',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'bahasa',
        'keterangan',
        'is_aktif',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'is_aktif' => 'boolean',
        ];
    }

    // stasi_id NULL indicates Gereja Utama Paroki Santo Paulus Wonosobo
    public function stasi(): BelongsTo
    {
        return $this->belongsTo(Stasi::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function petugasLiturgis(): HasMany
    {
        return $this->hasMany(JadwalPetugasLiturgi::class);
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('is_aktif', true);
    }

    public function scopeGerejaUtama(Builder $query): Builder
    {
        return $query->whereNull('stasi_id');
    }

    public function scopeStasi(Builder $query): Builder
    {
        return $query->whereNotNull('stasi_id');
    }

    public function getLokasiDisplayAttribute(): string
    {
        if ($this->stasi_id && $this->stasi) {
            return $this->stasi->nama_stasi . ($this->lokasi_keterangan ? ' (' . $this->lokasi_keterangan . ')' : '');
        }
        return 'Gereja Utama Santo Paulus Wonosobo' . ($this->lokasi_keterangan ? ' (' . $this->lokasi_keterangan . ')' : '');
    }
}

