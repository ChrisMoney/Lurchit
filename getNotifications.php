<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT ID, Member_ID, Sender_ID, Type, Type_ID, Message, New,
(SELECT MediaName FROM ProfileMedia WHERE Member_ID = Sender_ID) as MediaName
 FROM Notifications WHERE Member_ID = $id Order By New DESC ";

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