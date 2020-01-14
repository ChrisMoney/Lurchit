<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
include_once '../helpers.php';

$id = $_GET['ID'];
$device = $_GET['DEVICE'];

$sql = "SELECT ID FROM Notifications WHERE New = 1 And Lurch_ID = $id ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    if ($device == "IOS") {
        echo 'true';   
}
else {
    echo json_encode('true');
}
}
else {
    if ($device == "IOS") {
        echo 'false';
    }
    else {
        echo json_encode('false');
    }
}