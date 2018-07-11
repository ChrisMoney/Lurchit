<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';
date_default_timezone_set("UTC");

$id = $_GET['ID'];
$curtime = $_GET['Time'];


$sql = "SELECT pm.MediaName as MediaName, m.ID as MemberID, m.Username as Username,
(SELECT PitchDate FROM PitchDeck WHERE Member_ID = m.ID Order By ID DESC Limit 1) as PitchDate,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( pd.Latitude ) ) *
cos( radians( pd.Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( pd.Latitude ) ) ) ) AS `distance`

FROM Members m, ProfileMedia pm, MemberPref mp, PitchDeck pd

WHERE
mp.Member_ID = $id
And pm.Member_ID = $id
And pd.Member_ID = $id";



if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
    while ($pitchDeck = mysqli_fetch_assoc($result)) {
        
        // format profile photo
        $mediaName = $pitchDeck['MediaName'];
        $pitchDeck['MediaName'] = "http://api.flickpitch.com/api/media/$mediaName";
        $flickPitchDate = $pitchDeck['PitchDate'];
        
        $curtime = date('Y-m-d H:i', $curtime);
        $curtime = date('Y-m-d H:i',(strtotime ( '-5 hour' , strtotime ( $curtime) ) ));
        $pitchDeck['PitchDate'] = calculate_time_span($flickPitchDate, $curtime);

        $pitchDeck;
        }
        
    echo json_encode($pitchDeck, JSON_NUMERIC_CHECK);
    
}
else {
    echo http_response_code(400);
}
}
else {
    echo http_response_code(500);
}