<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

date_default_timezone_set("UTC");

$searchTerm = $_GET['SearchTerm'];
$searchTerm = trim($searchTerm);
$id = $_GET['ID'];
$long = $_GET['Long'];
$lat = $_GET['Lat'];
$distance = getDistance($id);
$filterQuery = checkFilter($id);

$sql = "SELECT DISTINCT p.MediaName as ProfilePic, m.ID as MemberID, m.Username as Username,
m.AllowComments as AllowComments, m.AllowLikes as AllowLikes, m.AllowDMs as AllowDMs,
s.ID as StatusID, s.Media as Media, s.Status as Status, s.StatusDate as StatusDate,
s.Start as Start, s.End as End,
(SELECT Count(ID) FROM Comments WHERE Status_ID = s.ID) As CommentCount,
(SELECT Count(ID) FROM Likes WHERE Status_ID = StatusID) As LikeCount,
(SELECT Count(ID) FROM Likes WHERE (Member_ID = $id And Status_ID = StatusID)) As HasLiked,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( s.Latitude ) ) *
cos( radians( s.Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( s.Latitude ) ) ) ) AS distance
FROM Members m, ProfileMedia p, Statuses s
WHERE
(Status Like '%$searchTerm%')
And (p.Member_ID = m.ID) 

And

NOT EXISTS (SELECT Status_ID FROM HiddenStatuses WHERE Reporter_ID = $id and Status_ID = s.ID)

And p.Member_ID = m.ID 
And s.Member_ID = m.ID 


And (
((CASE m.Gender WHEN 'Male' THEN 'true' END) = (Select GenderFollowMale FROM Members WHERE ID = $id))
Or ((CASE m.Gender WHEN 'Female' THEN 'true' END) = (Select GenderFollowFemale FROM Members WHERE ID = $id))
)


And
(
(SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) >= (SELECT CAST(AgeMinFollow AS UNSIGNED) FROM Members WHERE ID = $id) 
And (SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) <= (SELECT CAST(AgeMaxFollow AS UNSIGNED) FROM Members WHERE ID = $id)
)


And (
((CASE m.Ethnicity WHEN 'White' THEN 'true' ELSE 'false' END) = (SELECT WhiteFollow FROM Members WHERE ID = $id))
Or ((CASE m.Ethnicity WHEN 'Black' THEN 'true' ELSE 'false' END) = (SELECT BlackFollow FROM Members WHERE ID = $id))
Or ((CASE m.Ethnicity WHEN 'Hispanic' THEN 'true' ELSE 'false' END) = (SELECT HispanicFollow FROM Members WHERE ID = $id))
Or ((CASE m.Ethnicity WHEN 'Native American' THEN 'true' ELSE 'false' END) = (SELECT NativeAmericanFollow FROM Members WHERE ID = $id))
Or ((CASE m.Ethnicity WHEN 'Middle Eastern' THEN 'true' ELSE 'false' END) = (SELECT MiddleEasternFollow FROM Members WHERE ID = $id))
Or ((CASE m.Ethnicity WHEN 'Asian' THEN 'true' ELSE 'false' END) = (SELECT AsianFollow FROM Members WHERE ID = $id))
Or ((CASE m.Ethnicity WHEN 'Pacific Islander' THEN 'true' ELSE 'false' END) = (SELECT PacificIslanderFollow FROM Members WHERE ID = $id))
)


And
(
(SELECT TIMESTAMPDIFF(YEAR, (SELECT CAST(Birthdate As UNSIGNED) FROM Members WHERE ID = $id), CURDATE())) >= CAST(m.AgeMinFollower AS UNSIGNED) 
And (SELECT TIMESTAMPDIFF(YEAR, (SELECT CAST(Birthdate As UNSIGNED) FROM Members WHERE ID = $id), CURDATE())) <= CAST(m.AgeMaxFollower AS UNSIGNED)
)

And (
((CASE m.GenderFollowerMale WHEN 'true' THEN 'Male' END) = (Select Gender FROM Members WHERE ID = $id))
Or ((CASE m.GenderFollowerFemale WHEN 'true' THEN 'Female' END) = (Select Gender FROM Members WHERE ID = $id))
)

And (
((CASE m.WhiteFollower WHEN 'true' THEN 'White' ELSE '' END) = (Select Ethnicity FROM Members WHERE ID = $id))
Or ((CASE m.BlackFollower WHEN 'true' THEN 'Black' ELSE '' END) = (Select Ethnicity FROM Members WHERE ID = $id))
Or ((CASE m.HispanicFollower WHEN 'true' THEN 'Hispanic' ELSE '' END) = (Select Ethnicity FROM Members WHERE ID = $id))
Or ((CASE m.NativeAmericanFollower WHEN 'true' THEN 'Native American' ELSE '' END) = (Select Ethnicity FROM Members WHERE ID = $id))
Or ((CASE m.MiddleEasternFollower WHEN 'true' THEN 'Middle Eastern' ELSE '' END) = (Select Ethnicity FROM Members WHERE ID = $id))
Or ((CASE m.AsianFollower WHEN 'true' THEN 'Asian' ELSE '' END) = (Select Ethnicity FROM Members WHERE ID = $id))
Or ((CASE m.PacificIslanderFollower WHEN 'true' THEN 'PacificIslander' ELSE '' END) = (Select Ethnicity FROM Members WHERE ID = $id))
)

And
(
m.ID NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id)
)
And
(
$id NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = m.ID)
)
And 
(
m.ID NOT in (Select ID FROM Members WHERE IsDeactivated = 'true')
)
".
$filterQuery
."

Group By StatusID 
HAVING distance <= $distance
Order By StatusID DESC, distance ASC ";

$result = mysqli_query($conn, $sql);
$myArray = array();


if (mysqli_num_rows($result) == 0) {
    echo http_response_code(500);
    exit();
}

if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
        while ($status = mysqli_fetch_assoc($result)) {
            
            
            // build profile image url
            $profilePic = $status['ProfilePic'];
            $status['ProfilePic'] = ProfileMediaPath.$profilePic;
            
            // build image url
            $flick = $status['Media'];
            if (strlen($flick) > 1) {
                $status['Media'] = StatusMediaPath.$flick;
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

