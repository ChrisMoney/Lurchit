<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
include_once '../helpers.php';

$notificationID = $_GET['NotificationID'];

$sql = "DELETE FROM Notifications WHERE ID = $notificationID ";


if ($result = mysqli_query($conn, $sql)) {
    echo 200;
}
else {
    echo 500;
}