<template>
    <div class="flex justify-center mx-auto max-w-2xl min-h-screen items-center flex-col gap-6 px-6">
      <div class="relative w-full items-center">
        <AutoCompleteSearch @updateWeatherData="updateWeatherData" @updateMainData="updateMainData"/>
      </div>
      <div class="relative w-full items-center">
        <CardSection :locations="location" :weatherInfo="currentWeather"/>
      </div>
      <div class="relative w-full items-center">
        <CardSectionWeeks :forecasts="weeklyWeather"/>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentWeather: {
          date: '',
          temp: '25°C',
          icon: 'wi:day-sunny',
          description: 'Sunny'
        },
        weeklyWeather: null,
        location: 'Tokyo'
      };
    },
    methods: {
      async fetchWeatherData() {
        try {
          const response = await fetch(`http://127.0.0.1:8000/api/weather`);
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          const data = await response.json();
          
          this.updateWeatherData(data.data); 
          this.updateMainData({
            mainData: data.mainData, 
            location: 'Tokyo' 
          });
        } catch (error) {
          console.error('Error fetching weather data:', error);
        }
      },
      updateWeatherData(data) {
        this.weeklyWeather = data;
      },
      updateMainData(data) {
        this.currentWeather = data.mainData;
        this.location = data.location;
      },
    },
    mounted() {
      this.fetchWeatherData();
    }
  };
  </script>
  