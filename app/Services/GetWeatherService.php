<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetWeatherService
{
    public function getWeather($city)
    {
        // .envに設定したOPEN METEO APIのベースURL
        $baseUrl = env('OPEN_METEO_URL');

        // 都市名に対応する緯度・経度を定義
        $citiesCoordinates = [
            '東京' => ['lat' => 35.689, 'lon' => 139.692],
            '大阪' => ['lat' => 34.686, 'lon' => 135.833],
            '福岡' => ['lat' => 33.607, 'lon' => 130.418],
        ];

        // 配列から緯度と経度を取得
        $lat = $citiesCoordinates[$city]['lat'];
        $lon = $citiesCoordinates[$city]['lon'];

        // APIリクエスト用のURLを生成
        $url = $baseUrl . '?latitude=' . $lat . '&longitude=' . $lon . '&daily=temperature_2m_max,temperature_2m_min,weathercode&timezone=Asia%2FTokyo';
        
        // 生成したURLをログに収集しておいて、ブラウザに直接URLを入力して、正しいURLかを確認できるようにしておく
        Log::info('Generated URL: ' . $url);

        // GETリクエストを送信
        $response = Http::get($url);

        // レスポンスをJSON形式で返す
        return $response->json();
    }
}