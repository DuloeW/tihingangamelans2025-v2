<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gamelan>
 */
class GamelanFactory extends Factory
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
            'nama' => fake()->word(),
            'slug' => fake()->slug(),
            'deskripsi' => fake()->paragraph(),
            'gambar' => 'gamelan-images/01KCJVP29TPKW1ARZSAZR32N30.png',
            'audio' => 'gamelan-audio/01KCJVP2A36H2CYPDWESYNQQ4E.m4a',
        ];
    }
}
