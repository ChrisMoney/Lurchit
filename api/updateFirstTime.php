<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];

require 'connect.php';

$id = $_GET['ID'];
$phone = $_GET['Phone'];

$sql = "Update Members Set IsFirstTime = '0' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {

    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}