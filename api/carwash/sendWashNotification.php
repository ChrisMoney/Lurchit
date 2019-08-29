<?php
$env = $_GET['ENV'];

require '../connect.php';
require '../helpers.php';
include_once '../email.php';

$id = $_GET['ID'];
$lat = $_GET['Lat'];
$long = $_GET['Long'];
$carwash = $_GET['Carwash'];
$interior = $_GET['Interior'];
$wax = $_GET['Wax'];
$total= $_GET['Total'];
$address = $_GET['Address'];
$temp = $_GET['Temp'];
$time = $_GET['Time'];
$address = mysqli_escape_string($conn, $address);

$notification = "Car Wash Request";

// insert into service table
$sql = "INSERT INTO Carwash         (Customer_ID, Carwash,   Interior,     Wax,    Total, Latitude, Longitude, Address,  Distance, ETA,   Status, Temp, Time,    WashDate)
                            Values  ('$id',      '$carwash', '$interior', '$wax', '$total', '$lat', '$long',   '$address', '0',     '0', 'new',  '$temp', '$time', NOW()) ";
mysqli_query($conn, $sql);

$carwashID = mysqli_insert_id($conn);


echo $carwashID;

$sql2 = "SELECT ID, FirstName, Email, ProfilePhoto, ( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS Distance 
FROM Members 
WHERE IsLurch = 1
AND ID != $id
And ID NOT IN (SELECT Lurch_ID FROM Carwash WHERE Status = 'Accepted' Or Status = 'Arrived')
And IsLurchActive = 1
Group By ID
HAVING Distance <= 30
ORDER BY Distance ASC
";

$notification = "Car Wash Request";


if (mysqli_query($conn, $sql2)) {
    
    $result = mysqli_query($conn, $sql2);

    
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
        
        $lurchID = $row['ID'];
        $email = $row['Email'];

        $subject = "Car Wash Request";
        $title = "Car Wash Request";
        $distance = $row['Distance'];
        
        $profilePhoto = getProfilePhoto($id, $env);
        if (strlen($profilePhoto) > 1) {
            $profilePhoto = ProfileMediaPath.$profilePhoto;
        }
        else {
            $profilePhoto = LogoPath;
        }
            
        $senderName = getFirstName($id, $env);
        
        // insert into notification table
        $sql3 = "INSERT INTO Notifications (Customer_ID, Lurch_ID,      Job_ID,        Job,    Message,       New,  NotificationDate)
                                    Values ('$id',       '$lurchID', '$carwashID', 'Carwash', '$notification', 1,    NOW()) ";
        mysqli_query($conn, $sql3);
        
        // update ETA in carwash
        $sql4 = "UPDATE Carwash Set Distance = '$distance' WHERE ID = $carwashID";
        mysqli_query($conn, $sql4);
        
        $device = 'iPhone';
        if ($device == 'iPhone') {
         
         sendNewMessageMail($email, $senderName, $profilePhoto, $device, $subject, $title);
         pushNotification('Job', $notification, $lurchID);
         }
         else {
         pushNotificationAndroid('Message', $notification, $lurchID);
         }
         // give closest lurch a chance to respond
         sleep(2);
        }
    } 
}
