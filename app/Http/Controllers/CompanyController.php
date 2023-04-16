<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        return Company::factory()->create();
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return $company->load('clients');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json([], 204);
    }
}
