<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/30/18
 * Time: 9:22 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$hasKids = $_GET['HasKids'];
$wantsKids = $_GET['WantsKids'];

if (strlen($hasKids) <= 0 || strlen($wantsKids) <= 0) {
    // client data error
    echo http_response_code(400);
    exit;
}

$sql = "Update Members Set 
HasKids = '$hasKids', 
WantsKids = '$wantsKids' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}
