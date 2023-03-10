<?php

namespace App\Services;

use App\Models\Exercise;
use App\Models\Strava_activity;
use App\Models\User;
use DateTime;


class StravaHelperService
{
    // Process access token
    // Return valid access token
    public function processAccessToken($strava_user_id)
    {
        $user = User::where("strava_user_id", $strava_user_id)->firstOrFail(); 

        if ($this->isAccessTokenExpired($user->access_token_expiry))
        {
            // Need to update access token, access token expiry and refresh token for user
            $access = app(StravaAPIService::class)->getAccessDetails($user->refresh_token);
            $this->addAccessTokenToUser($user->id, $access->access_token);
            $this->addAccessTokenExpiryToUser($user->id, $access->expires_at);
            $this->addRefreshTokenToUser($user->id, $access->refresh_token);

            return $access->access_token;
        }

        return $user->access_token;
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
    public function addAccessTokenToUser($user_id, $access_token)
    {
        $user = User::findOrFail($user_id);
        $user->access_token = $access_token;
        $user->save();
    }

    // Adds Strava access token expiry to user
    public function addAccessTokenExpiryToUser($user_id, $access_token_expiry)
    {
        $user = User::findOrFail($user_id);
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
        $user = User::where('strava_user_id', $strava_user_id)->firstOrFail(); 
        return $user->id;
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

    // Checks if user has been already authorized on Strava
    public function isStravaUserAlreadyAssociated($strava_user_id)
    {
        $users = User::where("strava_user_id", $strava_user_id)->get();
        return sizeof($users) > 0;
    }

    // Remove strava data from user
    public function removeStravaDataFromUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->access_token = null;
        $user->access_token_expiry = null;
        $user->refresh_token = null;
        $user->strava_user_id = null;
        $user->save();
    }

    // Validates URI
    public function validateStravaRedirectURI($params)
    {
        if (isset($_GET["error"])  && $params["error"] == "access_denied")
        {
            return back()->with("error", "Access denied")->send();;
        }
        elseif (isset($_GET["error"])  && $params["error"] != "access_denied")
        {
            return back()->with("error", "Something went wrong, Try again!")->send();;
        }
        elseif ($params["scope"] != 'read,activity:read_all')
        {
            return back()->with("error", "'View data about your private activities' needs to be checked")->send();;
        }
        else{
            return $params["code"];
        }
    }

    // Removes strava data from exercises for user
    public function removeStravaDataFromExercises($user_id)
    {
        $exercises_with_strava = Exercise::Where('user_id',$user_id)->where('activity_id','!=','null')->get();
        foreach($exercises_with_strava as $exercise){
            $exercise->activity_id = null;
            $exercise->save();
        }
    }
}
