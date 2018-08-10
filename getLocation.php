<?php
// Google Map API Key: AIzaSyCoRTbekTZbeNP03VMkpyx-N9Lcfe2XGP0
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

/*
 * 38.672287
 * -90.440702
 */
$id = $_GET['ID'];
    
    $sql = "SELECT City, State ,Country, FullLocation FROM Members WHERE ID = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $location = $row;
        
    $location['FullLocation'] = $row['City'] . ',' . $row['State'] .' '. $row['Country'];
    echo json_encode($location);



    
    
    
    
    




