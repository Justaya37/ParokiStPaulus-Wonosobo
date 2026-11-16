<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WartaParoki extends Model
{
    use HasFactory;

    protected $table = 'warta_parokis';

    protected $fillable = [
        'user_id',
        'judul',
        'edisi',
        'tanggal_terbit',
        'deskripsi',
        'file_path',
        'file_size_bytes',
        'download_count',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
            'published_at' => 'datetime',
            'file_size_bytes' => 'integer',
            'download_count' => 'integer',
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function getFormattedFileSizeAttribute(): string
    {
        if (!$this->file_size_bytes) {
            return '-';
        }
        $kb = $this->file_size_bytes / 1024;
        if ($kb < 1024) {
            return round($kb, 1) . ' KB';
        }
        return round($kb / 1024, 2) . ' MB';
    }
}

