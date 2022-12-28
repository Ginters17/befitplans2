<?php

namespace App\Services;

use App\Models\Strava_activity;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use DateTime;


class StravaHelperService
{
    // Process access token
    public function processAccessToken($strava_user_id)
    {
        $user = User::where("strava_user_id", $strava_user_id)->get();

        if ($this->isAccessTokenExpired($user[0]->access_token_expiry))
        {
            $newAccessToken = app(StravaAPIService::class)->getAccessToken($user[0]->refresh_token);
            $this->addAccessTokenToUser($user[0]->id, $newAccessToken->access_token, $newAccessToken->expires_at);

            return $newAccessToken;
        }

        return $user[0]->access_token;
    }

    // Store activities for user
    public function storeActivitiesForUser($activities, $user_id)
    {
        foreach ($activities as $activity)
        {
            $this->storeActivityForUser($activity, $user_id);
        }
    }

    // Adds Strava's user id to user
    public function addStravaUserIdToUser($user_id, $strava_user_id)
    {
        $user = User::findOrFail($user_id);
        $user->strava_user_id = $strava_user_id;
        $user->save();
    }

    // Adds Strava access token to user
    public function addAccessTokenToUser($user_id, $access_token, $access_token_expiry)
    {
        $user = User::findOrFail($user_id);
        $user->access_token = $access_token;
        $user->access_token_expiry = $access_token_expiry;
        $user->save();
    }

    // Adds Strava refresh token to user
    public function addRefreshTokenToUser($user_id, $refresh_token)
    {
        $user = User::findOrFail($user_id);
        $user->refresh_token = $refresh_token;
        $user->save();
    }

    // Sets flag for Strava authorization to user
    public function setStravaApiAuhtorizedFlag($user_id, $flag)
    {
        $user = User::findOrFail($user_id);
        $user->strava_api_auhtorized = $flag;
        $user->save();
    }

    // Checks if access token expiry unix time is bigger than current unix time
    public function isAccessTokenExpired($access_token_expiry)
    {
        return $access_token_expiry < time();
    }

    // Stores single activity
    public function storeActivityForUser($activity, $user_id)
    {
        $start_date_local_short = new DateTime($activity->start_date_local);

        $strava_activity = new Strava_activity();
        $strava_activity->user_id = $user_id;
        $strava_activity->activity_id = $activity->id;
        $strava_activity->name = $activity->name;
        $strava_activity->distance = $activity->distance;
        $strava_activity->elapsed_time = $activity->elapsed_time;
        $strava_activity->moving_time = $activity->moving_time;
        $strava_activity->total_elevation_gain = $activity->total_elevation_gain;
        $strava_activity->type = $activity->type;
        $strava_activity->start_date_local = $activity->start_date_local;
        $strava_activity->start_date_local_short = $start_date_local_short->format('Y-m-d');
        $strava_activity->avg_pace = $activity->average_speed;
        $strava_activity->save();
    }

    // Gets user id by strava user id
    public function getUserIdByStravaUserId($strava_user_id)
    {
        $user = User::where('strava_user_id', $strava_user_id)->get();
        return $user[0]->id;
    }

    // Deletes all activites for user
    public function deleteAllActivitiesForUser($user_id)
    {
        $activites = Strava_activity::where('user_id', $user_id)->get();

        foreach ($activites as $activity)
        {
            $activity->delete();
        }
    }
}
