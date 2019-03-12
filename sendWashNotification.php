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
$address = $_GET['Address'];
$address = mysqli_escape_string($conn, $address);

$notification = "Car Wash Request";

// insert into service table
$sql = "INSERT INTO Carwash         (Customer_ID, Carwash,    Tires,   Interior,     Wax,    Total, Latitude, Longitude, Address,   Status, WashDate)
                            Values  ('$id',      '$carwash', '$tires', '$interior', '$wax', '$total', '$lat', '$long',   '$address', 'new', NOW()) ";
mysqli_query($conn, $sql);

$carwashID = mysqli_insert_id($conn);

$sql2 = "SELECT ID, FirstName, Email, ProfilePhoto, ( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS distance 
FROM Members 
WHERE IsLurch = 1
And IsLurchActive = 1
Group By ID
HAVING distance <= 15

";

$notification = "Car Wash Request";


if (mysqli_query($conn, $sql2)) {
    
    $result = mysqli_query($conn, $sql2);

    
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
        
        $lurchID = $row['ID'];
        $senderName = $row['FirstName'];
        $email = $row['Email'];
        $profilePhoto = $row['ProfilePhoto'];
        $subject = "Car Wash Request";
        $title = "Car Wash Request";
        
        $profilePhoto = ProfileMediaPath.$profilePhoto;
            
        //echo $lurchID;
        
            // insert into notification table
            $sql3 = "INSERT INTO Notifications (Customer_ID, Lurch_ID,      Job_ID,        Job,    Message,       New, NotificationDate)
                                        Values ('$id',       '$lurchID', '$carwashID', 'Carwash', '$notification', 1,       NOW()) ";
            mysqli_query($conn, $sql3);
            
            $device = 'iPhone';
            if ($device == 'iPhone') {
             
             sendNewMessageMail($email, $senderName, $profilePhoto, $device, $subject, $title);
             pushNotification('Job', $notification, $lurchID); 
             }
             else {
             pushNotificationAndroid('Message', $notification, $lurchID);
             }
           
                 echo json_encode($carwashID, JSON_NUMERIC_CHECK);
        }
    }  
}
else {
    echo http_response_code(500);
}