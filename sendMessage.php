<?php

header("Content-Type: application/json;charset=utf-8");

require 'connect.php';
mysqli_set_charset($conn, "utf8mb4");
require 'helpers.php';
include_once 'email.php';

$data = json_decode(file_get_contents('php://input'), true);

$senderID = $data['SenderID'];
$receiverID = $data['ReceiverID'];
$message = $data['Message'];
$device = $data['Device'];
$media = $data['Media'];
$source = $data['Source'];
$time = $data['Time'];
$hasMedia = $data['HasMedia'];

$mediaName = "";
$time = date('Y-m-d H:i', $time);
$time = date('Y-m-d H:i',(strtotime ( '-5 hour' , strtotime ( $time) ) )); 

$year = date('Y', $time);
$currentYear = date('Y');

if ($year != $currentYear) {
    $year = $currentYear;
    $time = date('Y-m-d H:i:s');
}

if (($hasMedia == 'true' || $hasMedia == 1 || $hasMedia == '1' || $hasMedia == true)
    && strlen($source) > 0) {
        // save media to file server
        $mediaName = uniqid().'img.png';
        file_put_contents('../api/messages/'.$mediaName, base64_decode($media));
    }
    else {
        $media = "";
        $source = "";
        $mediaName = "";
    }

if (strlen($message) > 250) {
    echo http_response_code(400);
    exit;
}
if (strlen($message) == 0 && strlen($mediaName) == 0) {
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

if (strlen($message) > 0) {
    $message = mysqli_real_escape_string($conn, $message);
}


// assign thread ownership for receiver
$sql = "INSERT INTO Messages (Sender_ID, Receiver_ID,     Owner_ID,     Other_ID,     Message,      Media,       Source,    New,    FirstMessage,           MessageDate) 
                    Values ('$senderID', '$receiverID', '$receiverID', '$senderID', '$message', '$mediaName', '$source',   '1',   '$receiverFirstMessage', '$time') ";

if (mysqli_query($conn, $sql)) {
    // assign thread ownership for sender
    if ($senderID != $receiverID) {
    $sql1 = "INSERT INTO Messages (Sender_ID,   Receiver_ID,   Owner_ID,    Other_ID,      Message,     Media,        Source,    New,  FirstMessage,          MessageDate) 
                           Values ('$senderID', '$receiverID', '$senderID', '$receiverID', '$message', '$mediaName', '$source',  '0', '$senderFirstMessage', '$time') ";


if (mysqli_query($conn, $sql1)) {
        // send push notification

           $sql2 = "Select Username FROM Members WHERE ID = $senderID ";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $name = $row['Username'];
            
            $sql3 = "Select Email FROM Members WHERE ID = $receiverID ";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($result3);
            $email = $row3['Email'];
            
            $sql4 = "Select MediaName FROM ProfileMedia WHERE Member_ID = $senderID ";
            $result4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($result4);
            $profilePhoto = $row4['MediaName'];
            $profilePic = ProfileMediaPath.$profilePhoto;
            

            $subject = "New Message";
            sendNewMessageMail($email, $name, $profilePic, $device);
            
            $message = "Message from $name";
            $userID = $receiverID;
            
            if ($device == 'iPhone') {
                pushNotification('Message', $message, $userID);
            }
            else {
                pushNotificationAndroid('Message', $message, $userID);
            }
            echo http_response_code(200);        
    }
        echo http_response_code(200);
    }
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
    }

