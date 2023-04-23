<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    private const COMPANY_COUNT = 3;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->count(self::COMPANY_COUNT)->create();
    }
}
