<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
include_once '../helpers.php';


$jobID = $_GET['JobID'];

$memberSql = "SELECT Customer_ID FROM Massage WHERE ID = $jobID ";
$memberResult = mysqli_query($conn, $memberSql);
$memberRow = mysqli_fetch_assoc($memberResult);

$customerID = $memberRow['Customer_ID'];

$sql = "SELECT CarPhoto, ProfilePhoto FROM Members WHERE ID = $customerID ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$profilePhoto = $row['ProfilePhoto'];

if (strlen($profilePhoto) > 1) {
$row['ProfilePhoto'] = ProfileMediaPath.$profilePhoto;
}

$carPhoto = $row['CarPhoto'];
if (strlen($carPhoto) > 0) {
    $row['CarPhoto'] = CarMediaPath.$carPhoto;
}


echo json_encode($row);