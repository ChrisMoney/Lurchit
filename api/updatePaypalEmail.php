<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$paypalEmail = $_GET['PaypalEmail'];

$sql = "Update Members Set PaypalEmail = '$paypalEmail' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
