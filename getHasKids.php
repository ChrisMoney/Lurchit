<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/5/18
 * Time: 11:43 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT HasKids FROM Members WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hasKids = $row['HasKids'];
    $hasKids = trim($hasKids);
    echo $hasKids;
}
else {
    echo json_encode(http_response_code(500));
}