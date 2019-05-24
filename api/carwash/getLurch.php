<?php

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';

$lurchID = $_GET['LurchID'];

$sql = "SELECT ID, Username, ProfilePhoto
FROM Members
WHERE ID = $lurchID ";


    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
    
        $lurch = mysqli_fetch_assoc($result);
        
        $profileMedia = $lurch['ProfilePhoto'];
        $mediaUrl = ProfileMediaPath.$profileMedia;
        $lurch['ProfilePhoto'] = $mediaUrl;
        
        echo json_encode($lurch);
    }

