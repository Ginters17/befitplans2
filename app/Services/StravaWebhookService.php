<?php

namespace App\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\StravaAPIService;
use App\Services\StravaHelperService;

class StravaWebhookService
{
    private string $verify_token;

    public function __construct()
    {
        $this->verify_token = config('services.strava.webhook_verify_token');
    }

    public function validate(string $mode, string $token, string $challenge): Response|JsonResponse
    {
        // Checks if a token and mode is in the query string of the request
        if ($mode && $token)
        {
            // Verifies that the mode and token sent are valid
            if ($mode === 'subscribe' && $token === $this->verify_token)
            {
                // Responds with the challenge token from the request
                return response()->json(['hub.challenge' => $challenge]);
            }
            else
            {
                // Responds with '403 Forbidden' if verify tokens do not match
                return response('', Response::HTTP_FORBIDDEN);
            }
        }

        return response('', Response::HTTP_FORBIDDEN);
    }

    // Processes a webhook POST request
    public function processWebhookPost(Request $request): Response|JsonResponse
    {
        $aspect_type = $request['aspect_type']; // "create" | "update" | "delete"
        $event_time = $request['event_time']; // time the event occurred
        $object_id = $request['object_id']; // activity ID | athlete ID
        $object_type = $request['object_type']; // "activity" | "athlete"
        $owner_id = $request['owner_id']; // athlete ID
        $subscription_id = $request['subscription_id']; // push subscription ID receiving the event
        $updates = $request['updates']; // activity update: {"title" | "type" | "private": true/false} ; app deauthorization: {"authorized": false}

        try
        {
            Log::channel('strava')->info(json_encode($request->all()));

            $user_id = app(StravaHelperService::class)->getUserIdByStravaUserId($owner_id);

            // Event = deauthorization
            if ($aspect_type == "update" && $object_type == "athlete" && $updates['authorized'] == "false")
            {
                app(StravaHelperService::class)->setStravaApiAuhtorizedFlag($user_id, false);
                app(StravaHelperService::class)->deleteAllActivitiesForUser($user_id);
                app(StravaHelperService::class)->removeStravaDataFromUser($user_id);
                app(StravaHelperService::class)->removeStravaDataFromExercises($user_id);
            }

            // Need to check and update access_token, access_token_expiry, refresh token if access token has expired
            $access_token = app(StravaHelperService::class)->processAccessToken($owner_id);

            // Event = create activity
            if ($aspect_type == "create" && $object_type == "activity")
            {
                $activity = app(StravaAPIService::class)->getActivity($object_id, $access_token);
                app(StravaHelperService::class)->storeActivityForUser($activity, $user_id);
            }
        }
        catch (Exception $ex)
        {
            Log::channel('strava')->error($ex);
            return response('INTERNAL_SERVER_ERROR', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response('EVENT_RECEIVED', Response::HTTP_OK);
    }
}
