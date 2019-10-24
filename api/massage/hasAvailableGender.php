<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$gender = $_GET['Gender'];
$lat = $_GET['Lat'];
$long = $_GET['Long'];
$device = $_GET['DEVICE'];

if ($gender == 'Male') {
    $genderSql = "WHERE Gender = 'Male'";
}
elseif ($gender == 'Female') {
    $genderSql = "WHERE Gender = 'Female'";
}
else {
    $genderSql = "WHERE (Gender = 'Male' Or Gender = 'Female')";
}

// Determine user location 
$sqlLurch = "SELECT ID,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS distance 
FROM Members
$genderSql
Group By ID
HAVING distance <= 30";

$genderResult = mysqli_query($conn, $sqlLurch);
$lurchCount = mysqli_num_rows($genderResult);

if ($lurchCount > 0) {
        echo json_encode(true);
    }

else {
        echo json_encode(false);
}

