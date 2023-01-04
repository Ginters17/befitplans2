<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Plan $plan)
    {
        return $user->id == $plan->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Plan $plan)
    {
        return $user->id == $plan->user_id;
    }

    /**
     * Determine whether the user can add to the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function addWorkout(User $user, Plan $plan)
    {
        return $user->id == $plan->user_id;
    }

    /**
     * Determine whether the user can complete the plan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function complete(User $user, Plan $plan)
    {
        return $user->id == $plan->user_id;
    }
}
