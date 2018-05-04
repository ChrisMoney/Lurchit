<?php
// Google Map API Key: AIzaSyCoRTbekTZbeNP03VMkpyx-N9Lcfe2XGP0
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

/*
 * 38.672287
 * -90.440702
 */
$lat = $_GET['Lat'];
$long = $_GET['Long'];
$data = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=AIzaSyCoRTbekTZbeNP03VMkpyx-N9Lcfe2XGP0");
$data = json_decode($data);
$add_array  = $data->results;
$add_array = $add_array[0];
$add_array = $add_array->address_components;
$country = "N/A";
$state = "N/A";
$city = "N/A";

foreach ($add_array as $key) {
    if($key->types[0] == 'locality')
    {
        $city = $key->short_name;
    }
    if($key->types[0] == 'administrative_area_level_1')
    {
        $state = $key->short_name;
    }
    if($key->types[0] == 'country')
    {
        $country = $key->short_name;
    }
}
$location = array();
$location['City'] = $city;
$location['State'] = $state;
$location['Country'] = $country;
$currentLocation = (object)$location;

echo json_encode($currentLocation);