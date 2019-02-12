<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$sql = "SELECT IsLurch FROM Members WHERE ID = $id";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    $status = mysqli_fetch_assoc($result);
    
    $lurchStatus = filter_var($status['IsLurch'], FILTER_VALIDATE_BOOLEAN);
    
    echo json_encode($lurchStatus);
}
else {
    echo json_encode(http_response_code(500));
}

