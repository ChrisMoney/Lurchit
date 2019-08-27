<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
$customerID = $_GET['CustomerID'];
$service = $_GET['Service'];

require '../connect.php';

$error = "";

$sql = "INSERT INTO Requests (Customer_ID, Service, RequestDate) Values ('$customerID', '$service', NOW()) ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    $error = mysqli_errno($conn);
    $sql = "INSERT INTO LogError (Log, Date) Values ('$error', NOW()) ";
    mysqli_query($conn, $sql);
}