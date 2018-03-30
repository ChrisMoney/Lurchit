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
//$type = $data['FlickType'];


// save media to file server
if (isset($flick) && !empty($flick)) {
    file_put_contents('../api/messages/'.$flickName, base64_decode($flick));
}



// determine if this is the first message between users for receiver
$sql3 = "SELECT ID FROM Messages WHERE (Sender_ID = $senderID Or Receiver_ID = $senderID) 
And (Sender_ID = $receiverID Or Receiver_ID = $receiverID) And (Owner_ID = $receiverID) ";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3) > 0) {
    $receiverFirstMessage = 0;
}
else {
    $receiverFirstMessage = 1;
}

// determine if this is the first message between users for sender
$sql4 = "SELECT ID FROM Messages WHERE (Sender_ID = $senderID Or Receiver_ID = $senderID) 
And (Sender_ID = $receiverID Or Receiver_ID = $receiverID) And (Owner_ID = $senderID) ";
$result4 = mysqli_query($conn, $sql4);

if (mysqli_num_rows($result4) > 0) {
    $senderFirstMessage = 0;
}
else {
    $senderFirstMessage = 1;
}


// assign thread ownership for receiver
$sql = "INSERT INTO Messages (Sender_ID, Receiver_ID,     Owner_ID,      Pitch, Flick,        New, FirstMessage, MessageDate) 
                    Values ('$senderID', '$receiverID', '$receiverID', '$pitch', '$flickName', '1', '$receiverFirstMessage', NOW()) ";

if (mysqli_query($conn, $sql)) {
    // assign thread ownership for sender
    $sql1 = "INSERT INTO Messages (Sender_ID, Receiver_ID, Owner_ID, Pitch, Flick, New, FirstMessage, MessageDate) 
Values ('$senderID', '$receiverID', '$senderID', '$pitch', '$flickName', '0', '$senderFirstMessage', NOW()) ";

if (mysqli_query($conn, $sql1)) {
        // send push notification
       try { 
           $sql2 = "Select Username FROM Members WHERE ID = $senderID ";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $name = $row['Username'];
            
            $appId = "fa4f6cac-2cac-423f-8274-7e502725aaf8";
            $content = "Message from $name";
            $tag = $receiverID;
            $key = "ID";
            $title = "New Message";
            pushNotification($appId, $content, $key, $tag, $title);
    }
    catch(Execption $e) {
        $error = $e->getMessage();
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
