<template>
    <Card>
        <CardHeader>
            <div class="flex justify-between items-center">
                <CardTitle class="font-medium">Weather Forecast</CardTitle>
            </div>
        </CardHeader>
        <CardContent>
            <div class="flex gap-6 justify-evenly flex-wrap">
                <div v-for="(forecast, index) in forecasts" :key="index" class="flex flex-col items-center">
                    <h5 class="text-sm">{{ forecast.date }}</h5>
                    <img :src="forecast.icon" alt="Weather Icon" class="text-amber-300 text-4xl"/>
                    <span class="text-slate-500 text-xs">{{ forecast.description }}</span>
                    <span class="text-slate-500 text-xs">{{ forecast.temp }}</span>
                </div>
            </div>
        </CardContent>
        <CardFooter>
        </CardFooter>
    </Card>
</template>

<script>
export default {
    props: {
        forecasts: {
            type: Array,
            default: () => ([
                { date: 'Monday', icon: 'wi:day-sunny', temp: '22°C / 22°C', description: 'Test' },
                { date: 'Monday', icon: 'wi:day-sunny', temp: '22°C / 22°C', description: 'Test' },
                { date: 'Monday', icon: 'wi:day-sunny', temp: '22°C / 22°C', description: 'Test' },
                { date: 'Monday', icon: 'wi:day-sunny', temp: '22°C / 22°C', description: 'Test' },
                { date: 'Monday', icon: 'wi:day-sunny', temp: '22°C / 22°C', description: 'Test' },
                { date: 'Monday', icon: 'wi:day-sunny', temp: '22°C / 22°C', description: 'Test' }
            ])
        }
    }
}
</script>
