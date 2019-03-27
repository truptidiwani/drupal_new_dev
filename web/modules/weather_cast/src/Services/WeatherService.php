<?php

namespace Drupal\weather_cast\Services;

use Guzzle\Http\Client;

class WeatherService{
    public function get_weather($city)
    {
        $config = \Drupal::config('weather_cast.settings');
        $appid = $config->get('app');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET' , 'https://samples.openweathermap.org/data/2.5/weather?q='.$city.'&appid='.$appid);
        //kint($response->getBody());
        //exit();
        return $response->getBody();  
    }
}
