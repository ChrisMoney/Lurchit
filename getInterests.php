<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/6/18
 * Time: 9:19 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select Art, Beauty, BoardGames, Books, Business, Cooking, Dancing, Fashion,Outdoors, HomeRepair, Hiking, LiveEvents, MartialArts, Meditation, Movies, Music, NightLife, Performing, Photography , Sports, Technology, Traveling, VideoGames, WorkingOut, Writing, Yoga FROM Members WHERE ID = $id ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $interests = mysqli_fetch_assoc($result);

    $interests['Art'] = filter_var($interests['Art'], FILTER_VALIDATE_BOOLEAN);
    $interests['Beauty'] = filter_var($interests['Beauty'], FILTER_VALIDATE_BOOLEAN);
    $interests['BoardGames'] = filter_var($interests['BoardGames'], FILTER_VALIDATE_BOOLEAN);
    $interests['Business'] = filter_var($interests['Business'], FILTER_VALIDATE_BOOLEAN);
    $interests['Cooking'] = filter_var($interests['Cooking'], FILTER_VALIDATE_BOOLEAN);
    $interests['Dancing'] = filter_var($interests['Dancing'], FILTER_VALIDATE_BOOLEAN);
    $interests['Fashion'] = filter_var($interests['Fashion'], FILTER_VALIDATE_BOOLEAN);
    $interests['Outdoors'] = filter_var($interests['Outdoors'], FILTER_VALIDATE_BOOLEAN);
    $interests['HomeRepair'] = filter_var($interests['HomeRepair'], FILTER_VALIDATE_BOOLEAN);
    $interests['Hiking'] = filter_var($interests['Hiking'], FILTER_VALIDATE_BOOLEAN);
    $interests['LiveEvents'] = filter_var($interests['LiveEvents'], FILTER_VALIDATE_BOOLEAN);
    $interests['MartialArts'] = filter_var($interests['MartialArts'], FILTER_VALIDATE_BOOLEAN);
    $interests['Mediation'] = filter_var($interests['Mediation'], FILTER_VALIDATE_BOOLEAN);
    $interests['Movies'] = filter_var($interests['Movies'], FILTER_VALIDATE_BOOLEAN);
    $interests['Music'] = filter_var($interests['Music'], FILTER_VALIDATE_BOOLEAN);
    $interests['NightLife'] = filter_var($interests['NightLife'], FILTER_VALIDATE_BOOLEAN);
    $interests['Performing'] = filter_var($interests['Performing'], FILTER_VALIDATE_BOOLEAN);
    $interests['Photography'] = filter_var($interests['Photography'], FILTER_VALIDATE_BOOLEAN);
    $interests['Sports'] = filter_var($interests['Sports'], FILTER_VALIDATE_BOOLEAN);
    $interests['Technology'] = filter_var($interests['Technology'], FILTER_VALIDATE_BOOLEAN);
    $interests['Traveling'] = filter_var($interests['Traveling'], FILTER_VALIDATE_BOOLEAN);
    $interests['VideoGames'] = filter_var($interests['VideoGames'], FILTER_VALIDATE_BOOLEAN);
    $interests['WorkingOut'] = filter_var($interests['WorkingOut'], FILTER_VALIDATE_BOOLEAN);
    $interests['Writing'] = filter_var($interests['Writing'], FILTER_VALIDATE_BOOLEAN);
    $interests['Yoga'] = filter_var($interests['Yoga'], FILTER_VALIDATE_BOOLEAN);

    echo json_encode($interests);
}
else {
    echo json_encode(http_response_code(500));
}