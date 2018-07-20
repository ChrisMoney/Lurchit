<?php 

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$statusID = $_GET['StatusID'];


$sql = "DELETE FROM Statuses WHERE ID = '$statusID' ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}