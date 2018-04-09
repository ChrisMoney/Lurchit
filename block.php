<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$blockerID = $_GET['ID'];
$blockedID = $_GET['MemberID'];

$sql = "INSERT INTO Block (Blocker_ID, Blocked_ID) Values ('$blockerID', $blockedID') ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}