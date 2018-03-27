<?php

function getDistance($id) {
    $conn = connection();
    
    $sql = "SELECT Distance FROM MemberPref WHERE Member_ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $distance = $row['Distance'];
    return $distance;
}

function sendMessage($appId, $content, $key, $tag, $title){
		/*$content = array(
			"en" => 'English Message'
			);
		*/
        
        $filters = array("field" => "tag", "key" => $key, "relation" => "=", "value" => $tag);
    
		$fields = array(
      "app_id" => $appId,
      "filters" => $filters,
      "contents" => $content,
      "title" => $title
    );
		
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'));
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

        $day = floor($seconds / (3600*24));
        $hours = floor(($seconds / 3600)/2);
        $mins = floor(($seconds - ($hours*3600)) / 60);

if($seconds < 3600)
            $time = $mins." min ago";
        else if($seconds < 86400)
            $time = $hours." hours ago";
        else 
            $time = $day." day ago";


       

        return $time;
} 
    
    