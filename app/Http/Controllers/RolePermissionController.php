<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;

class RolePermissionController extends Controller
{
    public function index(Role $role)
    {
        return $role->permissions;
    }

    public function store(Role $role, Permission $permission)
    {
        $role->permissions()->attach($permission->id);

        return response()->json([], 204);
    }

    public function destroy(Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission->id);

        return response()->json([], 204);
    }
}
