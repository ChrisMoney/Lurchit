<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT p.MediaName as MediaName, msg.New as New,
(SELECT MessageDate FROM Messages WHERE msg.Sender_ID = $id Or msg.Receiver_ID = $id and Owner_ID = $id
Order By ID DESC) as MessageDate,
(Select Username FROM Members WHERE ID = msg.Receiver_ID != $id Or msg.Sender_ID != $id) as Username,
CASE WHEN msg.Receiver_ID = 1 THEN msg.Sender_ID ELSE msg.Sender_ID End as OtherID
FROM Members m, ProfileMedia p, Messages msg 
WHERE (m.ID = $id) And (p.Member_ID = $id) And (msg.Owner_ID = $id) 
And (msg.FirstMessage = 1) ";

if (mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
    while ($messages = mysqli_fetch_assoc($result)) {
        
        // format profile photo
        $mediaName = $messages['MediaName'];
        $messages['MediaName'] = "http://api.flickpitch.com/media/$mediaName";
        
       // format flickpitch age text from date
            $messagesDate = $messages['MessageDate'];
            $timeSinceLastMessage = calculate_time_span($messageDate);
            $messages['MessageDate'] = $timeSinceLastMessage;
            $messages['New'] = filter_var($messages['New'], FILTER_VALIDATE_BOOLEAN);
            $myArray[] = $messages;
            }
    echo json_encode($myArray, JSON_NUMERIC_CHECK);
        }

    else if ($count == 0) {
    echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}