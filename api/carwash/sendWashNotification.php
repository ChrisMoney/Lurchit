<?php
$env = $_GET['ENV'];

date_default_timezone_set("America/Chicago");

$centralStates = array("ND","MO","SD","NE","KS","OK","TX","MN","IA","MO","AR","LA","WI","TN","MS","LA","AL");

$pacificStates = array("WA","OR","CA","NV");

$mountainStates = array("MT","ID","UT","AZ","WY","CO","NM");

$easternStates = array("MI","IN","OH","KY","ME","VT","NY","PA","VA","NC","SC","GA","FL","NH","MA","RI","CT","NJ","DE","MD","DC");

require '../connect.php';
require '../helpers.php';
include_once '../email.php';

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
ORDER BY distance ASC
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
        
        // get lurch state
        $sqlState = "SELECT State FROM Members WHERE ID = $id ";
        $resultState = mysqli_query($conn, $sqlState);
        $rowState = mysqli_fetch_assoc($resultState);
        $state = $rowState['State'];
       
        if (in_array($state, $centralStates)) {
            $currentTime = time();
        }
        elseif (in_array($state, $pacificStates)) {
            $currentTime = time() - 60*60*2;
        }
        elseif (in_array($state, $mountainStates)) {
            $currentTime = time() - 60*60;
        }
        else {
            $currentTime = time() + 60*60;
        }
        

        $eta = date("h:i", strtotime('+'.$distance. 'minutes', $currentTime));
        
        
        // insert into notification table
        $sql3 = "INSERT INTO Notifications (Customer_ID, Lurch_ID,      Job_ID,        Job,    Message,       New,    ETA,    NotificationDate)
                                    Values ('$id',       '$lurchID', '$carwashID', 'Carwash', '$notification', 1,    '$eta',   NOW()) ";
        mysqli_query($conn, $sql3);
        
        $sql4 = "UPDATE Carwash Set ETA = '$eta' WHERE ID = $carwashID";
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
