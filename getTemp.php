<?php

$lat = $_GET['Lat'];
$long = $_GET['Long'];

$jsonurl = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$long&APPID=381eded2dfdd95009347593a63e58125";
$json = file_get_contents($jsonurl);

$weather = json_decode($json, true);
$kelvin = $weather['main']['temp'];
$celcius = $kelvin - 240.00;

$rain = $weather['rain']['1h'];

if ($rain == null) {
    $rain = "";
}

$temp = round($celcius);

$conditions = array("Temp"=>$temp, "Rain"=>$rain);

echo json_encode($conditions, JSON_NUMERIC_CHECK);

?>