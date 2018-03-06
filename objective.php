<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/31/18
 * Time: 7:14 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$dating = $_GET['Dating'];
$friends = $_GET['Friends'];
$networking = $_GET['Networking'];

$sql = "Update Members Set Dating = '$dating', Friends = '$friends', Networking = '$networking'  WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}