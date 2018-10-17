<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$statusID = $_GET['StatusID'];
$id = $_GET['ID'];
$posterID = $_GET['Poster_ID'];

$sql = "INSERT INTO HiddenStatuses (Status_ID, Reporter_ID, Poster_ID, HiddenDate) Values ('$statusID', '$id', '$posterID', NOW()) ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}