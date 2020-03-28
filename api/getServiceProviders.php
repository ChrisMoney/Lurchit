<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require 'connect.php';
include_once 'helpers.php';

$distance = $_GET['Distance'];
$service = $_GET['Service'];
$lat = $_GET['Lat'];
$long = $_GET['Long'];

$myArray = array();

$sql = "SELECT DISTINCT(ID),Username, MinPrice, Blurb, ProfilePhoto, ( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS Distance
FROM Members
WHERE IsLurch = 1
And IsLurchActive = 1
And Service = '$service'
Group By ID
HAVING Distance <= $distance
ORDER BY IsProfilePremium DESC, Distance ASC, MinPrice ASC
";

$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
        
        while ($serviceProviders = mysqli_fetch_assoc($result)) {
            
            $profilePhoto = $serviceProviders['ProfilePhoto'];
            $minPrice = $serviceProviders['MinPrice'];
            $minPrice = "Min $".$minPrice;
            $serviceProviders['MinPrice'] = $minPrice;
            
            if (strlen($profilePhoto) > 1) {
                $profilePhoto = ProfileMediaPath.$profilePhoto;
                $serviceProviders['ProfilePhoto'] = $profilePhoto;
            }
            $myArray[] = $serviceProviders;
        }
        echo json_encode($myArray, JSON_PRETTY_PRINT);
    }
    else {
        echo json_encode(201, JSON_NUMERIC_CHECK);
    }
}
else {
    echo json_encode(201, JSON_NUMERIC_CHECK);
}
