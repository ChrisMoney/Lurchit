<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT ID FROM Notifications WHERE Member_ID = '$id' AND New = 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(true);
}
else {
    echo json_encode(false);
}