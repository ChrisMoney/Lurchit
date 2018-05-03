<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT m.ID as BlockedID, ml.MediaName as MediaName, m.Username as Username
FROM Members m, MediaLibrary ml
WHERE m.ID IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id) ";


if ($result = mysqli_query($conn, $sql)) {
    $blockedUsers = mysqli_fetch_assoc($result);
    $mediaName = $blockedUsers['MediaName'];
    $blockedUsers['MediaName'] = "http://api.flickpitch.com/media/$mediaName";
    echo json_encode($blockedUsers, JSON_NUMERIC_CHECK);
}
else {
    echo json_encode(500);
}