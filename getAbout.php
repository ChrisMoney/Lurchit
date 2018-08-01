<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/6/18
 * Time: 1:53 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select About FROM Members WHERE ID = $id ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    if (strlen($about) == 0 || strlen($about) == '') {
        $row['About'] == '';
    }
    
    $about = $row['About'];
    $about = trim($about);
    
    echo $about;
}
else {
    echo http_response_code(500);
}