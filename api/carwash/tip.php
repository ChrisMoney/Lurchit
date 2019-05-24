<?php
header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';

$jobID = $_GET['JobID'];
$tip = $_GET['Tip'];
$lurchID = $_GET['LurchID'];

$sql = "UPDATE Carwash Set Tip = '$tip' WHERE ID = $jobID ";

if (mysqli_query($conn, $sql)) {
    
    $sql2 = "INSERT INTO Tips (Job_ID, Lurch_ID, Job, Tip) Values ('$jobID', '$lurchID', 'Carwash', '$tip') ";
    
    if (mysqli_query($conn, $sql2)) {
        echo http_response_code(200);
    }
    else {
        echo http_response_code(500);
    }
}