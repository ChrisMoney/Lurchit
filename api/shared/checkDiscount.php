<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$ID = $_GET['ID'];
$service = $_GET['Service'];

$sql = "SELECT Discount FROM Discounts WHERE ID = $ID ";
$result = mysqli_result($conn, $sql);
$row = mysqli_fetch_assoc($result);

$discount = $row['Discount'];

if (empty($discount) || is_null($discount)) {
    $discount = 0;
}

echo $discount;

