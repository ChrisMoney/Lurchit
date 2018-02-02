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
$mediation = $_GET['Mediation'];
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


$sql = "Insert Into Interests (Member_ID, Art, Beauty, BoardGames, Books, Business, Cooking, Dancing, Fashion, Outdoors, HomeRepair, Hiking, LiveEvents, MartialArts,Meditation, Movies, Music, NightLife, Performing, Photography, Sports, Technology, Traveling, VideoGames, WorkingOut, Writing, Yoga) Values
                              ($id,'$art', '$beauty', '$boardGames', '$books', '$business', '$cooking', '$dancing', '$fashion', '$outdoors', '$homeRepair', '$hiking', '$liveEvents','$martialArts', '$mediation', '$movies', '$music', '$nightLife', '$performing', '$photography','$sports', '$technology', '$traveling', '$videoGames', '$workingOut', '$writing', '$yoga')";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}