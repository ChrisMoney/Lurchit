<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/9/18
 * Time: 4:58 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Media FROM ProfileMedia WHERE Member_ID = $id";

$result = mysqli_query($sql) or die(mysqli_error());


if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profileMedia = $row['Media'];
    $mediaUrl = "http://api.flickpitch.com/media/$profileMedia";
    echo $mediaUrl;
}
else {
    echo 400;
}
