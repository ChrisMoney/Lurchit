<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/19/18
 * Time: 12:50 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$conservative = $_GET['Conservative'];
$liberal = $_GET['Liberal'];
$moderate = $_GET['Moderate'];
$noPoliticalPref = $_GET['NoPoliticalPref'];
$christian = $_GET['Christian'];
$muslim = $_GET['Muslim'];
$spiritual = $_GET['Spiritual'];
$agnostic = $_GET['Agnostic'];
$atheist = $_GET['Atheist'];
$noReligiousPref = $_GET['NoReligiousPref'];

$sql = "Update MemberPref Set 
Christian = '$christian', Muslim = '$muslim', Spiritual = '$spiritual', Agnostic = '$agnostic', 
Atheist = '$atheist', NoReligiousPref = '$noReligiousPref', Conservative = '$conservative', 
Liberal = '$liberal', Moderate = '$moderate', NoPoliticalPref = '$noPoliticalPref'
 WHERE Member_ID = $id";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}