<?php

namespace Database\Factories;

use App\Models\Bisnis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DokumenBisnis>
 */
class DokumenBisnisFactory extends Factory
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
            'nama_dokumen' => fake()->word(),
            'path' => 'dokumen-bisnis/01KC9RQE1F79K1FQHZV3D1ZZ8V.pkt',
            'tanggal_dibuat' => fake()->dateTime()
        ];
    }
}
