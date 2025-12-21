<?php

namespace Database\Factories;

use App\Models\Bisnis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactPerson>
 */
class ContactPersonFactory extends Factory
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
            'nama' => fake()->name(),
            'no_telephone' => fake()->phoneNumber(),
        ];
    }
}
