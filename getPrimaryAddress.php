<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Address FROM CustomerAddress WHERE Member_ID = $id And IsPrimary = 1 ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    $address = $row['Address'];
    
    echo $address;
}
else {
    echo json_encode(http_response_code(500));
}