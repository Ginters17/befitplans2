<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Workout;

class WorkoutService
{
    public function makeWorkouts($coefficient, $user, $plan, $is_default)
    {
        if ($plan->category_id == 1) 
        {
            $this->makeUpperBodyWorkouts($coefficient, $user, $plan, $is_default);
        } 
        elseif ($plan->category_id == 2) 
        {
            $this->makeLowerBodyWorkouts($coefficient, $user, $plan, $is_default);
        }
        elseif ($plan->category_id == 3) 
        {
            $this->makeCardioWorkouts($coefficient, $user, $plan, $is_default);
        }
    }
    public function makeCardioWorkouts($coefficient, $user, $plan, $is_default)
    {
        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 1;
        $workout->duration_minutes = 20;
        $workout->day_off = 0;
        $workout->save();
    }
    public function makeUpperBodyWorkouts($coefficient, $user, $plan, $is_default)
    {
        $workout = new Workout();
        $workout->name = "Wide push-ups";
        $workout->description = "Wide push-ups will work your chest muscles";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 1;
        $workout->reps = ceil(6 * $coefficient);
        $workout->sets = ceil(3 * $coefficient);
        $workout->day_off = 0;
        $workout->save();
    }
    public function makeLowerBodyWorkouts($coefficient, $user, $plan, $is_default)
    {
        $workout = new Workout();
        $workout->name = "Squats";
        $workout->description = "Squats will work your quads";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 1;
        $workout->reps = ceil(6 * $coefficient);
        $workout->sets = ceil(3 * $coefficient);
        $workout->day_off = 0;
        $workout->save();
    }
}
