<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;

class CompanyUserController extends Controller
{
    public function index(Company $company)
    {
        return $company->users;
    }

    public function store(Company $company, User $user)
    {
        $company->users()->attach($user);

        return response()->json([], 204);
    }

    public function destroy(Company $company, User $user)
    {
        $company->users()->detach($user);

        return response()->json([], 204);
    }
}
