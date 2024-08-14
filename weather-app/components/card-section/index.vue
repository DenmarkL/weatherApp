<template>
    <Card>
      <CardHeader>
        <div class="flex justify-between items-center">
          <CardTitle class="text-3xl">{{ locations }}</CardTitle>
          <img :src="weatherInfo.icon" alt="" class="text-amber-300 text-4xl"/>
        </div>
        <div class="text-2xl">{{ weatherInfo.date }}</div>
      </CardHeader>
      <CardContent>
        <div class="font-bold text-2xl">{{ weatherInfo.temp }}</div>
        <div>{{ weatherInfo.description }}</div>
      </CardContent>
      <CardFooter>
      </CardFooter>
    </Card>
  </template>
  
  <script>
  export default {
    props: {
      locations: {
        type: String,
        default: 'Japan'
      },
      weatherInfo: {
        type: Object,
        required: true,
        default: () => ({
          date: '',
          icon: 'http://openweathermap.org/img/wn/01d.png',  
          temp: '25°C',          
          description: 'Sunny'   
        })
      }
    }
  };
  </script>
  