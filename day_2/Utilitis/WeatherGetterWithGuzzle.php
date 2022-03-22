<?php

class WeatherGetterWithGuzzle extends WeatherGetterwithCurl
{

    /**
     * @param string $cityname
     * @return stdClass|void|null
     */
    public function getWeatherByCityName(string $cityname)
    {
        $url=$this->utility->generateUrl($cityname);
        $guzzleClient= new GuzzleHttp\Client();

        try {
            $response = $guzzleClient->get($url);
            return json_decode($response->getBody());
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return null;
        }

    }
}