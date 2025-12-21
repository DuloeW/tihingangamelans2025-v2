<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Provinsi;
use Pest\Support\Str;

use function Livewire\store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengguna>
 */
class PenggunaFactory extends Factory
{
    protected static ?string $password;
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
            'nama' => fake()->name(),
            'user_name' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'province_code' => $province->code,
            'city_code' => $city->code,
            'district_code' => $district->code,
            'gambar' => 'foto-profile-pengguna/LJE86stqCkBQO5GcwTqSi6YgED74mHAmGAfUbdyJ.png',
            'no_telephone' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}
