<?php

use Illuminate\Http\Client\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homePage');
});

Auth::routes();

Route::get('settings', [App\Http\Controllers\SettingsController::class, 'index']);

Route::get('auth', [App\Http\Controllers\StravaAPIController::class, 'process_authorization']);

Route::get('/webhook', function (Request $request) {
    $mode = $request->query('hub_mode'); // hub.mode
    $token = $request->query('hub_verify_token'); // hub.verify_token
    $challenge = $request->query('hub_challenge'); // hub.challenge

    return app(StravaWebhookService::class)->validate($mode, $token, $challenge);
});

Route::post('/webhook', function (Request $request) {
    $aspect_type = $request['aspect_type']; // "create" | "update" | "delete"
    $event_time = $request['event_time']; // time the event occurred
    $object_id = $request['object_id']; // activity ID | athlete ID
    $object_type = $request['object_type']; // "activity" | "athlete"
    $owner_id = $request['owner_id']; // athlete ID
    $subscription_id = $request['subscription_id']; // push subscription ID receiving the event
    $updates = $request['updates']; // activity update: {"title" | "type" | "private": true/false} ; app deauthorization: {"authorized": false}

    // Log::channel('strava')->info(json_encode($request->all()));
    dd(json_encode($request->all()));
    
    return response('EVENT_RECEIVED', Response::HTTP_OK);
})->withoutMiddleware(VerifyCsrfToken::class);

Route::get('plan/create', function () {
    return view('createCustomPlanPage');
});
Route::post('plan/storeCustomPlan', [App\Http\Controllers\PlanController::class, 'storeCustomPlan']);
Route::get('plan/create', [App\Http\Controllers\PlanController::class, 'createCustomPlan']);
Route::get('plan/{plan_id}', [App\Http\Controllers\PlanController::class, 'index']);
Route::get('plan/{plan_id}/delete', [App\Http\Controllers\PlanController::class, 'destroy']);
Route::get('storeDefaultPlan/{category_id}', [App\Http\Controllers\PlanController::class, 'storeDefaultPlan']);
Route::get('storePersonalizedPlan/{category_id}', [App\Http\Controllers\PlanController::class, 'storePersonalizedPlan']);
Route::post('plan/{plan_id}/update', [App\Http\Controllers\PlanController::class, 'update']);
Route::get('plan/{plan_id}/join', [App\Http\Controllers\PlanController::class, 'join']);

Route::get('plan/{plan_id}/workout/{workout_id}', [App\Http\Controllers\WorkoutController::class, 'index']);
Route::get('plan/{plan_id}/workout/{workout_id}/complete', [App\Http\Controllers\WorkoutController::class, 'complete']);
Route::get('plan/{plan_id}/workout/{workout_id}/delete', [App\Http\Controllers\WorkoutController::class, 'destroy']);
Route::post('workout/{workout_id}/update', [App\Http\Controllers\WorkoutController::class, 'update']);
Route::get('plan/{plan_id}/add-workout', [App\Http\Controllers\WorkoutController::class, 'create']);
Route::post('plan/{plan_id}/store-workout', [App\Http\Controllers\WorkoutController::class, 'store']);

Route::get('plan/{plan_id}/workout/{workout_id}/exercise/{exercise_id}/complete', [App\Http\Controllers\ExerciseController::class, 'complete']);
Route::get('plan/{plan_id}/workout/{workout_id}/exercise/{exercise_id}/delete', [App\Http\Controllers\ExerciseController::class, 'destroy']);
Route::post('plan/{plan_id}/workout/{workout_id}/exercise/{exercise_id}/update', [App\Http\Controllers\ExerciseController::class, 'update']);
Route::get('plan/{plan_id}/workout/{workout_id}/add-exercise', [App\Http\Controllers\ExerciseController::class, 'create']);
Route::post('workout/{workout_id}/store', [App\Http\Controllers\ExerciseController::class, 'store']);

Route::get('user/{user_id}', [App\Http\Controllers\UserController::class, 'index']);
Route::get('user/{user_id}/edit', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('user/{user_id}/update', [App\Http\Controllers\UserController::class, 'update']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
