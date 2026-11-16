<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'audit_logs';

    protected $fillable = [
        'user_id',
        'role_name',
        'aksi',
        'entitas',
        'entitas_id',
        'data_lama',
        'data_baru',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'data_lama' => 'array',
            'data_baru' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function log(
        string $aksi,
        string $entitas,
        ?int $entitasId = null,
        ?array $dataLama = null,
        ?array $dataBaru = null
    ): self {
        $user = auth()->user();

        return self::create([
            'user_id' => $user?->id,
            'role_name' => $user?->role?->name ?? 'system',
            'aksi' => strtoupper($aksi),
            'entitas' => $entitas,
            'entitas_id' => $entitasId,
            'data_lama' => $dataLama,
            'data_baru' => $dataBaru,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }
}

