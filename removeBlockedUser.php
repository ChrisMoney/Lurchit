<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$blockedID = $_GET['BlockedID'];
$blockerID = $_GET['BlockerID'];

$sql = "DELETE FROM Block 
WHERE Blocked_ID = $blockedID 
And Blocker_ID = $blockerID ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    echo http_response_code(200);
}
else {
    echo http_response_code(400);
}