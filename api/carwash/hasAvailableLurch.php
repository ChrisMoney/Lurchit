<?php
header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';

$lat = $_GET['Lat'];
$long = $_GET['Long'];

// Determine user location 
$sqlLurch = "SELECT ID,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS distance 
FROM Members
WHERE IsLurchActive = 1 
Group By ID
HAVING distance <= 30";

$lurchResult = mysqli_query($conn, $sqlLurch);
$lurchCount = mysqli_num_rows($lurchResult);

$sqlJobs = "SELECT ID FROM Carwash WHERE Status <> 'complete' And Status <> 'refunded' ";
$jobResult = mysqli_query($conn, $sqlJobs);
$jobCount = mysqli_num_rows($jobResult);

if ($lurchCount > $jobCount) {
    echo 'true';
}
else {
    echo 'false';
}

