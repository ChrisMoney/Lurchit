<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/7/18
 * Time: 9:35 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Email, Username FROM Members WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $accountSettings = mysqli_fetch_assoc($result);

    echo json_encode($accountSettings);
}
else {
    echo json_encode(http_response_code(400));
}