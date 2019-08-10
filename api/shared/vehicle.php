<?php

//header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';

$id = $_GET['ID'];
$make = $_GET['Make'];
$model = $_GET['Model']; 
$year = $_GET['Year'];


$sql = "Update Members Set Make = '$make', Model = '$model', Year = '$year'
WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
