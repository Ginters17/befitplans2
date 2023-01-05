<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Services\StravaHelperService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class StravaAPIService
{
    private string $client_id;
    private string $client_secret;

    public function __construct()
    {
        $this->client_id = config('services.strava.client_id');
        $this->client_secret = config('services.strava.client_secret');
    }

    // Responsible for processing Strava authorization  
    public function processAuthorization()
    {
        if(!auth()->user()){
            return redirect('/login')->with("error","You aren't logged in!");
        }

        /// Get parameters from URI
        $uri = $_SERVER['REQUEST_URI'];
        $uri_components = parse_url($uri);
        parse_str($uri_components['query'], $params);

        // Validate URI and get authorization code if successful
        $authorization_code = app(StravaHelperService::class)->validateStravaRedirectURI($params);

        $client = new Client();

        // Create a POST request
        $response = $client->request(
            'POST',
            'https://www.strava.com/oauth/token?',
            [
                'form_params' => [
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'code' => $authorization_code,
                    'grant_type' => 'authorization_code'
                ]
            ]
        );

        // Get access token, access token expiry and refresh token from response
        $access_token = json_decode($response->getBody())->access_token;
        $access_token_expiry = json_decode($response->getBody())->expires_at;
        $refresh_token = json_decode($response->getBody())->refresh_token;
        $strava_user_id = json_decode($response->getBody())->athlete->id;

        // Add access token, access token expiry and refresh token to user
        $user_id = auth()->user()->id;

        if(app(StravaHelperService::class)->isStravaUserAlreadyAssociated($strava_user_id)){
            return back()->with("error", "Your Strava account is already associated with a different account on BefitPlans");
        }

        app(StravaHelperService::class)->addStravaUserIdToUser($user_id, $strava_user_id);
        app(StravaHelperService::class)->addAccessTokenToUser($user_id, $access_token, $access_token_expiry);
        app(StravaHelperService::class)->addRefreshTokenToUser($user_id, $refresh_token);

        // Get all activities for this user and store them
        $activites = $this->getAllActivies($access_token);
        app(StravaHelperService::class)->storeActivitiesForUser($activites, $user_id);

        app(StravaHelperService::class)->setStravaApiAuhtorizedFlag($user_id, true);

        return back()->with("success", "Successfully connected with your Strava account");
    }

    // Gets access token for fiven refresh token (One refresh token per Strava user)
    public function getAccessToken($refresh_token)
    {
        $client = new Client();

        // Create a POST request
        $response = $client->request(
            'POST',
            'https://www.strava.com/oauth/token?',
            [
                'form_params' => [
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'refresh_token' => $refresh_token,
                    'grant_type' => 'refresh_token'
                ]
            ]
        );

        return json_decode($response->getBody())->access_token;
    }

    /// Create a GET request for all activities
    /// Return object of all activities
    public function getAllActivies($access_token)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://www.strava.com/api/v3/athlete/activities?access_token='.$access_token); 

        return json_decode($response->getBody());
    }

    // Get an activity
    public function getActivity($activity_id, $access_token)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://www.strava.com/api/v3/activities/'.$activity_id, [
            'headers' => [
                'authorization' => 'Bearer '.$access_token
            ]
        ]);

        return json_decode($response->getBody());
    }
}