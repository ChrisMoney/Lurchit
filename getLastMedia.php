<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/14/18
 * Time: 6:49 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT ID FROM MediaLibrary WHERE Member_ID = $id Order By ID DESC Limit 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $media = mysqli_fetch_assoc($result);
    $mediaID = $media['ID'];
    echo $mediaID;
}
else {
    echo 400;
}