<?php
namespace Drupal\weather_cast\Services;

class WeatherService{   
/*
@param city 
    */
    public function get_weather($city){
        $config = \Drupal::config('weather_cast.settings');
        $appid = $config->get('app');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET' , 'https://samples.openweathermap.org/data/2.5/weather?q='.$city.'&appid='.$appid);
        return $response->getBody();  
    }
    
}