<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$discountID = $_GET['DiscountID'];


$sql = "UPDATE Discounts SET HasUsed = 1 WHERE ID = $discountID ";

if (mysqli_query($conn, $sql)) {
    // update successful
    echo http_response_code(200);
} else {
    // internal error
    echo http_response_code(500);