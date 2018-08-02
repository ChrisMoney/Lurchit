<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$statusID = $_GET['StatusID'];
$id = $_GET['ID'];

$sql = "INSERT INTO HiddenStatuses (Status_ID, Member_ID, HiddenDate) Values ('$statusID', '$id', NOW()) ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}