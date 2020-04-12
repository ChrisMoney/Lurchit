<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Username,ProfilePhoto,Service,MinPrice, (Select Service FROM Members WHERE ID = $id) as ServiceIndex, (Select MinPrice FROM Members WHERE ID = $id) as MinPriceCustView, Blurb,Description,Website,Phone,IsProfilePremium FROM Members WHERE ID = $id";

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
        
        $service = $profileView['Service'];
        $service = trim($service);
        $serviceIndex = getSelectedServiceIndex($service);
        $profileView['ServiceIndex'] = $serviceIndex;

        echo json_encode($profileView);
    }
}

endwhile;