<?php

namespace Database\Factories;

use App\Models\Katalog;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravolt\Indonesia\Models\Provinsi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemesanan>
 */
class PemesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $province = Provinsi::inRandomOrder()->first();
        $city = $province->cities()->inRandomOrder()->first();
        $district = $city->districts()->inRandomOrder()->first();

        return [
            'pengguna_id' => Pengguna::factory(),
            'katalog_id' => Katalog::factory(),
            'jadwal_id' => function (array $attributes) {
                return Katalog::find($attributes['katalog_id'])->jadwals()->inRandomOrder()->first()->id;
            },
            'nama_group' => fake()->company(),
            'jumlah' => fake()->numberBetween(1, 50),
            'penerima' => fake()->name(),
            'province_code' => $province->code,
            'city_code' => $city->code,
            'district_code' => $district->code,
            'alamat_lengkap' => fake()->address(),
            'tgl_mulai_booking' => fake()->dateTimeBetween('+1 days', '+1 month'),
            'tgl_selesai_booking' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'tanggal_pemesanan' => fake()->dateTimeBetween('-1 month', 'now'),
            'status_pemesanan' => fake()->randomElement(['unpaid', 'paid', 'processing', 'shipped', 'completed', 'cancelled', 'failed']),
            'total_harga' => fake()->numberBetween(100000, 5000000),

        ];
    }
}
