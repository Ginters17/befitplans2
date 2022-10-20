<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'name' => 'Default Plan for Upper Body',
            'description' => 'Upper Body',
            'category_id' => 1,
            'is_default' => 1,
        ]);
        DB::table('plans')->insert([
            'name' => 'Default Plan for Lower Body',
            'description' => 'Lower Body',
            'category_id' => 2,
            'is_default' => 1,
        ]);
        DB::table('plans')->insert([
            'name' => 'Default Plan for Cardio',
            'description' => 'Cardio',
            'category_id' => 3,
            'is_default' => 1,
        ]);
    }
}
