<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];
$otherID = $_GET['OtherID'];

$sql = "Update Messages Set New = 0 WHERE Owner_ID = $id And Other_ID = $otherID";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo true;
}
else {
    echo false;
}