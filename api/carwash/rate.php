<?php

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';

$id = $_GET['JobID'];

$rating = $_GET['Rating'];

$sql = "Update Carwash Set Rating = '$rating' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
