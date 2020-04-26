<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];

require 'connect.php';

$id = $_GET['ID'];
$blurb = $_GET['Blurb'];

$blurb = mysqli_real_escape_string($conn, $blurb);

$sql = "Update Members Set Blurb = '$blurb' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {

    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}