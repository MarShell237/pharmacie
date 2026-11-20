<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nameFr = fake('fr_FR')->realText(12, true);

        return [
            'name' => $nameFr,
            // 'slug' => Str::slug($nameFr),
            // 'color' => fake()->hexColor(),
            'description' => fake('fr_FR')->realText(40),
        ];
    }
}
