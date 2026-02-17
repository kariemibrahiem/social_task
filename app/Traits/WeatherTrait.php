<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Stevebauman\Location\Facades\Location; 

trait WeatherTrait
{
    public function GetWeatherClient()
    {
        return new Client([
            "base_uri" => "https://api.openweathermap.org/data/2.5/",
            "timeout"  => 5.0,
            "verify"   => false
        ]);
    }

    public function GetWeather($lat, $lon)
    {
        try {

            $client = $this->GetWeatherClient();

            $location = Location::get(request()->ip());

            if ($location && $location->latitude && $location->longitude) {
                
                $lat = $location->latitude;
                $lon = $location->longitude;
            } else {
                
                $lat = $lat;
                $lon = $lon;
            }

            $response = $client->get("weather", [
                "query" => [
                    "lat" => $lat,
                    "lon" => $lon,
                    "appid" => env("WEATHER_API_KEY"), 
                    "units" => "metric"
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $data = [
                "temp"      => $data['main']["temp"],
                "pressure"  => $data['main']["pressure"],
                "humidity"  => $data['main']["humidity"],
                "wind_speed" => $data['wind']["speed"]
            ];
            return $data;
        } catch (\Exception $e) {
            
            $data = [
                "temp"      => 0,
                "pressure"  => 0,
                "humidity"  => 0,
                "wind_speed" => 0
            ];
            return $data;
        }
    }
}
