<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select Distance FROM MemberPref WHERE Member_ID = $id ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $distance = $row['Distance'];
    $distance = trim($distance);
    echo $distance;
}
else {
    echo http_response_code(500);
}