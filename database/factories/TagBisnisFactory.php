<?php

namespace Database\Factories;

use App\Models\Bisnis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TagBisnis>
 */
class TagBisnisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bisnis_id' => Bisnis::factory(),
            'jenis' => fake()->randomElement(['Workshop', 'Learn', 'Purchase']),
        ];
    }
}
