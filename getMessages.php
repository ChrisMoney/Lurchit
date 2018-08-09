<?php

header("Content-Type: application/json;charset=utf-8");

require 'connect.php';
mysqli_set_charset($conn, "utf8mb4");
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT p.MediaName as MediaName, 
(SELECT New FROM Messages WHERE Owner_ID = $id And Other_ID = msg.Other_ID Order By New DESC Limit 1) As New,
 msg.Other_ID as OtherID,
(SELECT MessageDate FROM Messages WHERE Owner_ID = $id And Other_ID = msg.Other_ID
Order By ID DESC Limit 1) as MessageDate,
(Select Username FROM Members WHERE ID = msg.Other_ID) as Username

FROM Members m, ProfileMedia p, Messages msg 
WHERE (m.ID = msg.Other_ID) And (p.Member_ID = msg.Other_ID) And (msg.Owner_ID = $id) 
And (msg.FirstMessage = 1) 
And
(
msg.Other_ID NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id)
)
And
(
$id NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = msg.Other_ID)
)
And 
(
msg.Other_ID NOT in (Select ID FROM Members WHERE IsDeactivated = 'true')
)
Group By msg.Other_ID Order By New DESC, MessageDate DESC";

$myArray = array();

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($message = mysqli_fetch_assoc($result)) {
            $mediaName = $message['MediaName'];
            $message['MediaName'] = ProfileMediaPath.$mediaName;
            
            // format flickpitch age text from date
            $messageDate = $message['MessageDate'];
            // format date for comparison month/day
            $date = strtotime($messageDate);
            $message['MessageDate'] = calculate_time_span($date);
            
            $message['New'] = filter_var($message['New'], FILTER_VALIDATE_BOOLEAN);
            
            if ($message['OtherID'] == $id) {
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