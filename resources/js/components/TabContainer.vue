<template>
  <div>
    <h1 class="text-center text-2xl text-white font-bold pt-5">1週間の気温</h1>
    
    <!-- 検索バー -->
    <div class="flex justify-center p-5 mb-3">
      <input
        v-model="searchKeyword"
        @keyup.enter="searchCity"
        class="border rounded p-2 w-1/2"
        placeholder="都市名を入力してください (例: 東京)"
      />
    </div>

    <!-- タブ (既存部分) -->
    <div class="flex justify-center space-x-4 mb-3">
      <Tab
        v-for="city in cities"
        :key="city.name"
        :name="city.name"
        :isActive="city.name === selectedCity"
        @select="selectCity"
      />
    </div>

    <!-- 天気表示 -->
    <WeatherDisplay :weatherData="weatherData[selectedCity]" />
  </div>
</template>


<script>

import Tab from "./Tab.vue";
import WeatherDisplay from "./WeatherDisplay.vue";

export default {
  components: { Tab, WeatherDisplay },
  data() {
    return {
      selectedCity: "東京", // 初期選択の都市
      cities: [{ name: "東京" }], // 初期は東京のみ
      weatherData: { "東京": [] }, // 各都市の天気データ
      searchKeyword: "", // 検索キーワード
    };
  },
  mounted() {
    this.fetchWeatherData("東京");
  },
  methods: {
    // 都市の天気データを取得
    async fetchWeatherData(city) {
      try {
        const response = await fetch(window.apiRoutes.getWeather + `?city=${city}`);
        const data = await response.json();

        // データ整形
        this.weatherData[city] = data.daily.temperature_2m_max.map((temp, index) => ({
          date: new Date(data.daily.time[index]).toLocaleDateString(),
          temp_max: temp,
          temp_min: data.daily.temperature_2m_min[index],
          weathercode: data.daily.weathercode[index],
        }));

        // 都市リストに追加 (3つまで制限)
        if (!this.cities.some((c) => c.name === city)) {
          if (this.cities.length >= 3) {
            // 配列の最初の都市を削除 (古い都市を削除)
            const removedCity = this.cities.shift();
            delete this.weatherData[removedCity.name]; // データも削除
          }
          this.cities.push({ name: city }); // 新しい都市を追加
        }

        // 選択中の都市を更新
        this.selectedCity = city;
      } catch (error) {
        alert("天気情報の取得に失敗しました。都市名を確認してください。");
        console.error(error);
      }
    },

    // タブで都市を選択
    selectCity(city) {
      this.selectedCity = city;
    },

    // 検索キーワードを基に天気データを取得
    searchCity() {
      const city = this.searchKeyword.trim();
      if (city) {
        this.fetchWeatherData(city); // キーワードに基づいてデータ取得
        this.searchKeyword = ""; // 検索バーをリセット
      }
    },
  },
};

</script>