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

$sql = "SELECT * FROM Members WHERE IsLurchit = 1 And IsLurchActive = 1 
And ";

// query distance
// send push

$sql = "SELECT ID, ( 3959 * acos ( cos ( radians($lat) ) * cos( radians( s.Latitude ) ) *
cos( radians( s.Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( s.Latitude ) ) ) ) AS distance 
FROM Members 
HAVING distance <= 10

";

if (mysqli_query($conn, $sql)) {
    
    $result2 = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
   
    
    foreach ($rows as $row) {
        
        $lurchitID = $row['ID'];
        
        if ($device == 'iPhone') {
            pushNotification('Message', $message, $lurcitID);
            
           
        }
        else {
            pushNotificationAndroid('Message', $message, $lurchitID);
        }
        
        $notification = "Car Wash Request";
        
        // insert into service table
        $sql2 = "INSERT INTO Carwash (Customer_ID, Carwash, Tires, Interior, Wax, Total, Status, WashDate) 
                            Values  ('$id', '$carwash', '$tires', '$interior', '$wax', '$total', 'new', NOW()) ";
        mysqli_query($conn, $sql2);
        
        $carwashID = mysqli_insert_id($conn);
        
        // insert into notification table
        $sql = "INSERT INTO Notifications (Customer_ID, Job_ID,        Job,    Message,       New, NotificationDate) 
                                    Values ('$id',      '$carwashID', 'Carwash', '$notification', 1,       NOW()) ";
    }
   
    
}