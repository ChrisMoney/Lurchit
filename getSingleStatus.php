<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';
date_default_timezone_set("UTC");

$id = $_GET['ID'];
$statusID = $_GET['StatusID'];

$sql = "SELECT p.MediaName as ProfilePic, m.ID as MemberID, m.Username as Username,
m.AllowComments as AllowComments, m.AllowLikes as AllowLikes, m.AllowDMs as AllowDMs,
s.ID as StatusID, s.Media as Media, s.Status as Status, s.StatusDate as StatusDate,
(SELECT Count(ID) FROM Comments WHERE Status_ID = s.ID) As CommentCount,
(SELECT Count(ID) FROM Likes WHERE Status_ID = s.ID) As LikeCount,
(SELECT Count(ID) FROM Likes WHERE (Member_ID = MemberID And Status_ID = StatusID)) As HasLiked

    FROM Members m, ProfileMedia p, Statuses s
    
    WHERE
    m.ID = $id
    And p.Member_ID = $id
    And s.Member_ID = $id
    And s.ID = $statusID
    Group By StatusID
    Order By StatusID DESC
    
    ";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
        while ($status = mysqli_fetch_assoc($result)) {
            
            
            // build profile image url
            $profilePic = $status['ProfilePic'];
            $status['ProfilePic'] = 'http://api.flickpitch.com/api/media/'.$profilePic;
            
            // build image url
            $flick = $status['Media'];
            if (strlen($flick) > 1) {
                $status['Media'] = 'http://api.flickpitch.com/api/flicks/'.$flick;
            }
            
            
            // format flickpitch age text from date
            $statusPostDate = $status['StatusDate'];
            
            // format date for comparison month/day
            $date = strtotime($statusPostDate);
            
            $status['StatusDate'] = calculate_time_span($date);
            
            $status['AllowComments'] = filter_var($status['AllowComments'], FILTER_VALIDATE_BOOLEAN);
            $status['AllowLikes'] = filter_var($status['AllowLikes'], FILTER_VALIDATE_BOOLEAN);
            $status['AllowDMs'] = filter_var($status['AllowDMs'], FILTER_VALIDATE_BOOLEAN);
            
            $myArray[] = $status;
        }
        echo json_encode($myArray, JSON_NUMERIC_CHECK);
    }
    else {
        echo http_response_code(500);
    }
}
else {
    echo http_response_code(500);
}