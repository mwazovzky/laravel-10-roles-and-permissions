<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyCreateRequest;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Currency::class);

        return Currency::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyCreateRequest $request)
    {
        return Currency::factory()->create();
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return $currency;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return response()->json([], 204);
    }
}
