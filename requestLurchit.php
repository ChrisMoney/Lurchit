<?php

$lat = $_GET['Lat'];
$long = $_GET['Long'];
$job = $_GET['Job'];

$sql = "SELECT * FROM Members WHERE IsLurchit = 1 And IsLurchActive = 1 
And ";

// query distance
// send push