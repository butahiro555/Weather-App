<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GetWeatherService;

class GetWeatherController extends Controller
{
    public function getCoordinates(Request $request)
    {
        // 都市名を取得
        $city = $request->input('city');

        // GetWeatherServiceクラスのgetWeatherメソッドを呼び出し、都市名に対応する緯度・経度を取得
        $weatherService = new GetWeatherService();
        $coordinates = $weatherService->getWeather($city);

        // 緯度と経度をTabContainer.vueに返す
        return response()->json($coordinates);
    }
}