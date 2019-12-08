<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$lat = $_GET['Lat'];
$long = $_GET['Long'];
$device = $_GET['DEVICE'];
$distance = MassageRadius;

// Determine user location 
$sqlLurch = "SELECT ID,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS distance 
FROM Members
WHERE IsLurchActive = 1
AND ID NOT IN (SELECT Lurch_ID FROM  Massage WHERE Status <> 'complete' And Status <> 'refunded')
Group By ID
HAVING distance <= $distance
LIMIT 1";

$lurchResult = mysqli_query($conn, $sqlLurch);
$lurchRow = mysqli_fetch_assoc($lurchResult);
$lurchID = $lurchRow['ID'];
echo 'true';

/*if ($lurchID > 0) {
        echo json_encode('true');
    }

else {
        echo json_encode('false');
}

*/