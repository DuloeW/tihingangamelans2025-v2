<?php

namespace Database\Factories;

use App\Models\Katalog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jadwal>
 */
class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'katalog_id' => Katalog::factory(),
            'waktu_mulai' => fake()->dateTimeBetween('+1 days', '+1 month'),
            'waktu_selesai' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'kuota' => fake()->numberBetween(5, 50),
        ];
    }
}
