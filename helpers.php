<?php

function getDistance($id) {
    $conn = connection();
    
    $sql = "SELECT Distance FROM MemberPref WHERE Member_ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $distance = $row['Distance'];
    return $distance;
}

/*
 * Test App ID: 02681849-4f61-41ba-ad44-9dddca4f2172
 * Test Key: MjJkODVjZTEtM2JiMS00OGUyLWEyZDUtYWMzMzJhNDY5ZjQ2
 * 
 * Production App ID: fc6a4020-ead9-45e2-bf54-de19d749f009
 * Production Key: ZThlOTdhMmItMzA2OC00NmMwLWEzYTItY2FhYmM1NmVkZmRi
 */ 
function pushNotification($message, $userID){
		$content = array(
			"en" => $message
			);
    
         $fields = array(
            'app_id' => "02681849-4f61-41ba-ad44-9dddca4f2172",
            'filters' => array(array("field" => "tag", "key" => "ID", "relation" => "=", "value" => "$userID")),
            'contents' => $content
        );
		
        
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic MjJkODVjZTEtM2JiMS00OGUyLWEyZDUtYWMzMzJhNDY5ZjQ2'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;

	}
    
    function calculate_time_span($date, $curtime){
    $seconds  = strtotime(date('Y-m-d H:i:s' )) - strtotime($date) ;
    
        $months = floor($seconds / (3600*24*30));
        $day = floor($seconds / (3600*24));                
        $hours = floor($seconds / 3600);           
        $mins = floor(($seconds - ($hours*3600)) / 60);
        
        $secs = floor($seconds % 60);
        if ($secs == "1") {
            $secText = " second ago";
        }
        else {
            $secText = " seconds ago";
        }
        
        $monthText;
        
        /* -----------------------
        Display Intervals
        ----------------------*/
        
        // minutes
        if($seconds < 60)
            $time = $secs. $secText;
        
            else if($seconds < 60*60 ) {
                if ($mins == "1") {
                    $minText = " minute ago";
                }
                else {
                    $minText = " minutes ago";
                }
            $time = $mins. $minText;
            }
           
        // hours
        else if($seconds < 24*60*60) {
            
            if ($hours >= 5) {
                $hours = $hours - 5;
                if ($hours == 0) {
                    $hours = "";
                    $hourText = "New";
                }
            }
            
            if ($hours == 1) {
                $hourText = ' hour ago';
            }
            $time = $hours. $hourText;
            
            }
           
        
        // days
        else if($seconds > 24*60*60) {
            if ($day == "1") {
                $dayText = " day ago";
            }
            else {
                $dayText = " days ago";
            }
            $time = $day. $dayText;
        }
        
        // month
        else if ($seconds > (24*60*60) * 30) 
            if ($months == 1) {
                $monthText = " month ago";
            }
        else if ($months <= 12){
            $monthText = " months ago";
            
            $time = $months. $monthText;
        }
        
        // more than a year
        else {
            $time = date('D M j Y');
        }
        return $time;
}
    