<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;

class ClientUserController extends Controller
{
    public function index(Client $client)
    {
        return $client->users;
    }

    public function store(Client $client, User $user)
    {
        $client->users()->attach($user);

        return response()->json([], 204);
    }

    public function destroy(Client $client, User $user)
    {
        $client->users()->detach($user);

        return response()->json([], 204);
    }
}
