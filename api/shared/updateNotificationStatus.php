<?php

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
include_once '../helpers.php';

$notificationID = $_GET['NotificationID'];

$sql = "Update Notifications Set New = 0 WHERE ID = $notificationID ";


if (mysqli_query($conn, $sql)) {
    echo 200;
}
else {
    echo 500;
}