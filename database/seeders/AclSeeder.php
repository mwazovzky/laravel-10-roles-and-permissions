<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);

        $role = Role::where('name', 'app.admin')->first();
        $permissions = Permission::where('name', 'LIKE', 'app.%')->get('id');
        $role->permissions()->attach($permissions);

        $role = Role::where('name', 'company.admin')->first();
        $permissions = Permission::where('name', 'LIKE', 'company.%')->get();
        $role->permissions()->attach($permissions);

        $role = Role::where('name', 'client.admin')->first();
        $permissions = Permission::where('name', 'LIKE', 'client.%')->get();
        $role->permissions()->attach($permissions);
    }
}
