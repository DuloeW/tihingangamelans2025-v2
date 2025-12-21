<?php

namespace Database\Factories;

use App\Models\Bisnis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Katalog>
 */
class KatalogFactory extends Factory
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
            'nama' => fake()->words(3, true),
            'deskripsi' => fake()->paragraph(),
            'harga' => fake()->numberBetween(100000, 5000000),
            'gambar' => 'katalog-gambars/01KC9SGXAS07SH0D6FGFQZNZDY.png',
            'jenis' => fake()->randomElement(['Workshop', 'Kelas', 'Gamelan']),
        ];
    }
}
