<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private array $data = [
        [
            'name' => 'app.admin',
            'description' => 'App Admin',
            'permissions' => [
                // can manage users
                'user.viewAny',
                'user.view',
                'user.create',
                'user.update',
                'user.delete',
                // can manage permissions
                'permission.viewAny',
                'permission.view',
                'permission.create',
                'permission.update',
                'permission.delete',
                // can manage roles
                'role.viewAny',
                'role.view',
                'role.create',
                'role.update',
                'role.delete',
                // can manage currencies
                'currency.viewAny',
                'currency.view',
                'currency.create',
                'currency.update',
                'currency.delete',
                // can manage companies
                'company.viewAny',
                'company.view',
                'company.create',
                'company.update',
                'company.delete',
            ],
        ],
        [
            'name' => 'company.admin',
            'description' => 'Company Admin',
            'permissions' => [
                // can manage own company
                'company.view',
                'company.create',
                'company.update',
                'company.delete',
                // can manage own clients
                'client.viewAny',
                'client.view',
                'client.create',
                'client.update',
                'client.delete',
                // can manage own transactions
                'transaction.viewAny',
                'transaction.view',
                'transaction.create',
                'transaction.update',
                'transaction.delete',
            ],
        ],
        [
            'name' => 'client.admin',
            'description' => 'Client Admin',
            'permissions' => [
                // can manage own clients
                'client.view',
                'client.create',
                'client.update',
                'client.delete',
                // can manage own transactions
                'transaction.viewAny',
                'transaction.view',
                'transaction.create',
                'transaction.update',
                'transaction.delete',
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data as $data) {
            $role = Role::factory()->create([
                'name' => $data['name'],
                'description' => $data['description']
            ]);

            $permissions = Permission::whereIn('name', $data['permissions'])->get();

            $role->permissions()->sync($permissions->pluck('id'));
        }
    }
}
