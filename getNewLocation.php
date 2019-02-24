<?php

// Google Map API Key: AIzaSyCoRTbekTZbeNP03VMkpyx-N9Lcfe2XGP0
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

/*
 * 38.672287
 * -90.440702
 */
$id = $_GET['ID'];
$lat = $_GET['Lat'];
$long = $_GET['Long'];
$city = $_GET['City'];
$state = $_GET['State'];
$country = $_GET['Country'];

$sql = "Update Members Set City = '$city', State = '$state', Country = '$country', Longitude = '$long', Latitude = '$lat' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
    
