<?php
define("ProfileMediaPath", "http://api.lurchit.com/api/media/");
define("CarMediaPath", "http://api.lurchit.com/api/cars/");
define("CommentMediaPath", "http://api.statuz.com/api/comments/");
define("MessageMediaPath", "http://api.statuz.com/api/messages/");

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
	    
	    $serverKey = "AAAAMt6yYGw:APA91bH3n1KNrRM6vQQfaN-ld0HVF5dM1qq-
                      3Jt2Uo4xKkG-VG4YdGDWmg3qkF4wP2BpsBilBuhBhp-
                      aZg0LRE1kmC60M0GrUFe3azbx1kx_U9PlxAdZKT1ZZQ_8Kus2XpIoHnfkOwvF";
	    
	    $msg = array
	    (
	        'body' 	=> $message,
	        'title'	=> $heading,
	        'icon'	=> 'myicon',/*Default Icon*/
	        'sound' => 'mySound'/*Default sound*/
	    );
	    $fields = array
	    (
	        'to'		=> $userID,
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




function checkActive($id) {
    
    $conn = connection();
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

function getProfilePhoto($id) {
    $conn = connection();
    $sql = "SELECT ProfilePhoto FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $profilePhoto = $row['ProfilePhoto'];
    
    return $profilePhoto;
}

function getFirstName($id) {
    $conn = connection();
    $sql = "SELECT FirstName FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fName = $row['FirstName'];
    
    return $fName;
}
