<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];

require '../connect.php';

$id = $_GET['ID'];

$sql = "SELECT BirthMonth, BirthDay, BirthYear, Address, MailCity, MailState, MailZip, Apt, AES_DECRYPT(SSN, 'ssn') as SSN, Phone 
FROM Members WHERE ID = $id";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    $demographics = mysqli_fetch_assoc($result);   


    echo json_encode($demographics);
}