<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetWeatherService
{
    public function getWeather($city)
    {
        // ログに市名を記録
        Log::info('Entering getWeather method with city: ' . $city);

        try {
            // .envに設定したOPEN METEO APIのベースURL
            $baseUrl = env('OPEN_METEO_URL');
            Log::info('Base URL: ' . $baseUrl); // URLが正しく取得されているか確認

            // 都市名から緯度と経度を取得
            $cityCoordinates = DB::table('cities')->where('name', $city)->first();
            Log::info('City coordinates: ' . json_encode($cityCoordinates)); // 緯度と経度をログに出力

            if (!$cityCoordinates) {
                throw new \Exception("City not found in the database.");
            }

            // オブジェクトから緯度と経度を取得
            $lat = $cityCoordinates->lat;
            $lon = $cityCoordinates->lon;

            // APIリクエスト用のURLを生成
            $url = $baseUrl . '?latitude=' . $lat . '&longitude=' . $lon . '&daily=temperature_2m_max,temperature_2m_min,weathercode&timezone=Asia%2FTokyo';
            
            // 生成したURLをログに収集しておいて、ブラウザに直接URLを入力して、正しいURLかを確認
            Log::info('Generated URL: ' . $url);

            // GETリクエストを送信
            $response = Http::get($url);

            // HTTPリクエストが成功したか確認
            if ($response->failed()) {
                Log::error('API Request Failed', ['url' => $url, 'response' => $response->body()]); // レスポンスの内容を記録
                throw new \Exception("Failed to fetch weather data from the API.");
            }

            // レスポンスをJSON形式で返す
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Error in getWeather: ' . $e->getMessage()); // エラーメッセージをログに記録
            throw $e;
        }
    }
}
