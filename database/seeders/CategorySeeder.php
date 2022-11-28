<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Upper Body',
            'description' => 'Upper Body Category - Shoulders, Biceps, Tricpes, Chest & more',
        ]);
        DB::table('categories')->insert([
            'name' => 'Lower  Body',
            'description' => 'Lower Body Category - Glutes, Hamstrings, Quads, Calves & more',
        ]);
        DB::table('categories')->insert([
            'name' => 'Cardio',
            'description' => 'Cardio category',
        ]);
        DB::table('categories')->insert([
            'name' => 'Custom',
            'description' => 'A custom plan',
        ]);
    }
}
