<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];
$otherID = $_GET['OtherID'];

$sql = "SELECT msg.ID as MessageID, p.MediaName as MediaName, msg.New as New, msg.Sender_ID, msg.Other_ID, msg.Pitch as Pitch, msg.Flick as Flick,
msg.MessageDate,
(Select Username FROM Members WHERE ID = msg.Sender_ID) as Username

FROM Members m, ProfileMedia p, Messages msg 
WHERE 
(m.ID = msg.Sender_ID) 
And (p.Member_ID = msg.Sender_ID) 
And (Owner_ID = $id) 
And (msg.Receiver_ID = $otherID Or msg.Sender_ID = $otherID)
And (msg.MessageDate > NOW() - INTERVAL 1 DAY)

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