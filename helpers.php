<?php

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
 * Production App ID: 
 * Production Key: 
 */ 
function pushNotification($heading, $message, $userID){
		$content = array(
			"en" => $message
			);
    
		$heading = array(
		    "en" => $heading
		);
		
         $fields = array(
            'app_id' => "02681849-4f61-41ba-ad44-9dddca4f2172",
            'filters' => array(array("field" => "tag", "key" => "ID", "relation" => "=", "value" => "$userID")),
            'contents' => $content,
             'headings' => $heading
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
  
	function notification($senderID, $memberID, $type, $typeID, $message) {
	    $conn = connection();
	    
	    $sql = "INSERT INTO Notifications (Sender_ID, Member_ID, Type, Type_ID, Message, New) 
                Values ('$senderID', '$memberID', '$type', '$typeID', '$message', 1) ";
	    
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

    