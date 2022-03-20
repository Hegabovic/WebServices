<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Weather
 *
 * @author webre
 */
class Weather implements Weather_Interface
{

    //put your code here

    public function __construct()
    {
    }


    public function get_cities(): mixed
    {
        $file = json_decode(file_get_contents('./resources/city.list.json'), true);
        return array_filter($file, function ($city) {
            return $city["country"] === "EG";
        });
    }

    public function get_weather($city): string
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://community-open-weather-map.p.rapidapi.com/weather?q=" . $city . "%2Ceg&units=metric&mode=JSON",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
                "x-rapidapi-key: 37fcb98f9bmshbbc2a97a63934e4p1fc52ajsnc38909c8f3fb"
            ]
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $response;
    }

    public function get_current_time()
    {

    }

    function formTable()
    {
        $cities = new Weather();
        if ($_POST["listOfCities"] !== "-- choose city --") {
            $response = $cities->get_weather($_POST["listOfCities"]);
            $JSONresponse = json_decode($response, true);
            if ($JSONresponse != null) {
                $cityName = $JSONresponse["name"];
                $cityTemp = $JSONresponse["main"]["temp"];
                $citySunset = date('m/d/Y H:i:s', $JSONresponse["sys"]["sunset"]);
                $citySunrise = date('m/d/Y H:i:s', $JSONresponse["sys"]["sunrise"]);
                $cityDesc = $JSONresponse["weather"]["0"]["description"];
                $cityWind = $JSONresponse["wind"]["speed"];
                $cityImg = $JSONresponse["weather"]["0"]["icon"];
                echo "<table class='table-css'>";
                echo "<tr><th colspan='2'> $cityName $cityImg </th></tr>";
                echo "<tr><th colspan='2'> $cityImg </th></tr>";
                echo "<tr><th colspan='2'> <img src='http://openweathermap.org/img/wn/".$cityImg."@2x.png'></th></tr>";
                echo "<tr><th>Temp</th><td> $cityTemp °C</td></tr>";
                echo "<tr><th>Sunset</th><td> $citySunset</td></tr>";
                echo "<tr><th>Sunrise</th><td> $citySunrise</td></tr>";
                echo "<tr><th>Sky status</th><td> $cityDesc</td></tr>";
                echo "<tr><th>Wind</th><td> $cityWind</td></tr>";
                echo "</table>";
            }else{
                echo "No data Available at the moment";
            }
        } else {
            echo "<h4><span style='color:red'>*</span>please choose a city</h4>";
        }
    }

}
