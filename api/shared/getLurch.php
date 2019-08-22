<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$lurchID = $_GET['LurchID'];

$sql = "SELECT ID, Username, ProfilePhoto, Phone, (SELECT ETA FROM Notifications WHERE Lurch_ID = $lurchID) as ETA
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

