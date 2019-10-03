<?php
$env = $_GET['ENV'];

require '../connect.php';
require '../helpers.php';
include_once '../email.php';

$id = $_GET['ID'];
$lat = $_GET['Lat'];
$long = $_GET['Long'];
$massage = $_GET['Massage'];
$duration = $_GET['Duration'];
$total= $_GET['Total'];
$address = $_GET['Address'];
$time = $_GET['Time'];
$address = mysqli_escape_string($conn, $address);
$gender = $_GET['Gender'];
$notification = "Massage Request";

// insert into service table
$sql = "INSERT INTO Massage        (Customer_ID, Massage,   Duration,      Gender,    Total, Latitude, Longitude, Address,  Distance, ETA,   Status, Time,    MassageDate)
                            Values  ('$id',      '$massage', '$duration',   '$gender', '$total', '$lat', '$long',   '$address', '0',     '0', 'new', '$time', NOW()) ";
mysqli_query($conn, $sql);

$massageID = mysqli_insert_id($conn);


echo $massageID;

$sql2 = "SELECT ID, FirstName, Email, ProfilePhoto, ( 3959 * acos ( cos ( radians($lat) ) * cos( radians( Latitude ) ) *
cos( radians( Longitude ) - radians($long) ) + sin ( radians($lat) ) *
sin( radians( Latitude ) ) ) ) AS Distance 
FROM Members 
WHERE IsLurch = 1
AND ID != $id
And Gender = '$gender'
And ID NOT IN (SELECT Lurch_ID FROM Massage WHERE Status = 'Accepted' Or Status = 'Arrived')
And IsLurchActive = 1
Group By ID
HAVING Distance <= 30
ORDER BY Distance ASC
";

$notification = "Massage Request";


if (mysqli_query($conn, $sql2)) {
    
    $result = mysqli_query($conn, $sql2);

    
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
        
        $lurchID = $row['ID'];
        $email = $row['Email'];

        $subject = "Massage Request";
        $title = "Massage Request";
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
                                    Values ('$id',       '$lurchID', '$massageID', 'Massage', '$notification', 1,    NOW()) ";
        mysqli_query($conn, $sql3);
        
        // update ETA in carwash
        $sql4 = "UPDATE Massage Set Distance = '$distance' WHERE ID = $massageID";
        mysqli_query($conn, $sql4);
        
        $device = 'iPhone';
        if ($device == 'iPhone') {
         
         sendNewMessageMail($email, $senderName, $profilePhoto, $device, $subject, $title);
         pushNotification('Job', $notification, $lurchID);
         }
         else {
         pushNotificationAndroid('Job', $notification, $lurchID);
         }
         // give closest lurch a chance to respond
         sleep(2);
        }
    } 
}
