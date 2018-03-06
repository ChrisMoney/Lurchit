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

$build = $_GET['Build'];
$heightFeet = $_GET['HeightFeet'];
$heightInches = $_GET['HeightInches'];
$hair = $_GET['Hair'];
$eyes = $_GET['Eyes'];
$ethnicity = $_GET['Ethnicity'];
$id = $_GET['ID'];

    $sql = "Update Members Set Build = '$build', HeightFeet = '$heightFeet', HeightInches = '$heightInches', Hair = '$hair', Eyes = '$eyes', Ethnicity = '$ethnicity'
    WHERE ID = $id";

    if (mysqli_query($conn, $sql)) {
        return http_response_code(200);
    }
    else {
        // error saving data
        return http_response_code(500);
    }

