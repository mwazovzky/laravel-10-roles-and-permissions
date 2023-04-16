<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;

class ClientTransactionController extends Controller
{
    public function index(Client $client)
    {
        return $client->transactions;
    }

    public function show(Client $client, Transaction $transaction)
    {
        return $client->transactions()->findOrFail($transaction->id);
    }

    public function store(Client $client)
    {
        return Transaction::factory()->for($client)->create();
    }
}
