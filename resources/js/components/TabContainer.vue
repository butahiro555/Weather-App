<template>
  <div>
    <h1 class="text-center text-2xl text-white font-bold pt-10">1週間の気温</h1>

    <div class="flex justify-center space-x-4 p-5 mb-3">
      <Tab
        v-for="city in cities"
        :key="city.name"
        :name="city.name"
        :isActive="city.name === selectedCity"
        @select="selectCity"
      />
    </div>

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
        "東京": [],
        "大阪": [],
        "福岡": [],
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
      const response = await fetch(window.apiRoutes.getWeather + `?city=${city}`);
      const data = await response.json();
      
      // レスポンスを表示用に整理
      this.weatherData[city] = data.daily.temperature_2m_max.map((temp, index) => ({
        date: new Date(data.daily.time[index]).toLocaleDateString(),
        temp_max: temp,
        temp_min: data.daily.temperature_2m_min[index],
        weathercode: data.daily.weathercode[index],
      }));
    },
  },
};
</script>