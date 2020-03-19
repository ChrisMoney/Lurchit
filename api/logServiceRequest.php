<?php 

$env = $_GET['ENV'];
require 'connect.php';
require 'helpers.php';

$providerID = $_GET['ProviderID'];
$service = $_GET['Service'];

$sql = "INSERT INTO LogServiceRequest (Provider_ID, Service, Date) Values ('$providerID','$service', NOW()) ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}

?>