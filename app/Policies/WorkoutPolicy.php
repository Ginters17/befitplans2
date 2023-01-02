<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workout;
use App\Models\Plan;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkoutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Workout $workout)
    {
        return $user->id == $workout->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Workout $workout)
    {
        return $user->id == $workout->user_id;
    }

    /**
     * Determine whether the user can complete the workout.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function complete(User $user, Workout $workout)
    {
        return $user->id == $workout->user_id;
    }

    /**
     * Determine whether the user can add to the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function addExercise(User $user, Workout $workout)
    {
        return $user->id == $workout->user_id;
    }
}
