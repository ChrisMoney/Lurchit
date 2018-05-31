<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
mysqli_set_charset($conn, "utf8mb4");
include_once 'helpers.php';


$id = $_GET['ID'];
$otherID = $_GET['OtherID'];

$sql = "SELECT msg.ID as MessageID, p.MediaName as MediaName, msg.New as New, msg.Sender_ID as SenderID, 
msg.Other_ID as OtherID, msg.Pitch as Pitch, msg.Flick as Flick, msg.MessageDate,
(Select Username FROM Members WHERE ID = msg.Sender_ID) as Username, msg.IsFlickPitch as IsFlickPitch,
msg.OrigPitch as OrigPitch

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
                if ($message['IsFlickPitch'] == 0) {
                    $message['Flick'] = 'http://api.flickpitch.com/api/messages/'.$flickName;
                }
            }
            
           
           // call function to replace all unicode values
            $message['Pitch'] = json_encode($message['Pitch']); 
            $message['Pitch'] = str_replace( '\ud83d\ude0d' , '&#128525;' , $message['Pitch']);

            
            // format flickpitch age text from date
            $date = date('D M d g:i a', strtotime( $message['MessageDate'] ));
            $message['MessageDate'] = $date;

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