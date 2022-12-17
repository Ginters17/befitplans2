<?php

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

Route::get('plan/create', function () {
    return view('createCustomPlanPage');
});

Route::get('/information', function () {
    return view('informationPage');
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
