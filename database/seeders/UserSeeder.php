<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private array $users = [
        [
            'name' => 'alex',
            'email' => 'alex@example.com',
        ],
        [
            'name' => 'john',
            'email' => 'john@example.com',
        ],
        [
            'name' => 'jane',
            'email' => 'jane@example.com',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->users as $attributes) {
            User::factory()->create($attributes);
        }

        $user = User::where('name', 'alex')->first();
        $role = Role::where('name', 'app.admin')->first();
        $user->attachAdminRole($role);

        $user = User::where('name', 'john')->first();
        $role = Role::where('name', 'company.admin')->first();
        $company = Company::find(1);
        $user->attachCompanyRole($company, $role);

        $user = User::where('name', 'jane')->first();
        $role = Role::where('name', 'company.admin')->first();
        $client = Client::find(1);
        $user->attachClientRole($client, $role);
    }
}
