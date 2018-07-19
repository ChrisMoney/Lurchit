<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$allowLikes = $_GET['AllowLikes'];
$allowComments = $_GET['AllowComments'];
$allowDMs = $_GET['AllowDMs'];


$sql = "Update Members Set AllowLikes = '$allowLikes', AllowComments = '$allowComments', 
                        AllowDMs = '$allowDMs'
    WHERE ID = $id";

if (mysqli_query($conn, $sql)) {
    return http_response_code(200);
}
else {
    // error saving data
    return http_response_code(500);
}
