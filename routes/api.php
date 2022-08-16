<?php

use App\Http\Controllers\Api\{AuthController, DeviceController, FileController, PushNotificationController};
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

Route::controller(AuthController::class)
    ->prefix("auth")
    ->name("auth.")
    ->group(function () {
        Route::post('register', 'Register')->name("register");
        Route::post('login', 'Login')->name("login");
        Route::post('logout', 'Logout')->name("logout");
        Route::match(["get", "head"], 'me', 'Me')->name("me");
        Route::match(["get", "post"], 'beams', 'Beams')->name("beams");
    });

Route::apiResource('devices', DeviceController::class)->except(['show', 'update']);

Route::controller(PushNotificationController::class)
    ->prefix("push_notification")
    ->name("push_notification.")
    ->group(function () {
        Route::post('users', 'publishToUsers')->name("publishToUsers");
    });

Route::controller(FileController::class)
    ->prefix('file')
    ->name('file.')
    ->group(function () {
        Route::get("", 'index')->name('index');
        Route::post("", 'store')->name('store');
        Route::delete("", 'destroy')->name('destroy');
    });
