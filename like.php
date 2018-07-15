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
}

echo 200;

