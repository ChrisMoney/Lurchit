<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/11/18
 * Time: 4:33 PM
 */
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';
date_default_timezone_set("UTC");

$id = $_GET['ID'];
$long = $_GET['Long'];
$lat = $_GET['Lat'];
$curtime = $_GET['Time'];

$distance = getDistance($id);

$sql = "SELECT pm.MediaName as MediaName, m.ID as MemberID, m.Username as Username, 
(SELECT PitchDate FROM PitchDeck WHERE Member_ID = m.ID Order By ID DESC Limit 1) as PitchDate,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( pd.Latitude ) ) * 
cos( radians( pd.Longitude ) - radians($long) ) + sin ( radians($lat) ) * 
sin( radians( pd.Latitude ) ) ) ) AS `distance` 

FROM Members m, ProfileMedia pm, MemberPref mp, PitchDeck pd

WHERE 
mp.Member_ID = $id
And pm.Member_ID = m.ID
And (pd.Member_ID = m.ID Or pd.Member_ID = $id)

And
(
((SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) >= mp.AgeMin And (SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) <= mp.AgeMax)
)
  

And
(
(CASE WHEN mp.NoRacePref = 'true' THEN m.Ethnicity = 'White' Or m.Ethnicity = 'Black'
Or m.Ethnicity = 'Hispanic' Or m.Ethnicity = 'Middle Eastern' Or m.Ethnicity = 'Indian'
Or m.Ethnicity = 'Pacific Islander' Or m.Ethnicity = 'Asian' Or m.Ethnicity = 'Native American' Or m.Ethnicity = 'Other' END)
Or (mp.White = (CASE m.Ethnicity WHEN 'White' THEN 'true' END))
Or (mp.Black = (CASE m.Ethnicity WHEN 'Black' THEN 'true' END))
Or (mp.Hispanic = (CASE m.Ethnicity WHEN 'Hispanic' THEN 'true' END))
Or (mp.MiddleEastern = (CASE m.Ethnicity WHEN 'Middle Eastern' THEN 'true' END))
Or (mp.Indian = (CASE m.Ethnicity WHEN 'Indian' THEN 'true' END))
Or (mp.NativeAmerican = (CASE m.Ethnicity WHEN 'Native American' THEN 'true' END))
Or (mp.Asian = (CASE m.Ethnicity WHEN 'Asian' THEN 'true' END))
Or (mp.PacificIslander = (CASE m.Ethnicity WHEN 'Pacific Islander' THEN 'true' END))
Or (mp.RaceOther = (CASE m.Ethnicity WHEN 'Other' THEN 'true' END))
)

And 
(
(CASE WHEN mp.NoGenderPref = 'true' THEN m.Gender = 'Male' Or m.Gender = 'Female' END)
Or (mp.Male = (CASE m.Gender WHEN 'male' THEN 'true' END))
Or (mp.Female = (CASE m.Gender WHEN 'female' THEN 'true' END))
)

And
(
m.ID NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id)
)
And
(
$id NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = m.ID)
)
Group By MemberID
HAVING distance <= $distance

";

$myArray = array();

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

           
            
            $myArray[] = $pitchDeck;
            }
    echo json_encode($myArray, JSON_NUMERIC_CHECK);
    
}
else {
    echo http_response_code(400);
}
}
else {
    echo http_response_code(500);
}