<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT p.MediaName as MediaName, msg.New as New, msg.Other_ID as OtherID,
(SELECT MessageDate FROM Messages WHERE Owner_ID = $id And Other_ID = msg.Other_ID
Order By ID DESC Limit 1) as MessageDate,
(Select Username FROM Members WHERE ID = msg.Other_ID) as Username

FROM Members m, ProfileMedia p, Messages msg 
WHERE (m.ID = msg.Other_ID) And (p.Member_ID = msg.Other_ID) And (msg.Owner_ID = $id) 
And (msg.FirstMessage = 1) 
Group By msg.Owner_ID ";

$myArray = array();

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($message = mysqli_fetch_assoc($result)) {
            $mediaName = $message['MediaName'];
            $message['MediaName'] = 'http://api.flickpitch.com/media/'.$mediaName;
            
            // format flickpitch age text from date
            $messagePostDate = $message['MessageDate'];
            $timeSinceLastMessage = calculate_time_span($messagePostDate);
            $message['MessageDate'] = $timeSinceLastPost;
            
            $myArray[] = $message;
        }
        echo json_encode($myArray, JSON_NUMERIC_CHECK);

    }
    else {
        echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}