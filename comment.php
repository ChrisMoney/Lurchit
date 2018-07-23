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
    
    $commentID = mysqli_insert_id($conn);
    
    // get Username of person commenting on status
    $sql2 = "Select Username FROM Members WHERE ID = $memberID ";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result2);
    $name = $row['Username'];
    
    // get ID of user receiving the notification
    $sql3 = "SELECT Member_ID FROM Statuses WHERE ID = $statusID ";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $receiverID = $row3['Member_ID'];
    
    $message = "Status Comment from $name";
    $userID = $receiverID;
    
    notification($memberID, $receiverID, 'Comment', $statusID, $message);
    pushNotification($message, $receiverID);
    
    
    
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
