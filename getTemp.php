<?php

$lat = $_GET['Lat'];
$long = $_GET['Long'];

$jsonurl = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$long&APPID=381eded2dfdd95009347593a63e58125";
$json = file_get_contents($jsonurl);

$weather = json_decode($json);
$kelvin = $weather->main->temp;
$celcius = $kelvin - 240.00;

$temp = round($celcius);

echo json_encode($temp);

?>