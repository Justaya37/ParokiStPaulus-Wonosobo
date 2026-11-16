<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'no_hp',
        'status_aktif',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status_aktif' => 'boolean',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class);
    }

    public function renungans(): HasMany
    {
        return $this->hasMany(Renungan::class);
    }

    public function wartaParokis(): HasMany
    {
        return $this->hasMany(WartaParoki::class);
    }

    public function galeriAlbums(): HasMany
    {
        return $this->hasMany(GaleriAlbum::class);
    }

    public function agendaKegiatans(): HasMany
    {
        return $this->hasMany(AgendaKegiatan::class, 'created_by');
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }

    // Role helper methods
    public function hasRole(string|array $roles): bool
    {
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }

        $roleName = $this->role?->name;
        if (is_array($roles)) {
            return in_array($roleName, $roles, true);
        }
        return $roleName === $roles;
    }

    public function isAdminSekretariat(): bool
    {
        return $this->hasRole('admin_sekretariat');
    }

    public function isRomoParoki(): bool
    {
        return $this->hasRole('romo_paroki');
    }

    public function isTimKomsos(): bool
    {
        return $this->hasRole('tim_komsos');
    }
}
