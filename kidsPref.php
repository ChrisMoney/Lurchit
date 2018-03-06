<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/17/18
 * Time: 5:59 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$noKids = $_GET['HasNoKids'];
$hasKids = $_GET['HasKids'];
$noHasKidsPref = $_GET['HasKidsNoPref'];
$wantsKids = $_GET['WantsKids'];
$noWantsKids = $_GET['WantsNoKids'];
$noWantsKidsPref = $_GET['WantsKidsNoPref'];

$sql = "Update MemberPref Set HasNoKids = '$noKids', HasKids = '$hasKids',HasKidsNoPref = '$noKidsPref', WantsKids = '$wantsKids', WantsNoKids = '$noWantsKids', WantsKidsNoPref = '$noWantsKidsPref' WHERE Member_ID = $id";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}
