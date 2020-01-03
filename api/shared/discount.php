<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$ID = $_GET['ID'];
$discount = $_GET['Discount'];
$service = $_GET['Service'];

$sql = "INSERT INTO Discounts (Customer_ID, Discount, Service, DiscountDate ) Values ($ID, $discount, '$service', NOW() )";

if (mysqli_query($conn, $sql)) {
    // update successful
    echo http_response_code(200);
} else {
    // internal error
    echo http_response_code(500);
}