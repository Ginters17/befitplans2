<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class StravaWebhookService
{
    private string $client_id;
    private string $client_secret;
    private string $url;
    private string $callback_url;
    private string $verify_token;

    public function __construct()
    {
        $this->client_id = config('services.client_id');
        $this->client_secret = config('services.client_secret');
        $this->url = config('services.strava.push_subscriptions_url');
        $this->callback_url = config('services.strava.webhook_callback_url');
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
}
