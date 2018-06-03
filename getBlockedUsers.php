<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT m.ID as BlockedID, pm.MediaName as MediaName, m.Username as Username
FROM Members m, ProfileMedia pm
WHERE 
pm.Member_ID = m.ID
And m.ID IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id) ";


if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $blockedUsers = mysqli_fetch_assoc($result);
        $mediaName = $blockedUsers['MediaName'];
        $blockedUsers['MediaName'] = "http://api.flickpitch.com/api/media/$mediaName";
        echo json_encode($blockedUsers, JSON_NUMERIC_CHECK);
    }
    else {
        echo json_encode(http_response_code(500));
    }
    
}
else {
    echo json_encode(500);
}