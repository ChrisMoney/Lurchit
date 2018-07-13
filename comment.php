<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$statusID = $_GET['StatusID'];
$memberID = $_GET['MemberID'];
$comment = $_GET['Comment'];

$sql = "INSERT INTO Comments (Status_ID, Member_ID, Comment, CommentDate) 
        Values ('$statusID', '$memberID', '$comment', NOW())";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
