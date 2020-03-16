<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/9/18
 * Time: 4:58 PM
 */

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Phone FROM Members WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $phone = $row['Phone'];
    echo $phone;
}

