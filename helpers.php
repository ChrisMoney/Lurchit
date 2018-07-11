<?php

function getDistance($id) {
    $conn = connection();
    
    $sql = "SELECT Distance FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $distance = $row['Distance'];
    if ($distance == 'Anywhere') {
        // total distance of the earth
        $distance = '24902';
    }
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
            'app_id' => "fc6a4020-ead9-45e2-bf54-de19d749f00902681849-4f61-41ba-ad44-9dddca4f2172",
            'filters' => array(array("field" => "tag", "key" => "ID", "relation" => "=", "value" => "$userID")),
            'contents' => $content
        );
		
        
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic ZThlOTdhMmItMzA2OC00NmMwLWEzYTItY2FhYmM1NmVkZmRi'));
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
        
        $secs = floor($seconds % 60);
        $secText = "s ago";
        
        $day = floor($seconds / (3600*24));
        $dayText = "d";

        
        $hours = floor($seconds / 3600);
        $hourText = "h";

        
        
        
        $mins = floor(($seconds - ($hours*3600)) / 60);
        $minText = "min";

        
        if ($hours >= 5) {
            $hours = $hours - 5;
            if ($hours == 0) {
                $hours = "";
                $hourText = "New";
            }
        }
        
        

        $months = floor($seconds / (3600*24*30));
        $monthText = "mo";
        
        
        /* -----------------------
         Display Intervals
         ----------------------*/
        
        if($seconds < 60) {
            $time = $secs. $secText;
        }
            if($seconds < 60*60 ) {
                $time = $mins. $minText;
            }
                else if($seconds < 24*60*60) {
                    $time = $hours. $hourText;
                }
                
                else if($seconds > 24*60*60) {
                    $time = $day. $dayText;
                }
                else if ($seconds > (24*60*60)*(30)*12) {
                    $time = $months. $monthText;
                }
                else {
                        $time = date('D M d Y', $date);
                     }
                return $time;
}
    