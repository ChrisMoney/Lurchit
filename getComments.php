<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

date_default_timezone_set("UTC");
$statusID = $_GET['StatusID'];
$id = $_GET['ID'];

$filterQuery = checkCommentFilter($id);

$sql = "SELECT p.MediaName as ProfilePic, m.ID as MemberID, m.Username as Username,
c.ID as CommentID, c.Member_ID as CommentorID, c.Status_ID as StatusID, c.Comment as Comment, c.Media as Media,
 c.CommentDate as CommentDate
FROM Members m, ProfileMedia p, Comments c
WHERE
c.Status_ID = $statusID
And p.Member_ID = m.ID
And c.Member_ID = m.ID 

And
(
m.ID NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id)
)
And
(
$id NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = m.ID)
)
".
$filterQuery
."
Order By c.ID DESC ";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
        while ($comment = mysqli_fetch_assoc($result)) {
            
            // build profile image url
            $profilePic = $comment['ProfilePic'];
            $comment['ProfilePic'] = ProfileMediaPath.$profilePic;
            
            // build image url
            $media = $comment['Media'];
            if (strlen($media) > 1) {
            $comment['Media'] = CommentMediaPath.$media;
            }
            
            // format flickpitch age text from date
            $commentPostDate = $comment['CommentDate'];
            
            // format date for comparison month/day
            $date = strtotime($commentPostDate);
            
            $comment['CommentDate'] = calculate_time_span($date);
            $myArray[] = $comment;
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