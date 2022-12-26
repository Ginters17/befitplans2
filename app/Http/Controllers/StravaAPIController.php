<?php

namespace App\Http\Controllers;

use App\Models\Strava_activity;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use DateTime;

class StravaAPIController extends Controller
{
    public function process_authorization()
    {
        /// Get authorization code from uri
        $uri = $_SERVER['REQUEST_URI'];
        $uri_components = parse_url($uri);
        parse_str($uri_components['query'], $params);
        $authorization_code = $params["code"];


        $client = new Client();

        // Create a POST request
        $response = $client->request(
            'POST',
            'https://www.strava.com/oauth/token?',
            [
                'form_params' => [
                    'client_id' => '98338',
                    'client_secret' => 'df9407044c14a7a558c0b1073f7f6ec0ea9d4ac5',
                    'code' => $authorization_code,
                    'grant_type' => 'authorization_code'
                ]
            ]
        );

        // Get access token, access token expiry and refresh token from response
        $access_token = json_decode($response->getBody())->access_token;
        $access_token_expiry = json_decode($response->getBody())->expires_at;
        $refresh_token = json_decode($response->getBody())->refresh_token;

        // Add access token, access token expiry and refresh token to user
        $user_id = auth()->user()->id;
        $this->addAccessTokenToUser($user_id, $access_token, $access_token_expiry);
        $this->addRefreshTokenToUser($user_id, $refresh_token);

        // Get all activities for this user and store them
        $activites = $this->getAllActivies($access_token);
        $this->storeActivitiesForUser($activites, $user_id);

        $this->setStravaApiAuhtorizedFlag($user_id, true);

        return back()->with("success","Successfully connected with your Strava account");
    }

    /// Create a GET request for all activities
    /// Return JSON of all activities
    public function getAllActivies($access_token)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://www.strava.com/api/v3/athlete/activities?access_token='.$access_token); 

        return json_decode($response->getBody());
    }


    public function getAccessToken($refresh_token)
    {
        $client = new Client();

        // Create a POST request
        $response = $client->request(
            'POST',
            'https://www.strava.com/oauth/token?',
            [
                'form_params' => [
                    'client_id' => '98338',
                    'client_secret' => 'df9407044c14a7a558c0b1073f7f6ec0ea9d4ac5',
                    'refresh_token' => $refresh_token,
                    'grant_type' => 'refresh_token'
                ]
            ]
        );

        return $refresh_token = json_decode($response->getBody())->access_token;
    }

    public function storeActivitiesForUser($activities, $user_id)
    {
        foreach($activities as $activity){
            $strava_activity = new Strava_activity();
            $strava_activity->user_id = $user_id;
            $strava_activity->activity_id = $activity->id;
            $strava_activity->name = $activity->name;
            $strava_activity->distance = $activity->distance;
            $strava_activity->elapsed_time = $activity->elapsed_time;
            $strava_activity->type = $activity->type;
            $strava_activity->start_date_local = $activity->start_date_local;
            $start_date_local_short = new DateTime($activity->start_date_local);
            $strava_activity->start_date_local_short = $start_date_local_short->format('Y-m-d');
            $strava_activity->save();
        }
    }

    public function addAccessTokenToUser($user_id, $access_token, $access_token_expiry)
    {
        $user = User::findOrFail($user_id);
        $user->access_token = $access_token;
        $user->access_token_expiry = $access_token_expiry;
        $user->save();
    }

    public function addRefreshTokenToUser($user_id, $refresh_token)
    {
        $user = User::findOrFail($user_id);
        $user->access_token = $refresh_token;
        $user->save();
    }

    public function setStravaApiAuhtorizedFlag($user_id, $flag)
    {
        $user = User::findOrFail($user_id);
        $user->strava_api_auhtorized = $flag;
        $user->save();
    }
}
