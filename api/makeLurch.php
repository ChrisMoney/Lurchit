<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require 'connect.php';
require 'email.php';

$id = $_GET['ID'];


$sql = "Update Members Set IsLurch = 1, IsLurchActive = 1 WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {

$sqlDemo = "SELECT Username FROM Members WHERE ID = $id ";
$result = mysqli_query($conn, $sqlDemo);
$row = mysqli_fetch_assoc($result);
$username = $row['Username'];

providerAppSignupEmail($username);

echo http_response_code(200);
}
else {
    echo http_response_code(500);
}