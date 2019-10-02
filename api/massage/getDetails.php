<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$jobID = $_GET['JobID'];


$lurchSql = "SELECT Latitude, Longitude FROM Members WHERE ID = (SELECT Lurch_ID FROM Notifications WHERE Job_ID = $jobID) ";
$lurchResult = mysqli_query($conn, $lurchSql);
$lurchRow = mysqli_fetch_assoc($lurchResult);

$lat = $lurchRow['Latitude'];
$long = $lurchRow['Longitude'];

$sql = "SELECT ID, Customer_ID as CustomerID, Lurch_ID as LurchID,
        Massage as Massage, Longitude, Latitude,
        Wax, Total as Total, Status, Address, (Select Phone FROM Members WHERE ID = (Select Customer_ID FROM Massage WHERE ID = $jobID)) as Phone,
        ( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS Distance
    FROM Massage
    WHERE ID = $jobID ";

$result = mysqli_query($conn, $sql);
$jobDetail = mysqli_fetch_assoc($result);


if(implode(null,$jobDetail) == null) { echo '400'; } else {
    
    
    $distance = $jobDetail['Distance'];
    $distance = round($distance);
    $jobDetail['Distance'] = $distance . " miles (estimated)";
    
    echo json_encode($jobDetail);
}