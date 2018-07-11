<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$flickpitchID = $_GET['FlickpitchID'];
$ownerID = $_GET['OwnerID'];

$sqlCheck = "SELECT Member_ID FROM FlickpitchViews WHERE Member_ID = $id AND Flickpitch_ID = $flickpitchID ";
$resultCheck = mysqli_query($conn, $sqlCheck);

if (mysqli_num_rows($resultCheck) > 0) {} else {
    $sql = "INSERT INTO FlickpitchViews (Flickpitch_ID, Member_ID, Owner_ID, ViewDate) 
            Values ('$flickpitchID', '$id', '$ownerID', NOW()) ";
    mysqli_query($conn, $sql);
   
}