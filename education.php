<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/28/18
 * Time: 7:23 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];
$education = $_GET['Education'];

if (strlen($education) <= 0) {
    // client data error
    echo http_response_code(400);
}

    $sql = "Update Members Set Education = '$education' WHERE ID = $id ";

    if (mysqli_query($conn, $sql)) {
        // successful
        echo http_response_code(200);
    }
    else {
        // error saving data
        echo http_response_code(500);
    }

