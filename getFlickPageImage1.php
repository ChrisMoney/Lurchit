<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/10/18
 * Time: 4:22 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT * FROM MediaLibrary WHERE Member_ID = $id Order by ID DESC LIMIT 0,1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $mediaName = $row['MediaName'];
        $mediaUrl = "http://api.flickpitch.com/media/$mediaName";

    echo $mediaUrl;
}
else if (mysqli_num_rows($result) == 0) {
    echo 400;
}
else {
    echo 500;
}