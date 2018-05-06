<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT TIMESTAMPDIFF(YEAR, Birthdate, CURDATE()) as Age FROM Members WHERE ID = $id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $age = $row['Age'];
    echo $age;
}
else {
    echo json_encode(http_response_code(500));
}