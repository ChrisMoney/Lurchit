<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/28/18
 * Time: 6:15 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$ethnicity = $_GET['Ethnicity'];
$id = $_GET['ID'];

    $sql = "Update Members Set Ethnicity = '$ethnicity' WHERE ID = $id";

    if (mysqli_query($conn, $sql)) {
        echo http_response_code(200);
    }
    else {
        // error saving data
        echo http_response_code(500);
    }

