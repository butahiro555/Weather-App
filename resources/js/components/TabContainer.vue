<template>
  <div>
    <!-- 見出し -->
    <h1 class="text-center text-2xl text-white font-bold pt-10">1週間の気温</h1>

    <!-- タブの選択 -->
    <div class="flex justify-center space-x-4 p-5 mb-3">
      <Tab
        v-for="city in cities"
        :key="city.name"
        :name="city.name"
        :isActive="city.name === selectedCity"
        @select="selectCity"
      />
    </div>

    <!-- 天気情報表示 -->
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
      cities: [
        { name: "東京" },
        { name: "大阪" },
        { name: "福岡" },
      ],
      weatherData: {
        "東京": [], // 東京の天気データ
        "大阪": [], // 大阪の天気データ
        "福岡": [], // 福岡の天気データ
      },
    };
  },
  mounted() {
    this.fetchWeatherData("東京");
    this.fetchWeatherData("大阪");
    this.fetchWeatherData("福岡");
  },
  methods: {
    selectCity(city) {
      this.selectedCity = city; // 選択された都市に切り替え
    },
    async fetchWeatherData(city) {
      // Open-Meteo APIを使って都市ごとの天気情報を取得
      const citiesCoordinates = {
        "東京": { lat: 35.689, lon: 139.692 },
        "大阪": { lat: 34.686, lon: 135.833 },
        "福岡": { lat: 33.607, lon: 130.418 },
      };
      const { lat, lon } = citiesCoordinates[city];
      const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&daily=temperature_2m_max,temperature_2m_min,weathercode&timezone=Asia%2FTokyo`;

      try {
        const response = await fetch(url);
        const data = await response.json();
        this.weatherData[city] = data.daily.temperature_2m_max.map((temp, index) => ({
          date: new Date(data.daily.time[index]).toLocaleDateString(),
          temp_max: temp,
          temp_min: data.daily.temperature_2m_min[index],
          weathercode: data.daily.weathercode[index], // weathercodeを追加
        }));
      } catch (error) {
        console.error(`${city}の天気情報の取得に失敗しました:`, error);
      }
    },
  },
};
</script>