<?php


header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';

$jobID = $_GET['JobID'];


$sql = "SELECT Status
FROM Carwash
WHERE ID = $jobID ";


$result = mysqli_query($conn, $sql);
$lurch = mysqli_fetch_assoc($result);
$status = $lurch['Status'];


echo $status;
