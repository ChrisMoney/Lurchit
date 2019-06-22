<?php
header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';

$jobID = $_GET['JobID'];


$memberSql = "SELECT Latitude, Longitude, Phone FROM Members WHERE ID = (SELECT Customer_ID FROM Carwash WHERE ID = $jobID) ";
$memberResult = mysqli_query($conn, $memberSql);
$memberRow = mysqli_fetch_assoc($memberResult);

$lat = $memberRow['Latitude'];
$long = $memberRow['Longitude'];
$phone = $memberRow['Phone'];

$sql = "SELECT ID, Customer_ID as CustomerID, Lurch_ID as LurchID,
        Carwash as Carwash, Tires as Tires, Interior as Interior,
        Wax, Total as Total, Status, Address, Phone,
        ( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS Distance
    FROM Carwash 
    WHERE ID = $jobID ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    
    $jobDetail = mysqli_fetch_assoc($result);

    $distance = $jobDetail['Distance'];
    $distance = round($distance);
    $jobDetail['Distance'] = $distance . " miles (estimated)";
    $jobDetail['Phone'] = $phone;
    
    echo json_encode($jobDetail);
}
else {
    echo http_response_code(400);
}