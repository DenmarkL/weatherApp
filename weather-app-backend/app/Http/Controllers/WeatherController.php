<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(WeatherRequest $request)
    {
        $apiKey = config('app.apiKeys.openWeatherMap.key');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $data = [];
        $mainData = null;

        $response = Http::get('http://api.openweathermap.org/data/2.5/forecast', [
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'en',
            'lat' => $latitude,
            'lon' => $longitude,
            'cnt' => 7
        ]);

        $list = $response['list'];
        $closestTime = Carbon::now()->startOfDay();

        foreach ($list as $item) {
            $itemTime = Carbon::parse($item['dt_txt']);
            $formattedTime = $itemTime->format('h:i A');
            $itemData = [
                "description" => $item['weather'][0]['main'],
                "icon" => "http://openweathermap.org/img/wn/" . $item['weather'][0]['icon'] . ".png",
                "temp" => $item['main']['temp'] . '°C',
                "date" => $formattedTime
            ];

            if ($itemTime->isToday() && $itemTime->gt($closestTime)) {
                if (!$mainData || $itemTime->lessThan($closestTime)) {
                    $mainData = $itemData;
                    $closestTime = $itemTime;
                }
            } else {
                $data[] = $itemData;
            }
        }

        return [
            'mainData' => $mainData,
            'data' => $data
        ];
    }
}
