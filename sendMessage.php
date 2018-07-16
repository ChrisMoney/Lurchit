<?php

header("Content-Type: application/json;charset=utf-8");

require 'connect.php';
mysqli_set_charset($conn, "utf8mb4");
require 'helpers.php';


$data = json_decode(file_get_contents('php://input'), true);

$senderID = $data['SenderID'];
$receiverID = $data['ReceiverID'];
$message = $data['Message'];

$time = $data['Time'];
$time = date('Y-m-d H:i', $time);
$time = date('Y-m-d H:i',(strtotime ( '-5 hour' , strtotime ( $time) ) )); 

// if message is from message page
/*if ($isFlickPitch == 0 || $isFlickPitch == '0') {

    $flickName = uniqid().'img.png';
}
else {
    // if message is from a Flickpitch
    $flickName = $flick;
}*/


//$mediaAdded = $data['MediaAdded'];
//$type = $data['FlickType'];


// save media to file server
/*if ($isFlickPitch == 0) {
if ($mediaAdded == true || $mediaAdded == 'true' || $mediaAdded == 1) {
   if (isset($flick) && !empty($flick)) {
    file_put_contents('../api/messages/'.$flickName, base64_decode($flick));
} 
}
else {
    $flick = "";
    $flickName = "";
}
}*/

if (strlen($message) > 250) {
    echo http_response_code(400);
    exit;
}
if (strlen($message) == 0 || strlen($message) == '') {
    echo http_response_code(401);
    exit;
}



// determine if this is the first message between users for receiver
$sql3 = "SELECT ID FROM Messages WHERE Owner_ID = $receiverID And Other_ID = $senderID And FirstMessage = 1 ";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3) > 0) {
    $receiverFirstMessage = 0;
}
else {
    $receiverFirstMessage = 1;
}

// determine if this is the first message between users for sender
$sql4 = "SELECT ID FROM Messages WHERE Owner_ID = $senderID And Other_ID = $receiverID And FirstMessage = 1  ";
$result4 = mysqli_query($conn, $sql4);

if (mysqli_num_rows($result4) > 0) {
    $senderFirstMessage = 0;
}
else {
    $senderFirstMessage = 1;
}


// assign thread ownership for receiver
$sql = "INSERT INTO Messages (Sender_ID, Receiver_ID,     Owner_ID,     Other_ID,     Message,     New,  FirstMessage,           MessageDate) 
                    Values ('$senderID', '$receiverID', '$receiverID', '$senderID', '$message',  '1',   '$receiverFirstMessage', '$time') ";

if (mysqli_query($conn, $sql)) {
    // assign thread ownership for sender
    $sql1 = "INSERT INTO Messages (Sender_ID,   Receiver_ID,   Owner_ID,    Other_ID,      Message,   New,  FirstMessage,          MessageDate) 
                           Values ('$senderID', '$receiverID', '$senderID', '$receiverID', '$message',  '0', '$senderFirstMessage', '$time') ";


if (mysqli_query($conn, $sql1)) {
        // send push notification
       try { 
           $sql2 = "Select Username FROM Members WHERE ID = $senderID ";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $name = $row['Username'];
            
            $message = "Message from $name";
            $userID = $receiverID;
            pushNotification($message, $userID);
    }
    catch(Exception $e) {
        $error = 'Push Notification Failed';
        $sqlLog = "INSERT INTO Log (Log, Date) Values ('$error', NOW())";
        mysqli_query($conn, $sqlLog);
    } 
    finally {
        echo http_response_code(200);
    }
}
else {
    echo http_response_code(500);
    }
}
else {
    echo http_response_code(500);
}
