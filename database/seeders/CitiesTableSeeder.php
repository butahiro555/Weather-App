<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => '東京', 'lat' => 35.689, 'lon' => 139.692],
            ['name' => '大阪', 'lat' => 34.686, 'lon' => 135.833],
            ['name' => '福岡', 'lat' => 33.607, 'lon' => 130.418],
            ['name' => '名古屋', 'lat' => 35.181, 'lon' => 136.906],
            ['name' => '札幌', 'lat' => 43.061, 'lon' => 141.354],
            // 他の都市情報を追加する場合はここに書く
        ]);
    }
}