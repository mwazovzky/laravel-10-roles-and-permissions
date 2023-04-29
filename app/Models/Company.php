<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'scope', 'role_user');
    }
}
