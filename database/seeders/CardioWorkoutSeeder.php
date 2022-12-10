<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardioWorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// Cardio Plan
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 1,
            'duration_minutes' => 20,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 2,
            'duration_minutes' => 20,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 3,
            'duration_minutes' => 20,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'FREE',
            'description' => "It's your day off - relax",
            'plan_id' => 3,
            'day' => 4,
            'day_off' => 1,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 5,
            'duration_minutes' => 25,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 6,
            'duration_minutes' => 25,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 7,
            'duration_minutes' => 25,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'FREE',
            'description' => "It's your day off - relax",
            'plan_id' => 3,
            'day' => 8,
            'day_off' => 1,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 9,
            'duration_minutes' => 30,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 10,
            'duration_minutes' => 30,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 11,
            'duration_minutes' => 30,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'FREE',
            'description' => "It's your day off - relax",
            'plan_id' => 3,
            'day' => 12,
            'day_off' => 1,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 13,
            'duration_minutes' => 35,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 14,
            'duration_minutes' => 35,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 15,
            'duration_minutes' => 35,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'FREE',
            'description' => "It's your day off - relax",
            'plan_id' => 3,
            'day' => 16,
            'day_off' => 1,
        ]);

        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 17,
            'duration_minutes' => 40,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 18,
            'duration_minutes' => 40,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 19,
            'duration_minutes' => 40,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'FREE',
            'description' => "It's your day off - relax",
            'plan_id' => 3,
            'day' => 20,
            'day_off' => 1,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 21,
            'duration_minutes' => 45,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 22,
            'duration_minutes' => 45,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 23,
            'duration_minutes' => 45,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => "It's your day off - relax",
            'plan_id' => 3,
            'day' => 24,
            'day_off' => 1,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 25,
            'duration_minutes' => 50,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 26,
            'duration_minutes' => 50,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 27,
            'duration_minutes' => 50,
            'day_off' => 0,
        ]);
        DB::table('workouts')->insert([
            'name' => 'Run',
            'description' => 'Run outside or indoors',
            'plan_id' => 3,
            'day' => 28,
            'duration_minutes' => 50,
            'day_off' => 0,
        ]);
    }
}
