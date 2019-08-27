<?php


header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$jobID = $_GET['JobID'];

$sql = "SELECT Status, Lurch_ID, ETA
FROM Carwash
WHERE ID = $jobID ";


$result = mysqli_query($conn, $sql);
$lurch = mysqli_fetch_assoc($result);
$status = ' '.$lurch['Status'];
$lurchID = $lurch['Lurch_ID'];
$eta = $lurch['ETA'];

$username = getUsername($lurchID, $env);
$status = array("Username"=>$username, "Status"=>$status);
echo json_encode($status);
        