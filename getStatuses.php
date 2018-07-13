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
s.ID as StatusID, s.Media as Media, s.Status as Status, s.StatusDate as StatusDate,
(SELECT Count(ID) FROM Comments WHERE Status_ID = s.ID) As CommentCount,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( s.Latitude ) ) *
cos( radians( s.Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( s.Latitude ) ) ) ) AS `distance`
FROM Members m, ProfileMedia p, Statuses s

WHERE 
p.Member_ID = m.ID 
And s.Member_ID = m.ID 

And (
(CASE WHEN (SELECT GenderFollow = 'Both' FROM Members WHERE ID = $id) THEN m.Gender = 'Male' Or m.Gender = 'Female' END)
Or m.Gender = (SELECT GenderFollow FROM Members WHERE ID = $id)
)


And
(
(SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) >= (SELECT CAST(AgeMinFollow AS UNSIGNED) FROM Members WHERE ID = $id) 
And (SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) <= (SELECT CAST(AgeMaxFollow AS UNSIGNED) FROM Members WHERE ID = $id)
)

And (
m.Ethnicity = (SELECT WhiteFollow FROM Members WHERE ID = $id)
Or m.Ethnicity = (SELECT BlackFollow FROM Members WHERE ID = $id)
Or m.Ethnicity = (SELECT HispanicFollow FROM Members WHERE ID = $id)
Or m.Ethnicity = (SELECT NativeAmericanFollow FROM Members WHERE ID = $id)
Or m.Ethnicity = (SELECT MiddleEasternFollow FROM Members WHERE ID = $id)
Or m.Ethnicity = (SELECT AsianFollow FROM Members WHERE ID = $id)
Or m.Ethnicity = (SELECT PacificIslanderFollow FROM Members WHERE ID = $id)
)

And (
(CASE WHEN m.GenderFollower = 'Both' THEN '' END)
Or m.GenderFollower = (SELECT Gender FROM Members WHERE ID = $id)
)

And
(
(SELECT TIMESTAMPDIFF(YEAR, (SELECT CAST(Birthdate As UNSIGNED) FROM Members WHERE ID = $id), CURDATE())) >= CAST(m.AgeMinFollower AS UNSIGNED) 
And (SELECT TIMESTAMPDIFF(YEAR, (SELECT CAST(Birthdate As UNSIGNED) FROM Members WHERE ID = $id), CURDATE())) <= CAST(m.AgeMaxFollower AS UNSIGNED)
)

And (
m.WhiteFollower = (Select Ethnicity FROM Members WHERE ID = $id)
Or m.BlackFollower = (SELECT Ethnicity FROM Members WHERE ID = $id)
Or m.HispanicFollower = (SELECT Ethnicity FROM Members WHERE ID = $id)
Or m.NativeAmericanFollower = (SELECT Ethnicity FROM Members WHERE ID = $id)
Or m.MiddleEasternFollower = (SELECT Ethnicity FROM Members WHERE ID = $id)
Or m.AsianFollower = (SELECT Ethnicity FROM Members WHERE ID = $id)
Or m.PacificIslanderFollower = (SELECT Ethnicity FROM Members WHERE ID = $id)
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
s.ID as StatusID, s.Media as Media, s.Status as Status, s.StatusDate as StatusDate,
(SELECT Count(ID) FROM Comments WHERE Status_ID = s.ID) As CommentCount,
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
            
            $status['StatusDate'] = calculate_time_span($date);
            
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