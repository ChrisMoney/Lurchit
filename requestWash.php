<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$jobID = $_GET['JobID'];


a:

$sql = "SELECT Lurch_ID
FROM Carwash
WHERE ID = $jobID AND Lurch_ID != 0 And Status = 'accepted' ";


$result = mysqli_query($conn, $sql);
$lurch = mysqli_fetch_assoc($result);
$currentLurchID = $lurch['Lurch_ID'];

$lurchID = 0;

if ($currentLurchID == 0) {
    // query again if job has not been accepted
    goto a;

}
else {
    $lurchID = $currentLurchID;
    echo $lurchID;
}



