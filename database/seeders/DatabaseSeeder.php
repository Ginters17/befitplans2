<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        // $this->call(PlanSeeder::class);
        // $this->call(CardioWorkoutSeeder::class);
        // $this->call(UpperBodyWorkoutSeeder::class);
        // $this->call(LowerBodyWorkoutSeeder::class);
        // $this->call(CardioExerciseSeeder::class);
        // $this->call(UpperBodyExerciseSeeder::class);
        // $this->call(LowerBodyExerciseSeeder::class);
    }
}
