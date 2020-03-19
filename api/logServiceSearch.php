<?php
$env = $_GET['ENV'];
require 'connect.php';

$service = $_GET['Service'];

$sql = "INSERT INTO LogServiceSearch (Service, Date) Values ('$service', NOW()) ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}