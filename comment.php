<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$statusID = $_GET['StatusID'];
$memberID = $_GET['MemberID'];
$comment = $_GET['Comment'];

$time = $_GET['Time'];
$time = date('Y-m-d H:i', $time);
$time = date('Y-m-d H:i',(strtotime ( '-5 hour' , strtotime ( $time) ) )); 

$sql = "INSERT INTO Comments (Status_ID, Member_ID, Comment, CommentDate) 
        Values ('$statusID', '$memberID', '$comment', '$time')";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
