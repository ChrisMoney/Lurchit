<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/31/18
 * Time: 6:27 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$drink = $_GET['Drink'];
$smoke = $_GET['Smoke'];

if (strlen($drink) <= 0 || strlen($smoke) <= 0) {
    // client data error
    echo http_response_code(400);
    exit;
}

$sql = "Update Members Set Drink = '$drink', Smoke = '$smoke' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}
