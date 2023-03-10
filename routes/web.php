<?php


use App\Http\Middleware\VerifyCsrfToken;
use App\Services\StravaWebhookService;
use App\Services\StravaAPIService;
use Illuminate\Http\Request;
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

Route::get('/', function ()
{
    return view('homePage');
});

Auth::routes();

Route::get('settings', [App\Http\Controllers\SettingsController::class, 'index']);

/// Strava API
Route::get('auth', function (Request $request)
{
    return app(StravaAPIService::class)->processAuthorization($request);
});
Route::get('/webhook', function (Request $request)
{
    $mode = $request->query('hub_mode'); 
    $verify_token = $request->query('hub_verify_token'); 
    $challenge = $request->query('hub_challenge'); 

    return app(StravaWebhookService::class)->validate($mode, $verify_token, $challenge);
});
Route::post('/webhook', function (Request $request)
{
    return app(StravaWebhookService::class)->processWebhookPost($request);
})->withoutMiddleware(VerifyCsrfToken::class);

Route::get('/information', function () {
    return view('informationPage');
});

/// Plan routes
Route::get('plan/create', function ()
{
    return view('createCustomPlanPage');
});
Route::post('plan/storeCustomPlan', [App\Http\Controllers\PlanController::class, 'storeCustomPlan']);
Route::get('plan/create', [App\Http\Controllers\PlanController::class, 'createCustomPlan']);
Route::get('plan/{plan_id}', [App\Http\Controllers\PlanController::class, 'index']);
Route::get('plan/{plan_id}/delete', [App\Http\Controllers\PlanController::class, 'destroy']);
Route::post('plan/{plan_id}/update', [App\Http\Controllers\PlanController::class, 'update']);
Route::get('plan/{plan_id}/join', [App\Http\Controllers\PlanController::class, 'join']);
Route::get('plan/{plan_id}/complete', [App\Http\Controllers\PlanController::class, 'complete']);
Route::post('storePlan', [App\Http\Controllers\PlanController::class, 'storePlan']);

/// Workouts routes
Route::get('plan/{plan_id}/workout/{workout_id}', [App\Http\Controllers\WorkoutController::class, 'index']);
Route::get('plan/{plan_id}/workout/{workout_id}/complete', [App\Http\Controllers\WorkoutController::class, 'complete']);
Route::get('plan/{plan_id}/workout/{workout_id}/delete', [App\Http\Controllers\WorkoutController::class, 'destroy']);
Route::post('workout/{workout_id}/update', [App\Http\Controllers\WorkoutController::class, 'update']);
Route::get('plan/{plan_id}/add-workout', [App\Http\Controllers\WorkoutController::class, 'create']);
Route::post('plan/{plan_id}/store-workout', [App\Http\Controllers\WorkoutController::class, 'store']);

/// Exercise routes
Route::get('plan/{plan_id}/workout/{workout_id}/exercise/{exercise_id}/complete', [App\Http\Controllers\ExerciseController::class, 'complete']);
Route::get('plan/{plan_id}/workout/{workout_id}/exercise/{exercise_id}/delete', [App\Http\Controllers\ExerciseController::class, 'destroy']);
Route::post('plan/{plan_id}/workout/{workout_id}/exercise/{exercise_id}/update', [App\Http\Controllers\ExerciseController::class, 'update']);
Route::get('plan/{plan_id}/workout/{workout_id}/exercise/{exercise_id}/remove-strava-activity', [App\Http\Controllers\ExerciseController::class, 'removeStravaActivity']);
Route::post('plan/{plan_id}/workout/{workout_id}/exercise/{exercise_id}/add-strava-activity', [App\Http\Controllers\ExerciseController::class, 'addStravaActivity']);
Route::get('plan/{plan_id}/workout/{workout_id}/add-exercise', [App\Http\Controllers\ExerciseController::class, 'create']);
Route::post('workout/{workout_id}/store', [App\Http\Controllers\ExerciseController::class, 'store']);

/// User routes
Route::get('user/{user_id}', [App\Http\Controllers\UserController::class, 'index']);
Route::get('user/{user_id}/edit', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('user/{user_id}/update', [App\Http\Controllers\UserController::class, 'update']);
Route::get('user/{user_id}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

/// Personalization, localizationm
Route::get('theme/{theme}', [App\Http\Controllers\ThemeController::class, '__invoke']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
