<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    private array $permissions = [
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
        // can manage clients
        'client.viewAny',
        'client.view',
        'client.create',
        'client.update',
        'client.delete',
        // can manage transactions
        'transaction.viewAny',
        'transaction.view',
        'transaction.create',
        'transaction.update',
        'transaction.delete',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $name) {
            Permission::factory()->create([
                'name' => $name,
            ]);
        }
    }
}
