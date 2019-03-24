<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$sqlLurch = "SELECT ID FROM Members WHERE IsLurchActive = 1 And IsDeactivated = 0 ";
$lurchResult = mysqli_query($conn, $sqlLurch);
$lurchCount = mysqli_num_rows($lurchResult);

$sqlJobs = "SELECT ID FROM Carwash WHERE Status <> 'complete' ";
$jobResult = mysqli_query($conn, $sqlJobs);
$jobCount = mysqli_num_rows($jobResult);

if ($lurchCount > $jobCount) {
    echo json_encode(true);
}
else {
    echo json_encode(false);
}

