<?php
if ($env == 'DEV') {
    define("ProfileMediaPath", "http://apilurchit.com/api/media-dev/");
    define("CarMediaPath", "http://apilurchit.com/api/cars-dev/");
}
else {
    define("ProfileMediaPath", "http://apilurchit.com/api/media/");
    define("CarMediaPath", "http://apilurchit.com/api/cars/");
}

define("LogoPath", "http://apilurchit.com/api/logo.png");
define ("MassageRadius", "15");

function getDistance($id) {
    $conn = connection();
    
    $sql = "SELECT Distance FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $distance = $row['Distance'];
    if ($distance == 'Anywhere') {
        // total distance of the earth
        $distance = 24902;
    }
    return $distance;
}

/*
 * Test App ID: 02681849-4f61-41ba-ad44-9dddca4f2172
 * Test Key: MjJkODVjZTEtM2JiMS00OGUyLWEyZDUtYWMzMzJhNDY5ZjQ2
 * 
 * Production App ID: aee090c8-a009-40fb-96ac-9ab277eedfdd
 * Production Key: NmZkMTk4NWYtMDE0OC00YmZmLWIyNmEtNmY4NmQyOTM5MmU3
 */ 
function pushNotification($heading, $message, $userID){
		$content = array(
			"en" => $message
			);
    
		$heading = array(
		    "en" => $heading
		);
		
         $fields = array(
            'app_id' => "292bf9f6-817b-468f-9245-4014644d4acd",
            'filters' => array(array("field" => "tag", "key" => "ID", "relation" => "=", "value" => "$userID")),
            'contents' => $content,
             'headings' => $heading
        );
		
        
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NzBmMGQ2ZjYtZTQ2Yy00ZDk4LThjZmEtNDY4Mzc0MDA5M2Mx'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;

	}
  
	function pushNotificationAndroid($heading, $message, $userID) {
	    
	    $serverKey = "AAAAAJWxg1Q:APA91bFbLcCy_qbjdrg7WEbJfrv_
                        MGqB6LmOtaWoLSRccVvWPO1SkdBwatuy-XZxX5O8PhHKP1tO1WHZx3s4_
                        pSE4cZY0Y-pG1K-snQ5cw68QFgijzY8MUQ-h_iERHvI8iwcHHLQym_Q";
	    
	    $msg = array
	    (
	        'body' 	=> $message,
	        'title'	=> $heading,
	        'icon'	=> 'myicon',/*Default Icon*/
	        'sound' => 'mySound'/*Default sound*/
	    );
	    $fields = array
	    (
	        'to'		=> '/topics/'.$userID,
	        'notification'	=> $msg
	    );
	    
	    
	    $headers = array
	    (
	        'Authorization: key=' . $serverKey,
	        'Content-Type: application/json'
	    );
	    #Send Reponse To FireBase Server
	    $ch = curl_init();
	    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	    curl_setopt( $ch,CURLOPT_POST, true );
	    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	    $result = curl_exec($ch );
	    curl_close( $ch );
	    
	}
	
	function notification($lurchID, $customerID, $jobID, $job, $message) {
	    $conn = connection();
	    
	    $sqlOwnerID = "SELECT Member_ID FROM Statuses WHERE ID = $typeID ";
	    $resultOwnerID = mysqli_query($conn, $sqlOwnerID);
	    $rowOwnerID = mysqli_fetch_assoc($resultOwnerID);
	    $ownerID = $rowOwnerID['Member_ID'];
	    
	    $sql = "INSERT INTO Notifications (Lurch_ID,    Customer_ID,    Job_ID,  Job,    Message,  New, NotificationDate) 
                                    Values ('$lurchID', '$customerID', '$jobID', '$job', '$message', 1, NOW()) ";
	    
	    mysqli_query($conn, $sql);
	}
	
    function calculate_time_span($date){
        
        $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime(date('Y-m-d H:i:s', $date));
        
        $months = floor($seconds / (3600*24*30));
        $day = floor($seconds / (3600*24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours*3600)) / 60);
        $secs = floor($seconds % 60);
        
        $hours = $hours - 5;
        
        if($seconds < 60)
            $time = $secs." s ago";
            else if($seconds < 60*60 )
                $time = $mins."m ago";
                else if($seconds < 24*60*60)
                    $time = $hours."h ago";
                    else if($seconds > 24*60*60 && $seconds < (24*60*60) * 30)
                        $time = $day."d ago";
                        else if ($secounds > (24*60*60) * 30 && $seconds < ((24*60*60) * 30) * 11)
                        $time = $month."mo ago";
                        else
                            $time = date('D M d Y', $date);
                            
                            if ($hours <= 1) {
                                $time = 'New';
                            }
                            return $time;
}




function checkActive($id, $env) {
    
    $conn = connection($db);
    $sql = "SELECT IsDeactivated FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_assoc($result);
    
    $bool = filter_var($row['IsDeactivated'], FILTER_VALIDATE_BOOLEAN);

    if ($bool == false) {
        $isActive = true;
    }
    else {
        $isActive = false;
    }
    return $isActive;
}

function phone_number_format($number) {
    // Allow only Digits, remove all other characters.
    $number = preg_replace("/[^\d]/","",$number);
    
    // get number length.
    $length = strlen($number);
    
    // if number = 10
    if($length == 10) {
        $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $number);
    }
    
    return $number;
    
}

function getProfilePhoto($id, $env) {
    $conn = connection($env);
    $sql = "SELECT ProfilePhoto FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $profilePhoto = $row['ProfilePhoto'];
    
    return $profilePhoto;
}

function getFirstName($id, $env) {
    $conn = connection($env);
    $sql = "SELECT FirstName FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fName = $row['FirstName'];
    
    return $fName;
}

function getUsername($id, $env) {
    $conn = connection($env);
    $sql = "SELECT Username FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row['Username'];
    
    return $username;
}

function calculateETA($customerId, $distance, $env) {
    $conn = connection($env);
    
    date_default_timezone_set("America/Chicago");
    
    $centralStates = array("ND","MO","SD","NE","KS","OK","TX","MN","IA","MO","AR","LA","WI","TN","MS","LA","AL");
    
    $pacificStates = array("WA","OR","CA","NV");
    
    $mountainStates = array("MT","ID","UT","AZ","WY","CO","NM");
    
    $easternStates = array("MI","IN","OH","KY","ME","VT","NY","PA","VA","NC","SC","GA","FL","NH","MA","RI","CT","NJ","DE","MD","DC");
    
    // get lurch state
    $sqlState = "SELECT State FROM Members WHERE ID = $customerId ";
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
    
    
    $eta = $currentTime + ($distance * 60);
    $eta = "ETA ".date('g:i', $eta);

    return $eta;

}

function detect_zipcode($string) {
    $conn = connection('DEV');
    
    $addressArray = explode(' ',$string);
    $zipCode = end($addressArray);
    $arrayCount = count($addressArray);
    
    if ($arrayCount < 6 || strlen($zipCode) != 5) {
        $sql = "INSERT INTO LogError (Log, Date) Values ('$arrayCount', NOW())";
        mysqli_query($conn, $sql);
        return false;
    }
    else {
        return true;
        
    }
}

function getSelectedServiceIndex($service) {
    $serviceIndex = "0";

    if ($service == "Animal Care") {
        $serviceIndex = ServiceIndexes :: AnimalCare;
    }
    elseif ($service == "Arts & Entertainment") {
        $serviceIndex = ServiceIndexes :: ArtsEntertainment;
    }
    elseif ($service == "Automotive") {
        $serviceIndex = ServiceIndexes :: Automotive;
    }
    elseif ($service == "Barber") {
        $serviceIndex = ServiceIndexes :: Barber;
    }
    elseif ($service == "Business") {
        $serviceIndex = ServiceIndexes :: Business;
    }
    
    elseif ($service == "Childcare") {
        $serviceIndex = ServiceIndexes :: Childcare;
    }
    elseif ($service == "Cleaning") {
        $serviceIndex = ServiceIndexes :: Cleaning;
    }
    
    elseif ($service == "Cosmetology") {
        $serviceIndex = SserviceIndexes :: Cosmetology;
    }
    elseif ($service == "Education") {
        $serviceIndex = ServiceIndexes :: Education;
    }
    elseif ($service == "Employment") {
        $serviceIndex = ServiceIndexes :: Employment;
    }
    elseif ($service == "Fashion") {
        $serviceIndex = ServiceIndexes :: Fashion;
    }
    elseif ($service == "Finance") {
        $serviceIndex = ServiceIndexes :: Finance;
    }
    elseif ($service == "Fitness") {
        $serviceIndex = ServiceIndexes :: Fitness;
    }
    elseif ($service == "Handyman") {
        $serviceIndex = ServiceIndexes :: Handyman;
    }
    elseif ($service == "Insurance") {
        $serviceIndex = ServiceIndexes :: Insurance;
    }
    elseif ($service == "Interior Design") {
        $serviceIndex = ServiceIndexes :: InteriorDesign;
    }
    
    elseif ($service == "Landscaping") {
        $serviceIndex = ServiceIndexes :: Landscaping;
    }
    elseif ($service == "Massage Therapy") {
        $serviceIndex = ServiceIndexes :: MassageTherapy;
    }
    elseif ($service == "Media & Production") {
        $serviceIndex = ServiceIndexes :: MediaProduction;
    }
    elseif ($service == "Medical Care") {
        $serviceIndex = ServiceIndexes :: MedicalCare;
    }
    elseif ($service == "Mental Therapy") {
        $serviceIndex = ServiceIndexes :: MentalTherapy;
    }
    elseif ($service == "Misc Services") {
        $serviceIndex = ServiceIndexes :: MiscServices;
    }
    elseif ($service == "Moving & Delivery") {
        $serviceIndex = ServiceIndexes :: MovingDelivery;
    }
    elseif ($service == "Night Life") {
        $serviceIndex = ServiceIndexes :: NightLife;
    }
    elseif ($service == "Photography") {
        $serviceIndex = ServiceIndexes :: Photography;
    }
    elseif ($service == "Real Estate") {
        $serviceIndex = ServiceIndexes :: RealEstate;
    }
    elseif ($service == "Restaurant & Food Services") {
        $serviceIndex = ServiceIndexes :: RestaurantFoodServices;
    }
    elseif ($service == "Technology") {
        $serviceIndex = ServiceIndexes :: Technology;
    }
   
    return $serviceIndex;
}

/****************
This enum list order should always match the list in the app
*/
class ServiceIndexes {
    const AnimalCare = "0";
    const ArtsEntertainment = "1";
    const Automotive = "2";
    const Barber = "3";
    const Business = "4";  
    const Childcare = "5";
    const Cleaning = "6";
    const Cosmetology = "7"; 
    const Education = "8";
    const Employment = "9";
    const Fashion = "10";
    const Finance = "11";
    const Fitness = "12";
    const Handyman = "13";
    const Insurance = "14";
    const InteriorDesigner = "15";
    const Landscaper = "16";
    const MassageTherapy = "17";
    const MediaProduction = "18";
    const MedicalCare = "19"; 
    const MentalTherapy = "20";
    const MiscServices = "21";
    const MovingDelivery = "22";
    const NightLife = "23";
    const Photography = "24";
    const RealEstate = "25"; 
    const RestaurantFoodServices = "26";
    const Technology = "27";
}