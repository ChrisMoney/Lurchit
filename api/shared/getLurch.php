<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$lurchID = $_GET['LurchID'];
$jobID = $_GET['JobID'];

$sql = "SELECT ID, Username, ProfilePhoto, Phone, (SELECT Distance FROM Carwash WHERE ID = $jobID) as Distance,
(SELECT ETA FROM Carwash WHERE ID = $jobID) as ETA, 
(SELECT Customer_ID FROM Carwash WHERE ID = $jobID) as CustomerID
FROM Members
WHERE ID = $lurchID ";


    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
    
        $lurch = mysqli_fetch_assoc($result);
        
        $profileMedia = $lurch['ProfilePhoto'];
        $mediaUrl = ProfileMediaPath.$profileMedia;
        $lurch['ProfilePhoto'] = $mediaUrl;
        $distance = $lurch['Distance'];
        $customerId = $lurch['CustomerID'];
        $distance = ceil($distance);
        
        $eta = calculateETA($customerId, $distance, $env);
        
        $lurch['ETA'] = $eta;
        
        echo json_encode($lurch);
    }

