<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EgressController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\StallController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\ManagementMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'optimizeImages', ManagementMiddleware::class]], function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('users', UsersController::class);
    Route::resource('entry', EntryController::class);
    Route::resource('egress', EgressController::class);
    Route::resource('fruit', FruitController::class);
    Route::resource('cities', CityController::class);
    Route::resource('provinces', ProvinceController::class);
    Route::resource('halls', HallController::class);
    Route::resource('stalls', StallController::class);
    Route::any('exports', [ExportController::class, 'index'])->name('download');
    Route::post('auth/logout', [AuthController::class, 'destroy']);
});
