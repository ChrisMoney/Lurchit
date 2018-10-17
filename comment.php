<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$data = json_decode(file_get_contents('php://input'), true);
$statusID = $data['StatusID'];
$memberID = $data['MemberID'];
$comment = $data['Comment'];
$media = $data['Media'];
$hasMedia = $data['HasMedia'];
$source = $data['Source'];
$time = $data['Time'];
$time = date('Y-m-d H:i', $time);
$time = date('Y-m-d H:i',(strtotime ( '-5 hour' , strtotime ( $time) ) )); 

$year = date('Y', $time);
$currentYear = date('Y');

if ($year != $currentYear) {
    $year = $currentYear;
    $time = date('Y-m-d H:i:s');
}

$mediaName = "";

if (($hasMedia == 'true' || $hasMedia == 1 || $hasMedia == '1' || $hasMedia == true)) {
    // save media to file server
    $mediaName = uniqid().'img.png';
    file_put_contents('../api/comments/'.$mediaName, base64_decode($media));   
}
else {
    $media = "";
    $source = "";
    $mediaName = "";
}

if (strlen($comment) == 0 && strlen($mediaName) == 0) {
    echo http_response_code(401);
    exit();
}

if (strlen($comment) > 250) {
    echo http_response_code(400);
    exit();
}

$sql = "INSERT INTO Comments (Status_ID,   Member_ID,   Comment,    Media,        Source,   CommentDate) 
        Values              ('$statusID', '$memberID', '$comment', '$mediaName', '$source', '$time')";

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
    
    if ($memberID == $userID) {} else {
    notification($memberID, $receiverID, 'Comment', $statusID, $message);
    pushNotification($message, $receiverID);
    }
    
    
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
