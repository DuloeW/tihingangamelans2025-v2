<?php

namespace Database\Seeders;

use App\Models\Bisnis;
use App\Models\Katalog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Katalog::factory(10)->recycle([
            Bisnis::factory()->create(),
        ])->create();
    }
}
