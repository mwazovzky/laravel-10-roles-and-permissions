<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user has permission.
     */
    public function hasPermission(string $requiredPermission): bool
    {
        return $this->role()
            ->whereHas('permissions', fn ($query) => $query->where('name', $requiredPermission))
            ->exists();
    }

    /**
     * Check if user has any of required permissions.
     *
     * @param array<string> $permissions
     */
    public function hasPermissionAny(array $permissions): bool
    {
        return $this->role->permissions()
            ->whereIn('name', $permissions)
            ->exists();
    }

    /**
     * Check if user has all required permissions.
     *
     * @param array<string> $permissions
     */
    public function hasPermissionAll(array $permissions): bool
    {
        $userPermissions = $this->role->permissions()
            ->pluck('name')
            ->toArray();

        return count(array_diff($permissions, $userPermissions)) == 0;
    }
}
