<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Gamelan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamelanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gamelan::factory(5)->recycle([
            Admin::factory()->create()
        ])->create();
    }
}
