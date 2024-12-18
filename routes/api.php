<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetWeatherController;

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

// TabContainer.vueからAPIリクエストをGetWeatherControllerに送信して、天気情報のURLを要求するAPIルート
Route::get('/getWeather', [GetWeatherController::class, 'getCoordinates'])->name('getWeather');