<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';


$addressID = $_GET['AddressID'];
$id = $_GET['ID'];

$sqlClearPrimay = "Update CustomerAddress Set IsPrimary = 0 WHERE Member_ID = $id ";

if (mysqli_query($conn, $sqlClearPrimay)) {
    
    $sql = "Update CustomerAddress Set IsPrimary = 1 WHERE ID = $addressID ";
    
    if (mysqli_query($conn, $sql)) {
        echo http_response_code(200);
    }
    else {
        echo http_response_code(500);
    }
}