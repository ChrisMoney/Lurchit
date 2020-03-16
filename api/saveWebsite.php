<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];

require 'connect.php';

$id = $_GET['ID'];
$website = $_GET['Website'];

$sql = "Update Members Set Website = '$website' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {

    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}