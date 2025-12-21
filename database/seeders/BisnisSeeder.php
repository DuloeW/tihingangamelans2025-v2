<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Bisnis;
use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BisnisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bisnis::factory()->recycle([
            Admin::factory()->create(),
            Owner::factory()->create()
        ])->create();
    }
}
