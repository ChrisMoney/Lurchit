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
            $flickPitch['ProfilePic'] = 'http://api.flickpitch.com/media/'.$profilePic;
            
            // build flick image url
            $flick = $flickPitch['Flick'];
            $flickPitch['Flick'] = 'http://api.flickpitch.com/flicks/'.$flick;
            
            // format flickpitch age text from date
            $flickPostDate = $flickPitch['PitchDate'];
            $timeSinceLastPost = calculate_time_span($flickPostDate);
            $flickPitch['PitchDate'] = $timeSinceLastPost;
            
            //$count = mysqli_num_rows($result);
            
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
