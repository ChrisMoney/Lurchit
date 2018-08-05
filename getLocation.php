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
$updateLocation = $_GET['UpdateLocation'];

$data = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=AIzaSyCoRTbekTZbeNP03VMkpyx-N9Lcfe2XGP0");
$data = json_decode($data);
$add_array  = $data->results;
$add_array = $add_array[0];
$add_array = $add_array->address_components;
$country = "N/A";
$state = "N/A";
$city = "N/A";





if ($updateLocation == 'false' || $updateLocation == false || 
    $updateLocation == 0 || $updateLocation == '0') {
    // do nothing no current location is to be fetched
    
    $sql = "SELECT City, State ,Country, FullLocation FROM Members WHERE ID = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $location = $row;
        
    $location['FullLocation'] = $row['City'] . ',' . $row['State'] .' '. $row['Country'];
    echo json_encode($location);
    exit();
}
else {
    
    
    if (isset($lat) && !empty($lat)) {
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
        
        $location['City'] = $city;
        $location['State'] = $state;
        $location['Country'] = $country;
        
        if (strlen($location['City']) == 0 ) {
            $location = "Location Unavailable";
        }
        
        echo json_encode($location);
        
        
    }
    
    
}



