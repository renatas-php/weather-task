<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class WeatherAPIHelper {

    public function existProperty()
    {

    }

    public static function getClothesRecomendationByTemp(string $text): array
    {   
        $roundedTemp = round($text);

        switch($roundedTemp) {
            case $roundedTemp < -10:
                return ['wear warm jacket', 'warm hat', 'gloves', 'warm socks'];
                break;
            case $roundedTemp < 0:
                return ['wear warm jacket', 'warm hat', 'gloves'];
                break;
            case $roundedTemp < 10:
                return ['wear warm jacket', 'warm hat'];
                break;
            case $roundedTemp > 10 && $roundedTemp < 16:
                return ['wear jacket', ];
                break;
            case $roundedTemp > 16 && $roundedTemp < 22:
                return ['wear something with long sleeves'];
                break;
            case $roundedTemp > 22 && $roundedTemp < 28:
                return ['wear light pants and t-shirts', 'can take sunhat'];
                break;
            case $roundedTemp > 28 && $roundedTemp < 38:
                return ['wear shorts and t-shirts', 'take sunhat'];
                break;
            case $roundedTemp > 38:
                return ['recommend to stay in permises with air condition'];
                break;
            default: 
                return [];
        }
    }

    public static function isRaining(string $text)
    {          
        switch($text) {
            case str_contains($text, 'rain') == true:
                return 'take umbrella';
                break;
        }
    }

    public static function putCityToSession(string $text): void {
        Session::put('city', $text);
    }

    public static function getCitySession() {
        $city = Session::get('city');
        return $city;
    }

}
