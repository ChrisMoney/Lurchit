<?php

header("Content-Type: application/json;charset=iso-8859-1");
require 'connect.php';
include_once 'helpers.php';
include_once 'Emoji.php';

$id = $_GET['ID'];
$otherID = $_GET['OtherID'];

mysqli_query("SET character_set_client=utf8mb4", $conn);

$sql = "SELECT msg.ID as MessageID, p.MediaName as MediaName, msg.New as New, msg.Sender_ID as SenderID, msg.Other_ID as OtherID, msg.Pitch as Pitch, msg.Flick as Flick,
msg.MessageDate,
(Select Username FROM Members WHERE ID = msg.Sender_ID) as Username

FROM Members m, ProfileMedia p, Messages msg 
WHERE 
(m.ID = msg.Sender_ID) 
And (p.Member_ID = msg.Sender_ID) 
And (Owner_ID = $id) 
And (msg.Receiver_ID = $otherID Or msg.Sender_ID = $otherID)
And (msg.MessageDate > NOW() - INTERVAL 1 DAY)
And ($otherID NOT in (Select Blocked_ID FROM Block WHERE Blocker_ID = $id))
Order By MessageID DESC ";

$myArray = array();

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($message = mysqli_fetch_assoc($result)) {
            $mediaName = $message['MediaName'];
            $message['MediaName'] = 'http://api.flickpitch.com/api/media/'.$mediaName;
            
            $flickName = $message['Flick'];
            if (strlen($flickName) > 1) {
                $message['Flick'] = 'http://api.flickpitch.com/api/messages/'.$flickName;
            }
            
            
            // format flickpitch age text from date
            $date = date('D M d', strtotime( $message['MessageDate'] ));
            $message['MessageDate'] = $date;
            
            $message['Pitch'] = Emoji::Encode($message['Pitch']);

            $message['Pitch'] = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $message['Pitch']);
            
            if ($message['Sender_ID'] == $id) {
                $message['Username'] = 'Me';
            }
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