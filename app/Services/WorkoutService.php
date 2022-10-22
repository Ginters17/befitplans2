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

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 2;
        $workout->duration_minutes = 20;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 3;
        $workout->duration_minutes = 20;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "FREE";
        $workout->description = "Let's relax.. this is your day off";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 4;
        $workout->day_off = 1;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 5;
        $workout->duration_minutes = 25;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 6;
        $workout->duration_minutes = 25;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 7;
        $workout->duration_minutes = 25;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "FREE";
        $workout->description = "Let's relax.. this is your day off";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 8;
        $workout->day_off = 1;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 9;
        $workout->duration_minutes = 30;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 10;
        $workout->duration_minutes = 30;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 11;
        $workout->duration_minutes = 30;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "FREE";
        $workout->description = "Let's relax.. this is your day off";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 12;
        $workout->day_off = 1;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 13;
        $workout->duration_minutes = 35;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 14;
        $workout->duration_minutes = 35;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 15;
        $workout->duration_minutes = 35;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "FREE";
        $workout->description = "Let's relax.. this is your day off";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 16;
        $workout->day_off = 1;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 17;
        $workout->duration_minutes = 40;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 18;
        $workout->duration_minutes = 40;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 19;
        $workout->duration_minutes = 40;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "FREE";
        $workout->description = "Let's relax.. this is your day off";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 20;
        $workout->day_off = 1;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 21;
        $workout->duration_minutes = 45;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 22;
        $workout->duration_minutes = 45;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 23;
        $workout->duration_minutes = 45;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "FREE";
        $workout->description = "Let's relax.. this is your last day off in this plan";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 24;
        $workout->duration_minutes = 20;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 25;
        $workout->duration_minutes = 50;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 26;
        $workout->duration_minutes = 55;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 27;
        $workout->duration_minutes = 55;
        $workout->day_off = 0;
        $workout->save();

        $workout = new Workout();
        $workout->name = "Run";
        $workout->description = "Run outside or indoors";
        $workout->plan_id = $plan->id;
        $workout->user_id = $user->id;
        $workout->day = 28;
        $workout->duration_minutes = 60;
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
