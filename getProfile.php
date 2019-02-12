<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT FirstName, LastName, Username, Email, Phone, ProfilePhoto, Password FROM Members WHERE ID = $id";


if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $profileView = mysqli_fetch_assoc($result);
        // format profile photo
        $mediaName = $profileView['ProfilePhoto'];
        $profileView['MediaName'] = ProfileMediaPath.$mediaName;

    echo json_encode($profileView);
        }
else {
    echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}