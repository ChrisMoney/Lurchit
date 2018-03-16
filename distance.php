<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$distance = $_GET['Distance'];

 $sql = "Update MemberPref Set Distance = '$distance'
    WHERE ID = $id";

    if (mysqli_query($conn, $sql)) {
        return http_response_code(200);
    }
    else {
        // error saving data
        return http_response_code(500);
    }