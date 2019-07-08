<?php
header('Content-Type: application/json');
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Address FROM CustomerAddress WHERE Member_ID = $id And IsPrimary = 1 ";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (empty($row['Address'])) {
    
    
    $address = '';
    
    echo $address;
}
else {
    echo $row['Address'];
}