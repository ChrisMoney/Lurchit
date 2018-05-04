<?php
// AIzaSyCoRTbekTZbeNP03VMkpyx-N9Lcfe2XGP0
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$lat = $_GET['Lat'];
$lng = $_GET['Long'];
//https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key
$data = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=38.672287,-90.440702&sensor=false&key=AIzaSyCoRTbekTZbeNP03VMkpyx-N9Lcfe2XGP0");
$data = json_decode($data);
$add_array  = $data->results;
$add_array = $add_array[0];
$add_array = $add_array->address_components;
$country = "N/A";
$state = "N/A";
$city = "N/A";

foreach ($add_array as $key) {
    if($key->types[0] == 'administrative_area_level_2')
    {
        $city = $key->long_name;
    }
    if($key->types[0] == 'administrative_area_level_1')
    {
        $state = $key->long_name;
    }
    if($key->types[0] == 'country')
    {
        $country = $key->long_name;
    }
}
$location = array();
$location['City'] = $city;
$location['State'] = $state;
$location['Country'] = $country;
$currentLocation = (object)$location;

echo json_encode($currentLocation);