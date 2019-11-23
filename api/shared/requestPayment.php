<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../email.php';

$id = $_GET['ID'];


$sql = "Update Carwash Set PayStatus = 'processing' WHERE Lurch_ID = $id ";

if (mysqli_query($conn, $sql)) {
    
    // send email to admin
    if (sendRequestPaymentEmail('hr@lurchit.com', $id, $env)) {
        echo http_response_code(200);
    }
    else {
        echo http_response_code(500);
    }
}
else {
    echo http_response_code(500);
}
