<?php

namespace App\Http\Controllers;

use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        return Client::factory()->create();
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return $client->load('company');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([], 204);
    }
}
