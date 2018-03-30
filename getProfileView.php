<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$profileID = $_GET['MemberID'];
$visitorID = $_GET['VisitorID'];

$sql = "SELECT m.Username as Username, CONCAT(m.HeightFeet, '-', m.HeightInches) as Height,
m.Gender as Gender, m.Build as Build, m.About as About, pm.MediaName As MediaName,
(SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) as Age, m.Ethnicity As Ethnicity,

CASE WHEN mp.NoRacePref = 'true' THEN 'No Ethnic Preference' ELSE '' END As NoRacePref,
CASE WHEN mp.White = 'true' THEN 'White' ELSE '' END As White,
CASE WHEN mp.Black = 'true' THEN 'Black' ELSE '' END As Black,
CASE WHEN mp.Hispanic = 'true' THEN 'Hispanic' ELSE '' END As Hispanic,
CASE WHEN mp.MiddleEastern = 'true' THEN 'Middle Eastern' ELSE '' END As MiddleEastern,
CASE WHEN mp.Indian = 'true' THEN 'Indian' ELSE '' END As Indian,
CASE WHEN mp.NativeAmerican = 'true' THEN 'Native American' ELSE '' END As NativeAmerican,
CASE WHEN mp.Asian = 'true' THEN 'Asian' ELSE '' END As Asian,

CASE WHEN m.Dating = 'true' THEN 'Dating' ELSE '' END As Dating,
CASE WHEN m.Friends = 'true' THEN 'Friends' ELSE '' END As Friends,
CASE WHEN m.Networking = 'true' THEN 'Networking' ELSE '' END As Networking,

CASE WHEN m.Art = 'true' THEN (SELECT Art FROM Members WHERE ID = $visitorID And Art = 'true') ELSE '' END As Art,
CASE WHEN m.Beauty = 'true' THEN (SELECT Beauty FROM Members WHERE ID = $visitorID And Beauty = 'true') ELSE '' END As Beauty,
CASE WHEN m.BoardGames = 'true' THEN (SELECT BoardGames FROM Members WHERE ID = $visitorID And BoardGames = 'true') ELSE '' END As BoardGames,
CASE WHEN m.Books = 'true' THEN (SELECT Books FROM Members WHERE ID = $visitorID And Books = 'true') ELSE '' END as Books,
CASE WHEN m.Business = 'true' THEN (SELECT Business FROM Members WHERE ID = $visitorID AND Business = 'true') ELSE '' END As Business,
CASE WHEN m.Cooking = 'true' THEN (SELECT Cooking FROM Members WHERE ID = $visitorID AND Cooking = 'true') ELSE '' END As Cooking,
CASE WHEN m.Dancing = 'true' THEN (SELECT Dancing FROM Members WHERE ID = $visitorID AND Dancing = 'true') ELSE '' END As Dancing,
CASE WHEN m.Fashion = 'true' THEN (SELECT Fashion FROM Members WHERE ID = $visitorID AND Fashion = 'true') ELSE '' END As Fashion,
CASE WHEN m.Outdoors = 'true' THEN (SELECT Outdoors FROM Members WHERE ID = $visitorID AND Outdoors = 'true') ELSE '' END AS Outdoors,
CASE WHEN m.HomeRepair = 'true' THEN (SELECT HomeRepair FROM Members WHERE ID = $visitorID AND HomeRepair = 'true') ELSE '' END As HomeRepair,
CASE WHEN m.Hiking = 'true' THEN (SELECT Hiking FROM Members WHERE ID = $visitorID AND Hiking = 'true') ELSE '' END As Hiking,
CASE WHEN m.LiveEvents = 'true' THEN (SELECT LiveEvents FROM Members WHERE ID = $visitorID AND LiveEvents = 'true') ELSE '' END As LiveEvents,
CASE WHEN m.MartialArts = 'true' THEN (SELECT MartialArts FROM Members WHERE ID = $visitorID AND MartialArts = 'true') ELSE '' END As MartialArts,
CASE WHEN m.Meditation = 'true' THEN (SELECT Meditation FROM Members WHERE ID = $visitorID AND Meditation = 'true') ELSE '' END As Meditation,
CASE WHEN m.Movies = 'true' THEN (SELECT Movies FROM Members WHERE ID = $visitorID AND Movies = 'true') ELSE '' END As Movies,
CASE WHEN m.Music = 'true' THEN (SELECT Music FROM Members WHERE ID = $visitorID AND Music = 'true') ELSE '' END As Music,
CASE WHEN m.NightLife = 'true' THEN (SELECT NightLife FROM Members WHERE ID = $visitorID AND NightLife = 'true') ELSE '' END As NightLife,
CASE WHEN m.Performing = 'true' THEN (SELECT Performing FROM Members WHERE ID = $visitorID AND Performing = 'true') ELSE '' END As Performing,
CASE WHEN m.Photography = 'true' THEN (SELECT Photography FROM Members WHERE ID = $visitorID AND Photography = 'true') ELSE '' END Photography,
CASE WHEN m.Sports = 'true' THEN (SELECT Sports FROM Members WHERE ID = $visitorID AND Sports = 'true') ELSE '' END As Sports,
CASE WHEN m.Technology = 'true' THEN (SELECT Technology FROM Members WHERE ID = $visitorID AND Technology = 'true') ELSE '' END As Technology,
CASE WHEN m.Traveling = 'true' THEN (SELECT Traveling FROM Members WHERE ID = $visitorID AND Traveling = 'true') ELSE '' END As Traveling,
CASE WHEN m.VideoGames = 'true' THEN (SELECT VideoGames FROM Members WHERE ID = $visitorID AND VideoGames = 'true') ELSE '' END As VideoGames,
CASE WHEN m.WorkingOut = 'true' THEN (SELECT WorkingOut FROM Members WHERE ID = $visitorID AND WorkingOut = 'true') ELSE '' END As WorkingOut,
CASE WHEN m.Writing = 'true' THEN (SELECT Writing FROM Members WHERE ID = $visitorID AND Writing = 'true') ELSE '' END As Writing,
CASE WHEN m.Yoga = 'true' THEN (SELECT Yoga FROM Members WHERE ID = $visitorID AND Yoga = 'true') ELSE '' END As Yoga

FROM Members m, MemberPref mp, ProfileMedia pm

WHERE m.ID = $profileID
And mp.Member_ID = $profileID
And pm.Member_ID = $profileID
";


if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $profileView = mysqli_fetch_assoc($result);
        // format profile photo
        $mediaName = $profileView['MediaName'];
        $profileView['MediaName'] = "http://api.flickpitch.com/media/$mediaName";

    echo json_encode($profileView);
        }
else {
    echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}