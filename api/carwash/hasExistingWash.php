<?php
header("Content-Type: application/json;charset=utf-8");
require '../connect.php';

$id = $_GET['ID'];

$sql = "SELECT ID FROM Carwash WHERE Customer_ID = $id 
AND (Status = 'new' Or Status = 'accepted' Or Status = 'arrived') ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo 'false';
}
else {
    echo 'true';
}