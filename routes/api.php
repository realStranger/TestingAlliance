<?php

use App\Http\Api\Controllers\DeviceStateController;
use App\Http\Api\Controllers\UserController;
use App\Http\Api\Controllers\UserDeviceController;
use App\Http\Middleware\CheckUserToken;
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

Route::group([
    'prefix' => '/user/device',
    'middleware' => [CheckUserToken::class]
], function () {
    Route::get('/get', [UserDeviceController::class, 'get']);
    Route::post('/add', [UserDeviceController::class, 'add']);

    Route::group(['prefix' => '/state/{device_id}'], function () {
        Route::get('/get', [DeviceStateController::class, 'get']);
        Route::post('/set', [DeviceStateController::class, 'set']);
    });
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
