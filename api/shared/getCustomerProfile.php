<?php

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
include_once '../helpers.php';


$jobID = $_GET['JobID'];

$memberSql = "SELECT Customer_ID FROM Carwash WHERE ID = $jobID ";
$memberResult = mysqli_query($conn, $memberSql);
$memberRow = mysqli_fetch_assoc($memberResult);

$customerID = $memberRow['Customer_ID'];

$sql = "SELECT CarPhoto, ProfilePhoto FROM Members WHERE ID = $customerID ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$profilePhoto = $row['ProfilePhoto'];
$row['ProfilePhoto'] = ProfileMediaPath.$profilePhoto;

$carPhoto = $row['CarPhoto'];
$row['CarPhoto'] = CarMediaPath.$carPhoto;

echo json_encode($row);