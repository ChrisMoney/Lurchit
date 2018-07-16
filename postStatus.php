<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$data = json_decode(file_get_contents('php://input'), true);

$memberID = $data['MemberID'];
$status = $data['Status'];
$hasMedia = $data['HasMedia'];
$media = $data['Media'];
$source = $data['Source'];
$lat = $data['Latitude'];
$long = $data['Longitude'];
$mediaName = "";

$time = $data['Time'];
$time = date('Y-m-d H:i', $time);
$time = date('Y-m-d H:i',(strtotime ( '-5 hour' , strtotime ( $time) ) )); 

if ($hasMedia == 'true' || $hasMedia == 1 || $hasMedia == '1' || $hasMedia == true) {
    // save media to file server
    $mediaName = uniqid().'img.png';
    file_put_contents('../api/flicks/'.$mediaName, base64_decode($media));   
}
else {
    $media = "";
    $source = "";
}

$sql = "INSERT INTO Statuses (Member_ID,    Status,   Media,       Source,    Latitude,   Longitude, StatusDate)
                    Values ('$memberID',  '$status', '$mediaName','$source', '$lat',     '$long',    '$time')";
if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}