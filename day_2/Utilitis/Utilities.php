<?php

class Utilities
{
    public function createList() :array
    {
        $jsonst=file_get_contents("Resources/city.list.json");
        $countriesArr=json_decode($jsonst,true);
        $egyptiancities=array_filter($countriesArr,function($v,$k){

            return $v["country"]=="EG";
        },ARRAY_FILTER_USE_BOTH);

        return $egyptiancities;
    }
    public function generateUrl(string $cityName) : string
    {

       $cityName= str_replace(" ","%20",$cityName);
       if(_guzzle){
        return "api.openweathermap.org/data/2.5/weather?q=".$cityName.",eg&lat=0&lon=0&id=2172797&lang=null&units=metric&mode=json&APPID="._key;}
       else{
           return "https://community-open-weather-map.p.rapidapi.com/weather?q=".$cityName."%2Ceg&lat=0&lon=0&id=2172797&lang=null&units=metric&mode=json";
       }
    }
}