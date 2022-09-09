<?php

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
], function () {
    Route::apiResource('drivers', App\Http\Controllers\Api\V1\DriverController::class);
    Route::apiResource('cars', App\Http\Controllers\Api\V1\CarController::class);
    Route::apiResource('car-drivings', App\Http\Controllers\Api\V1\CarDrivingController::class);
    Route::post('start-drive', [App\Http\Controllers\Api\V1\CarDrivingController::class, 'startDrive'])->name('drive.start');
    Route::post('finish-drive', [App\Http\Controllers\Api\V1\CarDrivingController::class, 'finishDrive'])->name('drive.finish');
});
