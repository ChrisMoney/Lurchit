<?php
header("Content-Type: application/json;charset=utf-8");
require '../connect.php';

$jobID = $_GET['JobID'];


a:

$sql = "SELECT Status
FROM Carwash
WHERE ID = $jobID ";


$result = mysqli_query($conn, $sql);
$lurch = mysqli_fetch_assoc($result);
$status = $lurch['Status'];


        
        if ($status == 'accepted') {
            goto a;
        }  
        else {
            echo ' arrived';
        }