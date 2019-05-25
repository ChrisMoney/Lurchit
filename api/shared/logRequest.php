<?php
require '../connect.php';

$service = $_GET['ServiceType'];
$memberID = $_GET['Member_ID'];

$sql = "INSERT INTO LogRequests (Member_ID, ServiceType, RequestDate) Values ('$memberID', '$service', NOW()) ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}