<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT ProfilePhoto,Service,MinPrice, (Select MinPrice FROM Members WHERE ID = $id) as MinPriceCustView, Blurb,Description,Website,Phone,IsProfilePremium FROM Members WHERE ID = $id";

$count = 0;

while ($count == 0) :

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $count = 1;
        $profileView = mysqli_fetch_assoc($result);
        // format profile photo
        $mediaName = $profileView['ProfilePhoto'];
        
        if (strlen($mediaName) > 1) {
            $profileView['ProfilePhoto'] = ProfileMediaPath.$mediaName;
        }
        $minPrice = $profileView['MinPriceCustView'];
        $minPrice = "Min Price $".$minPrice;
        $profileView['MinPriceCustView'] = $minPrice;
        
        echo json_encode($profileView);
    }
}

endwhile;