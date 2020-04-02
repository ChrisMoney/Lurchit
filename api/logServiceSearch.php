<?php
$env = $_GET['ENV'];
require 'connect.php';

$service = $_GET['Service'];
$device = $_GET['DEVICE'];

$sql = "INSERT INTO LogServiceSearch (Service,Device, Date) Values ('$service','$device', NOW()) ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}