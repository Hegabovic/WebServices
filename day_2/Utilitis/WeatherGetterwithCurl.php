<?php
require_once "vendor/autoload.php";
class WeatherGetterwithCurl
{

    protected Utilities $utility;

    public function __construct()
    {
        $this->utility=new Utilities();
    }

    /**
     * @param string $cityname
     * @return stdClass|null
     */
    public function getWeatherByCityName(string $cityname)
{
    $curl = curl_init();
    $url=$this->utility->generateUrl($cityname);
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
            "x-rapidapi-key: a5e39bc58dmsh8c18d8991d4534cp1c4948jsnc4929efd4d93"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
        return null;
    } else {
        $response=json_decode($response);
        return $response;
    }
}
}