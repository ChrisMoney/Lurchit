<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$isLurch = $_GET['IsLurchActive'];

$sql = "Update Members Set IsLurchActive = $isLurch WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
