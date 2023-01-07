<?php

namespace App\Policies;

use App\Models\Strava_activity;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StravaActivityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can add activity
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function addActivity(User $user, Strava_activity $activity)
    {
        return $user->id == $activity->user_id;
    }
}
