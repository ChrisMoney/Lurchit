<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/1/18
 * Time: 6:22 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$art = $_GET['Art'];
$beauty = $_GET['Beauty'];
$boardGames = $_GET['BoardGames'];
$books = $_GET['Books'];
$business = $_GET['Business'];
$cooking = $_GET['Cooking'];
$dancing = $_GET['Dancing'];
$fashion = $_GET['Fashion'];
$hiking = $_GET['Hiking'];
$outdoors = $_GET['Outdoors'];
$homeRepair = $_GET['HomeRepair'];
$liveEvents = $_GET['LiveEvents'];
$martialArts = $_GET['MartialArts'];
$meditation = $_GET['Meditation'];
$movies = $_GET['Movies'];
$music = $_GET['Music'];
$nightLife = $_GET['NightLife'];
$performing = $_GET['Performing'];
$photography = $_GET['Photography'];
$sports = $_GET['Sports'];
$technology = $_GET['Technology'];
$traveling = $_GET['Traveling'];
$videoGames = $_GET['VideoGames'];
$workingOut = $_GET['WorkingOut'];
$writing = $_GET['Writing'];
$yoga = $_GET['Yoga'];


$sql = "Update Members Set Art = '$art', Beauty = '$beauty', BoardGames = '$boardGames', Books = '$books', Business = '$business', Cooking = '$cooking', Dancing = '$dancing', Fashion = '$fashion',Outdoors = '$outdoors', HomeRepair = '$homeRepair', Hiking = '$hiking', LiveEvents = '$liveEvents', MartialArts = '$martialArts', Meditation = '$meditation', Movies = '$movies', Music = '$music', NightLife = '$nightLife', Performing = '$performing', Photography = '$photography', Sports = '$sports', Technology = '$technology', Traveling = '$traveling', VideoGames = '$videoGames', WorkingOut = '$workingOut', Writing = '$writing', Yoga = '$yoga' WHERE ID = $id ";


if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}