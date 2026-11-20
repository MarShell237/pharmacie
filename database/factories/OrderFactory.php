<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paid_at = fake()->optional(0.6)->passthrough(fake()->dateTimeBetween('-3 day', '-1 day'));
        $delivered_at = $paid_at ? fake()->optional(0.5)->passthrough(fake()->dateTimeBetween('-3 day', '-1 day')) : null;
        return [
            'total' => fake()->numberBetween(1, 15) * 100,
            'delivery_fee' => fake()->numberBetween(1, 3) * 100,
            'delivery_adress' => fake()->address(),
            'paid_at' => $paid_at,
            'delivered_at' => $delivered_at
        ];

    }
}
