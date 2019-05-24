<?php

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
include_once '../helpers.php';

$id = $_GET['ID'];

$sql = "SELECT FirstName, LastName, Username, Email, Phone, ProfilePhoto FROM Members WHERE ID = $id";

$count = 0;

while ($count == 0) :

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $count = 1;
        $profileView = mysqli_fetch_assoc($result);
        // format profile photo
        $mediaName = $profileView['ProfilePhoto'];
        $profileView['ProfilePhoto'] = ProfileMediaPath.$mediaName;
        
        echo json_encode($profileView);
    }
}

endwhile;
