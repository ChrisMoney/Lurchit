<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT AllowLikes, AllowComments, AllowDMs FROM Members WHERE ID = $id ";

if ($result = mysqli_query($conn, $sql)) {
    
    $engagementOptions = mysqli_fetch_assoc($result);
    
    $engagementOptions['AllowComments'] = filter_var($engagementOptions['AllowComments'], FILTER_VALIDATE_BOOLEAN);
    $engagementOptions['AllowLikes'] = filter_var($engagementOptions['AllowLikes'], FILTER_VALIDATE_BOOLEAN);
    $engagementOptions['AllowDMs'] = filter_var($engagementOptions['AllowDMs'], FILTER_VALIDATE_BOOLEAN);

    echo json_encode($engagementOptions);
}
    
    
   