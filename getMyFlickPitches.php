<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT m.ID as MemberID, m.Username as Username, pd.Flick as Flick, pd.Pitch as Pitch,
pd.PitchDate as PitchDate, p.MediaName as ProfilePic 
FROM Members m, PitchDeck pd, ProfileMedia p
WHERE m.ID = $id and p.Member_ID = $id And pd.Member_ID = $id
Order By pd.ID DESC";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) >= 0) {
        while ($flickPitch = mysqli_fetch_assoc($result)) {

            $flickPostDate = $flickPitch['PitchDate'];
            $timeSinceLastPost = calculate_time_span($flickPostDate);
            $flickPitch['PitchDate'] = $timeSinceLastPost;
            
            $myArray[] = $flickPitch;
        }
        echo json_encode($myArray);

    }
    else {
        echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}

function calculate_time_span($date){
        $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($date);

        $months = floor($seconds / (3600*24*30));
        $day = floor($seconds / (3600*24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours*3600)) / 60);
        $secs = floor($seconds % 60);


        $time = $hours." hours ago";
       

        return $time;
}