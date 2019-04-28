<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];
$lat = $_GET['Lat'];
$long = $_GET['Long'];

$sql = "SELECT ID FROM Notifications WHERE New = 1 And Lurch_ID = $id 
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS distance 
FROM Members
WHERE IsLurchActive = 1 
Group By ID
HAVING distance <= 15";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo json_encode('true');
}
else {
    echo json_encode('false');
}