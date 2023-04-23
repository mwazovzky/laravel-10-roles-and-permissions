<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    private const CLIENT_MAX_COUNT = 3;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::query()->cursor()->each(function ($company) {
            Client::factory()->for($company)->count(rand(1, self::CLIENT_MAX_COUNT))->create();
        });
    }
}
