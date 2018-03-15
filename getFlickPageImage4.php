<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/10/18
 * Time: 9:08 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT * FROM MediaLibrary WHERE Member_ID = $id Order by ID DESC LIMIT 3,1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $mediaName = $row['MediaName'];
    $mediaUrl = "http://api.flickpitch.com/media/$mediaName";

    echo $mediaUrl;
}
else {
    $mediaUrl = "http://api.flickpitch.com/images/noimage.png";

    echo $mediaUrl;
}
