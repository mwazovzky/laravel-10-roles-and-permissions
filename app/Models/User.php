<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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

    public function companies(): MorphToMany
    {
        return $this->morphedByMany(Company::class, 'scope', 'role_user');
    }

    public function clients(): MorphToMany
    {
        return $this->morphedByMany(Client::class, 'scope', 'role_user');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withPivot('scope_type', 'scope_id');
    }

    public function hasAdminPermission(string $permission): bool
    {
        return $this->roles()
            ->where('scope_type', 'admin')
            ->whereHas('permissions', fn ($query) => $query->where('name', $permission))
            ->exists();
    }

    public function hasCompanyPermission(Company $company, string $permission): bool
    {
        return $this->roles()
            ->where('scope_type', 'company')
            ->where('scope_id', $company->id)
            ->whereHas('permissions', fn ($query) => $query->where('name', $permission))
            ->exists();
    }

    public function hasClientPermission(Client $client, string $permission): bool
    {
        return $this->roles()
            ->where('scope_type', 'client')
            ->where('scope_id', $client->id)
            ->whereHas('permissions', fn ($query) => $query->where('name', $permission))
            ->exists();
    }
}
