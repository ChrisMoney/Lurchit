<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/15/18
 * Time: 7:18 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$data = json_decode(file_get_contents('php://input'), true);

$memberID = $data['MemberID'];
$pitch = $data['Pitch'];
$flick = $data['Flick'];
$source = $data['Source'];
$long = $data['Long'];
$late = $data['Lat'];

// save media to file server
file_put_contents('../api/flicks/'.$mediaName, base64_decode($flick));

$sql = "INSERT INTO Flickpitch (Member_ID, Flick, Pitch, Source, Longitude, Latitude, PitchDate) VALUES"; 
$sql .= "('$memberID', '$flick', '$pitch', '$source', '$long', '$lat', NOW())";

if (mysqli_query($conn, $sql)) {
    return http_response_code(200);
}
else {
    return http_response_code(500);
}