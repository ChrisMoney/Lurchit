<?php
require 'connect.php';
require 'helpers.php';
include_once 'email.php';

$id = $_GET['ID'];
$lat = $_GET['Lat'];
$long = $_GET['Long'];
$carwash = $_GET['Carwash'];
$interior = $_GET['Interior'];
$wax = $_GET['Wax'];
$tires = $_GET['Tires'];
$total= $_GET['Total'];

$notification = "Car Wash Request";

// insert into service table
$sql = "INSERT INTO Carwash (Customer_ID, Carwash, Tires, Interior, Wax, Total, Status, WashDate)
                            Values  ('$id', '$carwash', '$tires', '$interior', '$wax', '$total', 'new', NOW()) ";
mysqli_query($conn, $sql);

$carwashID = mysqli_insert_id($conn);

$sql2 = "SELECT DISTINCT ID, ( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS distance 
FROM Members 
Group By ID
HAVING distance <= 10

";

$notification = "Car Wash Request";


if (mysqli_query($conn, $sql2)) {
    
    $result = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_assoc($result);
   
    
    foreach ($rows as $row) {
        
        $lurchID = $row['ID'];
        
        if ($lurchID > 0) {
            
            // echo $lurchitID;
            
            $device = 'iPhone';
            if ($device == 'iPhone') {
             pushNotification('Message', $message, $lurchID);
             }
             else {
             pushNotificationAndroid('Message', $message, $lurchitID);
             }
            
            //pushNotification('Message', $message, $lurchitID);
            
            // insert into notification table
            $sql3 = "INSERT INTO Notifications (Customer_ID, Lurch_ID,      Job_ID,        Job,    Message,       New, NotificationDate)
                                    Values ('$id',       '$lurchID', '$carwashID', 'Carwash', '$notification', 1,       NOW()) ";
            mysqli_query($conn, $sql3);
        }
        
        echo http_response_code(200);
    }  
}
else {
    echo http_response_code(500);
}