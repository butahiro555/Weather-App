<template>
  <div class="flex flex-wrap justify-center gap-4 lg:flex-row">
    <div
      v-for="(day, index) in weatherData"
      :key="index"
      class="bg-gray-300 rounded shadow-md p-4 mt-4 text-center w-60"
    >
      <p class="text-lg font-bold">{{ day.date }}</p>

      <!-- お天気アイコン表示 -->
      <div class="mb-2">
        <img
          :src="getWeatherIcon(day.weathercode)"
          alt="Weather icon"
          class="w-16 h-16 mx-auto"
        />
      </div>

      <p class="text-sm">最高: {{ day.temp_max }}°C</p>
      <p class="text-sm">最低: {{ day.temp_min }}°C</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    weatherData: {
      type: Array,
      default: () => [],
    },
  },
  methods: {
    // weathercodeに対応する画像URLを返すメソッド
    getWeatherIcon(weathercode) {
      switch (weathercode) {
        case 0:
          return './assets/icons/sunny.png';  // 晴れ
        case 1:
          return '/assets/icons/cloudy.png'; // 曇り
        case 2:
          return '/assets/icons/rain.png';   // 雨
        case 3:
          return '/assets/icons/snow.png'; // 雪
        case 4:
          return '/assets/icons/day-cloudy.png'; // 晴れ時々曇り
        default:
          return '/assets/icons/default.png'; // アイコンが不明な場合
      }
    },
  },
};
</script>