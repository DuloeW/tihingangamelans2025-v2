<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Bisnis;
use App\Models\ContactPerson;
use App\Models\DokumenBisnis;
use App\Models\Jadwal;
use App\Models\Katalog;
use App\Models\Owner;
use App\Models\Pengguna;
use App\Models\TagBisnis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Bisnis::factory()
                ->for(Admin::factory())
                ->for(Owner::factory())
                ->has(ContactPerson::factory()->count(2))
                ->has(DokumenBisnis::factory()->count(3))
                ->has(TagBisnis::factory()->count(2), 'tags')
                ->has(Katalog::factory()
                        ->count(5)
                        ->state(new Sequence(
                            fn ($sequence) => ['nama' => 'Katalog dengan jadwal'],
                            fn ($sequence) => ['nama' => 'Katalog tanpa jadwal'],
                        ))
                        ->afterCreating(function (Katalog $katalog) {
                            if(fake()->boolean(50)) {
                                Jadwal::factory()
                                    ->count(3)  
                                    ->for($katalog)
                                    ->create();
                            }
                        })
                )
                ->create();

    }
}
