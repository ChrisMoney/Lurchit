<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];
$otherID = $_GET['OtherID'];

$sql = "SELECT msg.ID as MessageID, p.MediaName as MediaName, msg.Media as MessageMedia, msg.New as New, msg.Sender_ID as SenderID,
msg.Other_ID as OtherID, msg.Message as Message, msg.MessageDate,
(Select Username FROM Members WHERE ID = msg.Sender_ID) as Username
FROM Members m, ProfileMedia p, Messages msg
WHERE
(msg.Owner_ID = $id)
And (msg.Other_ID = $otherID)
And (m.ID = msg.Sender_ID)
And (p.Member_ID = msg.Sender_ID)

And ($otherID NOT in (Select Blocked_ID FROM Block WHERE Blocker_ID = $id))
And ($otherID NOT in (Select ID FROM Members WHERE IsDeactivated = 'true'))
Order By MessageID DESC ";

$myArray = array();

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($message = mysqli_fetch_assoc($result)) {
            
            $mediaName = $message['MediaName'];
            $message['MediaName'] = ProfileMediaPath.$mediaName;
            
            $messageMedia = $message['MessageMedia'];
            if (strlen($messageMedia) > 1) {
                $message['MessageMedia'] = MessageMediaPath.$messageMedia;
            }
            
            
            // format flickpitch age text from date
            $messageDate = $message['MessageDate'];
            $date = strtotime($messageDate);
            $message['MessageDate'] = calculate_time_span($date);
            
            if ($message['SenderID'] == $id) {
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