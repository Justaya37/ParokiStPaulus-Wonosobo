<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Renungan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'renungans';

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'ayat_bacaan',
        'tanggal_renungan',
        'isi',
        'gambar_sampul',
        'status',
        'published_at',
        'view_count',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_renungan' => 'date',
            'published_at' => 'datetime',
            'view_count' => 'integer',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at !== null && $this->published_at->isPast();
    }
}

