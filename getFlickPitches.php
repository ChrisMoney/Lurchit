<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT m.ID as MemberID, m.Username as Username, pd.ID as FlickPitchID, pd.Flick as Flick, pd.Pitch as Pitch,
pd.PitchDate as PitchDate, p.MediaName as ProfilePic, pd.Source as Source,
m.Gender
FROM Members m, PitchDeck pd, ProfileMedia p
WHERE m.ID = $id and p.Member_ID = $id And pd.Member_ID = $id
Order By pd.ID DESC";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($flickPitch = mysqli_fetch_assoc($result)) {
            
            // build profile image url
            $profilePic = $flickPitch['ProfilePic'];
            $flickPitch['ProfilePic'] = 'http://api.flickpitch.com/api/media/'.$profilePic;
            
            // build flick image url
            $flick = $flickPitch['Flick'];
            $flickPitch['Flick'] = 'http://api.flickpitch.com/api/flicks/'.$flick;
            
            // format flickpitch age text from date
            $flickPostDate = $flickPitch['PitchDate'];
            
            // format flickpitch date for comparison month/day
            $date = strtotime($flickPostDate);
            $dbDate = date('F j', $date);
            
            // format flickpitch date for display
            $displayDate = date('g:i a', $date);
            
            // format flickpitch date for comparison month/day
            $today = strtotime('now');
            $todayDate = date('F j', $today);
            
            if ($todayDate == $dbDate) {
                $timePosted = 'Today';
            }
            else {
                $timePosted = 'Yesterday';
            }
            
            //$time = date("g:i a",$flickPitchDate);
            $flickPitch['PitchDate'] = $timePosted . ' '. $displayDate;
            
            $myArray[] = $flickPitch;
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
