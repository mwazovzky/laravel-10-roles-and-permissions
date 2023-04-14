<?php

namespace Database\Factories;

use App\Enums\Transactions\Status;
use App\Enums\Transactions\Type;
use App\Models\Client;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(Type::cases()),
            'status' => $this->faker->randomElement(Status::cases()),
            'txid' => $this->faker->uuid(),
            'vout' => $this->faker->randomNumber(3),
            'amount' => $this->faker->randomFloat(8),
            'currency_id' => Currency::factory(),
            'client_id' => Client::factory(),
        ];
    }
}
