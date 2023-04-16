<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;

class CompanyClientController extends Controller
{
    public function index(Company $company)
    {
        return $company->clients;
    }

    public function store(Company $company)
    {
        $client = Client::factory()->create();

        $company->clients()->save($client);

        return $client;
    }

    public function destroy(Company $company, Client $client)
    {
        $client->update(['company_id' => null]);

        return response()->json([], 204);
    }
}
