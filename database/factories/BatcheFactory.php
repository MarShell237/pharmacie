<?php

namespace Database\Factories;

use App\Models\Batche;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Batche>
 */
class BatcheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'batch_number' => fake()->name(),
            'expiration_date' => fake()->dateTimeBetween('1 year', '7 year'),
            'quantity_receive' => fake()->numberBetween(15, 87)
        ];
    }
}
