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
        $user = User::factory()->create($this->users[0]);
        $role = Role::where('name', 'app.admin')->first();
        $user->roles()->attach($role->id, ['scope_type' => 'admin', 'scope_id' => null]);

        $user = User::factory()->create($this->users[1]);
        $role = Role::where('name', 'company.admin')->first();
        $company = Company::find(1);
        $user->roles()->attach($role->id, ['scope_type' => 'company', 'scope_id' => $company->id]);

        $user = User::factory()->create($this->users[2]);
        $role = Role::where('name', 'company.admin')->first();
        $client = Client::find(1);
        $user->roles()->attach($role->id, ['scope_type' => 'client', 'scope_id' => $client->id]);
    }
}
