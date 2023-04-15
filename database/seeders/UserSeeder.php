<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private array $users = [
        [
            'name' => 'alex',
            'email' => 'alex@example.com',
            'role' => 'app.admin',
        ],
        [
            'name' => 'john',
            'email' => 'john@example.com',
            'role' => 'company.admin',
        ],
        [
            'name' => 'jane',
            'email' => 'jane@example.com',
            'role' => 'client.admin',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->users as $user) {
            $role = Role::where('name', $user['role'])->firstOrFail();
            User::factory()->create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role_id' => $role->id,
            ]);
        }
    }
}
