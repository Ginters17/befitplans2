<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlanController;

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

Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('plan/{plan_id}', [App\Http\Controllers\PlanController::class, 'index']);

Route::get('user/{user_id}', [App\Http\Controllers\UserController::class, 'index']);
Route::get('user/{user_id}/edit', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('user/{user_id}/update', [App\Http\Controllers\UserController::class, 'update']);

Route::get('storeDefaultPlan/{category_id}', [App\Http\Controllers\PlanController::class, 'storeDefaultPlan']);
Route::get('storePersonalizedPlan/{category_id}', [App\Http\Controllers\PlanController::class, 'storePersonalizedPlan']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
