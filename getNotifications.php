<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT ID, Member_ID, Sender_ID, Owner_ID, Type, Type_ID, Message, New,
(SELECT MediaName FROM ProfileMedia WHERE Member_ID = Sender_ID) as MediaName
 FROM Notifications 
WHERE Member_ID = $id 
And
(
Member_ID NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id)
)
And
(
Sender_ID NOT IN (SELECT Blocker_ID FROM Block WHERE Blocked_ID = $id)
)
Order By New DESC, ID DESC ";

$sql2 = "Update Notifications Set New = 0 WHERE Member_ID = (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id) ";
mysqli_query($conn, $sql2);

$sql3 = "Update Notifications Set New = 0 WHERE Sender_ID = (SELECT Blocker_ID FROM Block WHERE Blocked_ID = $id) ";
mysqli_query($conn, $sql3);

$myArray = array();

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($notifications = mysqli_fetch_assoc($result)) {
            
            $mediaName = $notifications['MediaName'];
            $notifications['MediaName'] = ProfileMediaPath.$mediaName;
            
            $notifications['New'] = filter_var($notifications['New'], FILTER_VALIDATE_BOOLEAN);
            
            $myArray[] = $notifications;
        }
        echo json_encode($myArray, JSON_NUMERIC_CHECK);
    }
    else { echo http_response_code(400); }
    
}