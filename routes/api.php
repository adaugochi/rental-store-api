<?php

use App\Http\Controllers\Api\RentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'App\Http\Controllers\Api'
], function () {
    Route::apiResource('rents', 'RentController');
    Route::get('rents/{type}/{status}', [RentController::class, 'statisticLogs']);
    Route::get('rent/logs', [RentController::class, 'getLogs']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}/rents', [UserController::class, 'getUserRents']);
});

