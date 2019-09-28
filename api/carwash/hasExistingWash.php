<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';

$id = $_GET['ID'];
$device = $_GET['DEVICE'];

$sql = "SELECT ID FROM Carwash WHERE Customer_ID = $id 
AND (Status = 'new' Or Status = 'accepted' Or Status = 'arrived') ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    if ($device == 'IOS') {
        echo 'false';
    }
    elseif ($device == 'ANDROID') {
        echo json_encode('false');
    }
    else {
        echo 'false';
    }
   
}
else {
    if ($device == 'IOS') {
        echo 'false';
    }
    elseif ($device = 'ANDROID') {
        echo json_encode('true');
    }
    else {
        echo 'true';
    }

}