<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlaceSearchController extends Controller
{

    public function search(Request $request)
    {
        $query = $request['query'];
        $apiKey = config('app.apiKeys.geoApify.key');;
        $data = [];

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Accept' => 'application/json',
        ])->get('https://api.geoapify.com/v1/geocode/autocomplete', [
            'text' => $query,
            'filter' => 'countrycode:jp',
            'format' => 'json',
            'bias' => 'countrycode:jp',
            'limit' => 15,
        ]);

        foreach ($response['results'] as $responses) {
            if (isset($responses['address_line1'])) {
                $data[] = [
                    "name" =>  isset($responses['address_line1']) ? $responses['address_line1'] : '',
                    "lat" => isset($responses['lat']) ? $responses['lat'] : '',
                    "lon" => isset($responses['lon']) ? $responses['lon'] : '',
                ];
            }
        }

        return $data;
    }
}
