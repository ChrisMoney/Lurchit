<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

date_default_timezone_set("UTC");
$id = $_GET['ID'];
$long = $_GET['Long'];
$lat = $_GET['Lat'];
$curtime = $_GET['Time'];

$distance = getDistance($id);

$sql = "SELECT p.MediaName as ProfilePic, m.ID as MemberID, m.Username as Username,
s.Media as Media, s.Status as Status, s.StatusDate as StatusDate,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( s.Latitude ) ) *
cos( radians( s.Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( s.Latitude ) ) ) ) AS `distance`
FROM Members m, ProfileMedia p, Statuses s

WHERE 

p.Member_ID = m.ID 
And s.Member_ID = m.ID 

And
(
((SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) >= m.AgeMinFollow 
And (SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) <= m.AgeMaxFollow)
)

And (
m.Ethnicity = (SELECT Ethnicity FROM Members WHERE Ethnicity = 'White' And ID = $id)
Or m.Ethnicity = (SELECT Ethnicity FROM Members WHERE Ethnicity = 'Black' And ID = $id)
Or m.Ethnicity = (SELECT Ethnicity FROM Members WHERE Ethnicity = 'Hispanic' And ID = $id)
Or m.Ethnicity = (SELECT Ethnicity FROM Members WHERE Ethnicity = 'Indian' And ID = $id)
Or m.Ethnicity = (SELECT Ethnicity FROM Members WHERE Ethnicity = 'Middle Eastern' And ID = $id)
Or m.Ethnicity = (SELECT Ethnicity FROM Members WHERE Ethnicity = 'Native American' And ID = $id)
Or m.Ethnicity = (SELECT Ethnicity FROM Members WHERE Ethnicity = 'Asian' And ID = $id)
Or m.Ethnicity = (SELECT Ethnicity FROM Members WHERE Ethnicity = 'Pacific Islander' And ID = $id)
)

And
(
m.ID NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id)
)
And
(
$id NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = m.ID)
)

UNION ALL

SELECT p.MediaName as ProfilePic, m.ID as MemberID, m.Username as Username,
s.Media as Media, s.Status as Status, s.StatusDate as StatusDate,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( s.Latitude ) ) *
cos( radians( s.Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( s.Latitude ) ) ) ) AS `distance`
FROM Members m, ProfileMedia p, Statuses s

WHERE 
m.ID = $id
And p.Member_ID = $id
And s.Member_ID = $id

Group By MemberID 
HAVING distance <= $distance
Order By StatusDate

";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_query($conn, $sql)) {
    echo "test";
    if (mysqli_num_rows($result) > 0) {
        while ($status = mysqli_fetch_assoc($result)) {
            
            // build profile image url
            $profilePic = $status['ProfilePic'];
            $status['ProfilePic'] = 'http://api.flickpitch.com/api/media/'.$profilePic;
            
            // build image url
            $flick = $status['Media'];
            $status['Media'] = 'http://api.flickpitch.com/api/flicks/'.$flick;
            
            // format flickpitch age text from date
            $statusPostDate = $status['StatusDate'];
            
            // format date for comparison month/day
            $date = strtotime($statusPostDate);
            
            // format date for display
            $displayDate = date('D g:i a', $date);
            
            //$time = date("g:i a",$flickPitchDate);
            $status['StatusDate'] = $timePosted . ' '. $displayDate;
            
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