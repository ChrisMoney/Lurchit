<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT fpv.Member_ID, m.Username as Username, pm.MediaName as MediaName 
FROM FlickpitchViews fpv, ProfileMedia pm, Members m
WHERE fpv.ID = $id And pm.Member_ID = fpv.Member_ID And m.ID = fpv.Member_ID";

$myArray = array();

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($fpViewer = mysqli_fetch_assoc($result)) {
            $mediaName = $fpViewer['MediaName'];
            $fpViewer['MediaName'] = 'http://api.flickpitch.com/api/media/'.$mediaName;
            

            
            $myArray[] = $fpViewer;
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