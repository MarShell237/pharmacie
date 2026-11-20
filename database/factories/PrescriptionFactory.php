<?php

namespace Database\Factories;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prescribed_at = fake()->dateTimeBetween('-7 day');
        $expires_at = fake()->dateTimeBetween($prescribed_at, '30 day');
        $patient_full_name = fake()->name();
        return [
            'patient_full_name' => $patient_full_name,
            'patient_age' => fake()->numberBetween(1, 100),
            'doctor_name' => fake()->name(),
            'doctor_license' => "PHARMACIE-".fake()->word(),
            'prescribed_at' => $prescribed_at,
            'expires_at' => $expires_at,
            'scan_url' => fake()->imageUrl($word = $patient_full_name),
            'scan_hash' => fake()->sha256()
        ];
    }
}
