<?php

if(_devMode) {
    ini_set("memory_limit", -1);
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
}

require_once "vendor/autoload.php";
$pageRender=new ClientPageRenderer();
/*$apiCaller=new WeatherGetterwithCurl();*/
$apiCaller= new WeatherGetterWithGuzzle();

?>
<html>
<head>
    <title>Get Weather</title>
    <link rel="stylesheet" href="Static/css/style.css">
</head>
<body>
<header class="flex">
    <h1> Get Weather by city</h1>
</header>
<main class='flex flex-space-around'>
    <div id="form-container">
    <h2> chooose a city</h2>
    <?php
    $pageRender->renderform();
    ?>
    </div>
    <?php
    if(isset($_POST["cityname"]))
    {
        $name=$_POST["cityname"];
        $response=$apiCaller->getWeatherByCityName($name);
        echo "<div id='response-container' >";
        if(!is_null($response)) {
            $pageRender->renderResponce($response);
        } else
        {
            echo "<h2 class='error'>Error Pleas try again later</h2>";
        }
        echo "</div>";
    }

    ?>
</main>
</body>
</html>

