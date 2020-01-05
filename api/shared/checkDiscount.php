<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$ID = $_GET['ID'];
$service = $_GET['Service'];
$service = strtolower($service);
$origAmount = $_GET['OrigAmount'];

$sql = "SELECT ID,Discount,HasDiscount FROM Discounts WHERE Customer_ID = $ID AND Service = '$service' And HasUsed = 0 ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    $discountData = mysqli_fetch_assoc($result);
    
    $discountData['HasDiscount'] = 'true';
    $discount = $origAmount - $discountData['Discount'];
    $discountData['Discount'] = "$discount";
}
else {
    $discountData['HasDiscount'] = 'false';
    $discountData['ID'] = 0;
}

echo json_encode($discountData);
