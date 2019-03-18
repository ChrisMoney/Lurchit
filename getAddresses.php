<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select DISTINCT ID, Address, IsPrimary
From CustomerAddress
WHERE Member_ID = $id
Group By ID ";

$result = mysqli_query($conn, $sql);
$myArray = array();


if (mysqli_num_rows($result) > 0) {
    
    while ($address = mysqli_fetch_assoc($result)) {
        
        $myArray[] = $address;
    }
    echo json_encode($myArray, JSON_NUMERIC_CHECK);
}
else {
    echo http_response_code(500);
}




