<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

class UserRoleController extends Controller
{
    public function show(User $user)
    {
        return $user->role;
    }

    public function store(User $user, Role $role)
    {
        $user->role()->associate($role->id)->save();

        return response()->json([], 204);
    }

    public function destroy(User $user, Role $role)
    {
        $user->role()->dissociate()->save();

        return response()->json([], 204);
    }
}
