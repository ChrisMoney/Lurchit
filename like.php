<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';


$statusID = $_GET['StatusID'];
$memberID = $_GET['MemberID'];

$sql = "SELECT ID FROM Likes WHERE Member_ID = $memberID AND Status_ID = $statusID ";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
    $sql1 = "DELETE FROM Likes WHERE Member_ID = $memberID AND Status_ID = $statusID ";
    mysqli_query($conn, $sql1);
}
else {
    $sql1 = "INSERT INTO Likes (Status_ID, Member_ID, LikeDate) Values ('$statusID', '$memberID', NOW()) ";
    mysqli_query($conn, $sql1);
    
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
    
    $message = "Status Like from $name";
    $userID = $receiverID;
    
    notification($memberID, $receiverID, 'Like', $statusID, $message);
}

echo 200;

