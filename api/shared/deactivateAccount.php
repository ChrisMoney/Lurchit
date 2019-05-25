<?php

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];

$sql = "Update Members Set IsDeactivated = 'true' WHERE ID = '$id' ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}