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

    /**
     * Get all of the companies that are assigned this tag.
     */
    public function companies(): MorphToMany
    {
        return $this->morphedByMany(Company::class, 'scope', 'role_user')->withTimestamps();
    }

    /**
     * Get all of the clients that are assigned this tag.
     */
    public function clients(): MorphToMany
    {
        return $this->morphedByMany(Client::class, 'scope', 'role_user')->withTimestamps();
    }

    /**
     * The roles that belong to the user.
     */
    private function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function adminRoles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->where('scope_type', 'admin');
    }

    public function companyRoles(Company $company): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->where('scope_type', 'company')->where('scope_id', $company->id);
    }

    public function clientRoles(Client $client): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->where('scope_type', 'client')->where('scope_id', $client->id);
    }

    public function attachAdminRole(Role $role): void
    {
        $this->roles()->attach($role->id, ['scope_type' => 'admin']);
    }

    public function attachCompanyRole(Company $company, Role $role): void
    {
        $this->roles()->attach($role->id, ['scope_type' => 'company', 'scope_id' => $company->id]);
    }

    public function attachClientRole(Client $client, Role $role): void
    {
        $this->roles($client)->attach($role->id, ['scope_type' => 'client', 'scope_id' => $client->id]);
    }

    /**
     * Check if user has permission.
     */
    public function hasAdminPermission(string $requiredPermission): bool
    {
        return $this->adminRoles()
            ->whereHas('permissions', fn ($query) => $query->where('name', $requiredPermission))
            ->exists();
    }

    public function hasCompanyPermission(Company $company, string $requiredPermission): bool
    {
        return $this->companyRoles($company)
            ->whereHas('permissions', fn ($query) => $query->where('name', $requiredPermission))
            ->exists();
    }

    public function hasClientPermission(Client $client, string $requiredPermission): bool
    {
        return $this->clientRoles($client)
            ->whereHas('permissions', fn ($query) => $query->where('name', $requiredPermission))
            ->exists();
    }
}
