<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];


$sql = "Update Carwash Set PayStatus = 'processing' WHERE Lurch_ID = $id ";

if (mysqli_query($conn, $sql)) {
    
    // send email to admin
    
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
