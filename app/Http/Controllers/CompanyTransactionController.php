<?php

namespace App\Http\Controllers;

use App\Enums\Transactions\Status;
use App\Models\Company;
use App\Models\Transaction;

class CompanyTransactionController extends Controller
{
    public function index(Company $company)
    {
        return $company->transactions;
    }

    public function show(Company $company, Transaction $transaction)
    {
        return $company->transactions()->findOrFail($transaction->id);
    }

    public function confirm(Company $company, Transaction $transaction)
    {
        $company->transactions()->findOrFail($transaction->id)->confirm();

        return response()->json([], 204);
    }

    public function cancel(Company $company, Transaction $transaction)
    {
        $company->transactions()->findOrFail($transaction->id)->confirm();

        return response()->json([], 204);
    }
}
