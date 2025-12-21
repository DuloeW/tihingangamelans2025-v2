<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bisnis>
 */
class BisnisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_id' => Admin::factory(),
            'owner_id' => Owner::factory(),
            'nama' => fake()->company(),
            'slug' => fake()->unique()->slug(),
            'deskripsi' => fake()->paragraph(),
            'gambar' => 'bisnis-gambars/01KC9RQE0TSCAA5G9F6FXECVCE.jpg',
            'email' => fake()->unique()->companyEmail(),
            'status' => 'unverified',
        ];
    }
}
