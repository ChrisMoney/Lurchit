<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
include_once '../helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Make, Model, Year, CarPhoto FROM Members WHERE ID = $id ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    
    $vehicle = mysqli_fetch_assoc($result);
    
    
    // build image url
    $vehiclePic = $vehicle['CarPhoto'];
    if (strlen($vehiclePic) > 1) {
        $vehicle['CarPhoto'] = CarMediaPath.$vehiclePic;
    }
    
    echo json_encode($vehicle);
}