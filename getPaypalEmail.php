<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$sql = "SELECT PaypalEmail FROM Members WHERE ID = $id ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$paypalEmail = $row['PaypalEmail'];

echo $paypalEmail;