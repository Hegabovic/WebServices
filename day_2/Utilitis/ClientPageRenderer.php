<?php

class ClientPageRenderer
{
 public function renderform()
 {
     $utility=new Utilities();
     $citiesArr=$utility->createList();
     $formaction=$_SERVER["PHP_SELF"];
     echo "<form action='$formaction' method='post'>";
     echo "<select name='cityname'>";
     foreach ($citiesArr as  $city)
     {
         $cityId=$city["id"];
         $cityName=$city["name"];
        echo "<option value='$cityName'>EG>>$cityName</option>";
     }
     echo "</select>";
     echo "<input type='submit' value='send'>";
     echo "</form>";
 }


 public function renderResponce(stdClass $response)
 {

        $data=[];
        $weather=$response->weather["0"];
        $mainFeatures=$response->main;
        $sys=$response->sys;
        $dayTime=$response->dt;
        $data["Time now"]=date('l jS \of F Y h:i:s A',$dayTime);
        $data["main State"]=$weather->main;
        $data["description"]=$weather->description;
        $icon=$weather->icon;
        $data["Temperature"]=$mainFeatures->temp."C";
        $data["feels Like"]=$mainFeatures->feels_like."C";
        $data["min Temp"]=$mainFeatures->temp_min."C";
        $data["max Temp"]=$mainFeatures->temp_max."C";
        $data["sunrise"]=date('h:i A',$sys->sunrise);
        $data["sunset"]=date('h:i A',$sys->sunset);
        $cityName=$response->name;


    echo "<h3> $cityName current state:</h3>  <img src='http://openweathermap.org/img/wn/".$icon."@2x.png'> </br>";
    echo "<ul>";
    foreach ($data as $key=>$value)
    {
        echo "<li>$key : $value </li>";
    }
    echo "</lu>";
 }
}