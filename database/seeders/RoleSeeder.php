<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private array $roles = [
        [
            'name' => 'app.admin',
            'description' => 'Admin',
        ],
        [
            'name' => 'company.admin',
            'description' => 'Company Admin',
        ],
        [
            'name' => 'client.admin',
            'description' => 'Client Admin',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::factory()->create($role);
        }
    }
}
