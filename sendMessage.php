<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$data = json_decode(file_get_contents('php://input'), true);

$senderID = $data['SenderID'];
$receiverID = $data['ReceiverID'];
$pitch = $data['Pitch'];
$flick = $data['Flick'];
$flickName = uniqid().'img.png';
$type = $data['FlickType'];

// save media to file server
file_put_contents('../api/messages/'.$mediaName, base64_decode($flick));

// determine if this is the first message between users for receiver
$sql3 = "SELECT ID FROM Messages WHERE (SenderID = $senderID Or ReceiverID = $sender) 
And (SenderID = $receiverID Or ReceiverID = $receiverID) And (OwnerID = $receiverID) ";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3) > 0) {
    $receiverFirstMessage = 0;
}
else {
    $receiverFirstMessage = 1;
}

// determine if this is the first message between users for sender
$sql4 = "SELECT ID FROM Messages WHERE (SenderID = $senderID Or ReceiverID = $sender) 
And (SenderID = $receiverID Or ReceiverID = $receiverID) And (OwnerID = $senderID) ";
$result4 = mysqli_query($conn, $sql4);

if (mysqli_num_rows($result4) > 0) {
    $senderFirstMessage = 0;
}
else {
    $senderFirstMessage = 1;
}



// assign thread ownership for receiver
$sql = "INSERT INTO Messages (SenderID, ReceiverID, OwnerID, Pitch, Flick, New, FirstMessage, MessageDate) 
Values ('$senderID', '$receiverID', '$receiverID', '$pitch', '$flickName', '1', '$receiverFirstMessage', NOW()) ";

if (mysqli_query($conn, $sql)) {
    // assign thread ownership for sender
    $sql1 = "INSERT INTO Messages (SenderID, ReceiverID, OwnerID, Pitch, Flick, New, FirstMessage, MessageDate) 
Values ('$senderID', '$receiverID', '$senderID', '$pitch', '$flickName', '1', '$senderFirstMessage', NOW()) ";

if (mysqli_query($conn, $sql1)) {
    $sql2 = "Select Username FROM Members WHERE ID = $senderID ";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysql_fetch_assoc($result2);
    $name = $row['Username'];
    
    $content = "Message from $name";
    $appId = "fa4f6cac-2cac-423f-8274-7e502725aaf8";
    $tag = $receiverID;
    sendMessage($appId, $content, $tag, "message");
    echo http_response_code(200);
    }
else {
    echo http_response_code(500);
    }
}
else {
    echo http_response_code(500);
}
