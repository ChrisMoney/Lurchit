<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$address = $_GET['Address'];
$id = $_GET['ID'];

if (!preg_match('/\d+ [0-9a-zA-Z ]+/', $address)) {
    echo http_response_code(400);
    exit;
} else {

    $sqlUpdatePrimary = "Update CustomerAddress Set IsPrimary = 0 WHERE IsPrimary = 1 AND Member_ID = $id ";
    
    
    if (mysqli_query($conn, $sqlUpdatePrimary)) {

        $sql = "INSERT INTO CustomerAddress (Member_ID, Address, IsPrimary) Values ('$id','$address', '1' ) ";
        
        if (mysqli_query($conn, $sql)) {
            echo http_response_code(200);
        } 
    } 
}


