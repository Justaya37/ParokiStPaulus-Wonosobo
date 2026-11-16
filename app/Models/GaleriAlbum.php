<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class GaleriAlbum extends Model
{
    use HasFactory;

    protected $table = 'galeri_albums';

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'deskripsi',
        'tanggal_kegiatan',
        'cover_foto',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kegiatan' => 'date',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fotos(): HasMany
    {
        return $this->hasMany(GaleriFoto::class)->orderBy('urutan', 'asc');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function getCoverUrlAttribute(): ?string
    {
        // 1. Try explicit cover_foto
        if ($this->cover_foto && Storage::disk('public')->exists($this->cover_foto)) {
            return asset('storage/' . $this->cover_foto);
        }

        // 2. Fall back to first photo of album
        $firstFoto = $this->fotos->first();
        if ($firstFoto && $firstFoto->file_path && Storage::disk('public')->exists($firstFoto->file_path)) {
            return asset('storage/' . $firstFoto->file_path);
        }

        return null;
    }
}

