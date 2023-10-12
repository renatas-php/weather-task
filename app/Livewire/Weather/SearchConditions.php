<?php

namespace App\Livewire\Weather;

use Illuminate\Support\Facades\Http;

use Livewire\Component;

class SearchConditions extends Component
{   
    public $city;
    public $errorMessage = null;
    public $results = [];
    public $history = [];

    public function mount()
    {
        if(\App\Helpers\WeatherAPIHelper::getCitySession())
        {
            $this->city = \App\Helpers\WeatherAPIHelper::getCitySession();
            $this->goSearch();
        }
    }

    public function render()
    {   
        return view('livewire.weather.search-conditions');
    }

    public function goSearch()
    {   
        $this->errorMessage = null;
        $this->results = Http::get('http://api.weatherapi.com/v1/forecast.json?key=' . env('WEATHER_API_KEY') . '&q=' . $this->city . '&days=5')->json();
        //$this->history = Http::get('http://api.weatherapi.com/v1/forecast.json?key=' . env('WEATHER_API_KEY') . '&q=' . $this->city . '&days=5')->json();
        //dd($this->history);
        if(isset($this->results['error']))
        {   
            $this->errorMessage = $this->results['error']['message'];
        }

        \App\Helpers\WeatherAPIHelper::putCityToSession($this->city);
    }
}
