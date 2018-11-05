<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';
include_once 'email.php';

$data = json_decode(file_get_contents('php://input'), true);
$statusID = $data['StatusID'];
$memberID = $data['MemberID'];
$comment = $data['Comment'];
$media = $data['Media'];
$hasMedia = $data['HasMedia'];
$source = $data['Source'];
$device = $data['Device'];
$time = $data['Time'];

$time = date('Y-m-d H:i', $time);
$time = date('Y-m-d H:i',(strtotime ( '-5 hour' , strtotime ( $time) ) )); 

$year = date('Y', $time);
$currentYear = date('Y');

if ($year != $currentYear) {
    $year = $currentYear;
    $time = date('Y-m-d H:i:s');
}

$mediaName = "";

if (($hasMedia == 'true' || $hasMedia == 1 || $hasMedia == '1' || $hasMedia == true)) {
    // save media to file server
    $mediaName = uniqid().'img.png';
    file_put_contents('../api/comments/'.$mediaName, base64_decode($media));   
}
else {
    $media = "";
    $source = "";
    $mediaName = "";
}

if (strlen($comment) == 0 && strlen($mediaName) == 0) {
    echo http_response_code(401);
    exit();
}

if (strlen($comment) > 250) {
    echo http_response_code(400);
    exit();
}

if (strlen($comment) > 0) {
    $comment = mysqli_real_escape_string($conn, $comment);
}


// get Username of person commenting on status
$sqlStatusOwner = "Select Member_ID FROM Statuses WHERE ID = $statusID ";
$resultStatusOwner = mysqli_query($conn, $sqlStatusOwner);
$rowStatusOwner = mysqli_fetch_assoc($resultStatusOwner);
$statusOwnerID = $rowStatusOwner['Member_ID'];

$sql = "INSERT INTO Comments (Status_ID,   Member_ID,  Status_Owner_ID,   Comment,    Media,        Source,   CommentDate) 
        Values              ('$statusID', '$memberID', '$statusOwnerID', '$comment', '$mediaName', '$source', '$time')";

if (mysqli_query($conn, $sql)) {
    
    
    // get Username of person commenting on status
    $sql2 = "Select Username FROM Members WHERE ID = $memberID ";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result2);
    $name = $row['Username'];
    
    // get ID of user receiving the notification
    $sql3 = "SELECT Member_ID FROM Statuses WHERE ID = $statusID ";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $receiverID = $row3['Member_ID'];
    
    $message = "Status Comment from $name";
    $userID = $receiverID;
    

        
        //Get the ids of all the consumers connected with a bulletin comment
        $sqlCommentor = "SELECT Member_ID FROM Comments WHERE Status_ID = $statusID And Member_ID != $memberID And Status_ID = $statusID ";
        
        $resultCommentor = mysqli_query($conn, $sqlCommentor);
        
        $comment_ids = array();
        
        //Iterate over the results and sort out the biz ids from the consumer ones.
        while ($rows = mysqli_fetch_assoc($resultCommentor)) {
            array_push($comment_ids, $rows['Member_ID']);
        }
        
        //Boil the id's down to unique values because we dont want to send double emails or notifications
        $comment_ids = array_unique($comment_ids);
        //Send consumer notifications
        
        foreach($comment_ids as $itemID) {
            
            if (checkActive($itemID)) {
                
            notification($memberID, $itemID, 'Comment', $statusID, $message);
            pushNotification($message, $itemID);
            
            $sql2 = "Select Username FROM Members WHERE ID = $memberID ";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $name = $row['Username'];
            
            $sql3 = "Select Email FROM Members WHERE ID = $itemID ";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($result3);
            $email = $row3['Email'];
            
            $sql4 = "Select MediaName FROM ProfileMedia WHERE Member_ID = $memberID ";
            $result4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($result4);
            $profilePhoto = $row4['MediaName'];
            $profilePic = ProfileMediaPath.$profilePhoto;
            
            $subject = "Click here to view the new comment by $name";
            $title = "$name commented on a status related to you";
            
            if (empty($device) || !isset($device)) { $device = ""; }
            
            sendNewMessageMail($email, $name, $profilePic, $device, $subject, $title);
            }
        } 
    
    
    
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
