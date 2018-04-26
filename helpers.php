<?php

function getDistance($id) {
    $conn = connection();
    
    $sql = "SELECT Distance FROM MemberPref WHERE Member_ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $distance = $row['Distance'];
    return $distance;
}

function pushNotification($appId, $content, $key, $tag, $title){
		$content = array(
			"en" => $content
			);
		
        
        $filters = array("field" => "tag", "key" => $key, "relation" => "=", "value" => $tag);
    
		$fields = array(
      "app_id" => '02681849-4f61-41ba-ad44-9dddca4f2172',
      "filters" => $filters,
      "contents" => $content,
	  "icon" => "http://api.flickpitch.com/logo.png",
      "title" => $title
    );
		
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NzQzNzRmMjYtMDE2MC00YjYzLWE3NTAtOWU3NzdmMDcyYTlk'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
        
      /*$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
	print("\n\nJSON received:\n");
	print($return);
	print("\n"); 
     */
	}
    
    function calculate_time_span($date){
    $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($date);

        $months = floor($seconds / (3600*24*30));
        $day = floor($seconds / (3600*24));
        
        if ($day == "1") {
            $dayText = " day ago";
        }
        else {
            $dayText = " days ago";
        }
        
        $hours = floor($seconds / 3600);
        
        if ($hours == "1") {
            $hourText = " hour ago";
        }
        else {
            $hourText = " hours ago";
        }
        
        $mins = floor(($seconds - ($hours*3600)) / 60);
        
        if ($mins == "1") {
            $minText = " minute ago";
        }
        else {
            $minText = " minutes ago";
        }
        
        $secs = floor($seconds % 60);
        if ($secs == "1") {
            $secText = " second ago";
        }
        else {
            $secText = " seconds ago";
        }
        
        /* -----------------------
        Display Intervals
        ----------------------*/
        
        if($seconds < 60)
            $time = $secs. $secText;
        
        else if($seconds < 60*60 )
            $time = $mins. $minText;
            
            else if($seconds < 24*60*60) {
                $time = $hours. $hourText;
            }
           
        else if($seconds < 24*60*60)
            $time = $day. $dayText;
            
        else
            $time = $months." month ago";
            
        return $time;
}
    