<?php 

$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';


$error = $_GET['Error'];
$device = $_GET['DEVICE'];

$sql = "INSERT INTO LogError (Log, Device, Date) Values ('$error','$device', NOW()) ";

if (mysqli_query($conn, $sql) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}

?>