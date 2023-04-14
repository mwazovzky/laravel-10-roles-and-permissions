<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    private array $permissions = [
        // can manage users
        'app.user.viewAny',
        'app.user.view',
        'app.user.create',
        'app.user.update',
        'app.user.delete',
        // can manage permissions
        'app.permission.viewAny',
        'app.permission.view',
        'app.permission.create',
        'app.permission.update',
        'app.permission.delete',
        // can manage roles
        'app.role.viewAny',
        'app.role.view',
        'app.role.create',
        'app.role.update',
        'app.role.delete',
        // can manage currencies
        'app.currency.viewAny',
        'app.currency.view',
        'app.currency.create',
        'app.currency.update',
        'app.currency.delete',
        // can manage companies
        'app.company.viewAny',
        'app.company.view',
        'app.company.create',
        'app.company.update',
        'app.company.delete',
        // can manage company clients if assiged to company
        'company.client.viewAny',
        'company.client.view',
        'company.client.create',
        'company.client.update',
        'company.client.delete',
        // can manage company transactions if assiged to company
        'company.transaction.viewAny',
        'company.transaction.view',
        'company.transaction.create',
        'company.transaction.update',
        'company.transaction.delete',
        // can manage client transactions if assiged to client
        'client.transaction.viewAny',
        'client.transaction.view',
        'client.transaction.create',
        'client.transaction.update',
        'client.transaction.delete',
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
