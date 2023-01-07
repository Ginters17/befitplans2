<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Workout;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /// Checks whether user is logged in
    public function validateLoggedIn($redirect, $message = null, $redirectWithLink = false)
    {
        if (!auth()->user())
        {
            if ($message != null && !$redirectWithLink)
            {
                return redirect($redirect)->with($message[0], $message[1])->send();
            }
            elseif ($message != null && $redirectWithLink)
            {
                return redirect($redirect)->with($message[0], $message[1], $message[2])->send();
            }
            else
            {
                return redirect($redirect)->send();
            }
        }
    }

    /// Checks whether any more workouts can be added to plan
    public function canWorkoutsBeAddedToPlan($plan)
    {
        if (auth()->user() && $plan->user_id == auth()->user()->id)
        {
            $planWorkouts = Workout::where('plan_id', $plan->id)->get();
            return sizeOf($planWorkouts) < $plan->workouts ? true : false;
        }
        else
        {
            return false;
        }
    }

    /// Checks whether any more exercises can be added to workout
    public function canExercisesBeAddedToWorkout($workout)
    {
        if (auth()->user() && $workout->user_id == auth()->user()->id && !$workout->day_off)
        {
            $planExercises = Exercise::where('workout_id', $workout->id)->get();
            return sizeOf($planExercises) < 5 ? true : false;
        }
        else
        {
            return false;
        }
    }

    // Check if all previous workouts in a plan are completed
    private function areAllPreviousWorkoutsCompleted($planId, $workout)
    {
        $planWorkouts = Workout::where('plan_id', $planId)->orderby('day', 'ASC')->get();
        for ($i = 0; $planWorkouts[$i]->day <= $workout->day; $i++)
        {
            if ($planWorkouts[$i]->id == $workout->id)
            {
                return true;
            }
            elseif ($planWorkouts[$i]->id < $workout->id && !$planWorkouts[$i]->is_complete)
            {
                return false;
            }
            if (!$planWorkouts[$i]->is_complete)
            {
                return false;
            }
        }
        return true;
    }
}
