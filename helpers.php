<?php
define("ProfileMediaPath", "http://api.statuz.net/api/media/");
define("StatusMediaPath", "http://api.statuz.net/api/flicks/");
define("CommentMediaPath", "http://api.statuz.net/api/comments/");

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
            'app_id' => "aee090c8-a009-40fb-96ac-9ab277eedfdd",
            'filters' => array(array("field" => "tag", "key" => "ID", "relation" => "=", "value" => "$userID")),
            'contents' => $content,
             'headings' => $heading
        );
		
        
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NmZkMTk4NWYtMDE0OC00YmZmLWIyNmEtNmY4NmQyOTM5MmU3'));
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

function checkFilter($id) {
    $conn = connection();
    
    $sql = "SELECT FilterStatuses FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $isFiltered = $row['FilterStatuses'];
    
    if ($isFiltered == 'true') {
        // total distance of the earth
        $filterQuery = "
        And ((s.Status NOT Like 'nigga%'))
        And ((s.Status NOT Like 'nigger%'))
        And ((s.Status NOT Like 'coon%'))
        And ((s.Status NOT Like 'spic%'))
        And ((s.Status NOT Like 'chink%'))
        And ((s.Status NOT Like 'fag%'))
        And ((s.Status NOT Like 'faggot%'))
        And ((s.Status NOT Like '%piss%'))
        And ((s.Status NOT Like 'shit%'))
        And ((s.Status NOT Like '%bullshit%'))
        And ((s.Status NOT Like 'cocksucker%'))
        And ((s.Status NOT Like '%fucking%'))
        And ((s.Status NOT Like '%bust a nut%'))
        And ((s.Status NOT Like '%cum%'))
        And ((s.Status NOT Like 'asshole%'))
        And ((s.Status NOT Like '%fuck%'))
        And ((s.Status NOT Like '%bitch%'))
        And ((s.Status NOT Like '%bitches%'))
        And ((s.Status NOT Like BINARY '%dick%'))
        And ((s.Status NOT Like 'dick%'))
        And ((s.Status NOT Like '%cunt%'))
        And ((s.Status NOT Like '%fingered%'))
        And ((s.Status NOT Like '%clit%'))
        And ((s.Status NOT Like '%fingering%'))
        And ((s.Status NOT Like '%pussy%'))
        And ((s.Status NOT Like '%pussies%'))
        And ((s.Status NOT Like 'hoe%'))
        And ((s.Status NOT Like 'whore%'))
        And ((s.Status NOT Like '%fucking%'))";
    }
    else { ""; }
    
    return $filterQuery;
}

function checkCommentFilter($id) {
    $conn = connection();
    
    $sql = "SELECT FilterStatuses FROM Members WHERE ID = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $isFiltered = $row['FilterStatuses'];
    
    if ($isFiltered == 'true') {
        // total distance of the earth
        $filterQuery = "
        And ((c.Comment NOT Like 'nigga%'))
        And ((c.Comment NOT Like 'nigger%'))
        And ((c.Comment NOT Like 'coon%'))
        And ((c.Comment NOT Like 'spic%'))
        And ((c.Comment NOT Like 'chink%'))
        And ((c.Comment NOT Like 'fag%'))
        And ((c.Comment NOT Like 'faggot%'))
        And ((c.Comment NOT Like '%piss%'))
        And ((c.Comment NOT Like 'shit%'))
        And ((c.Comment NOT Like '%bullshit%'))
        And ((c.Comment NOT Like 'cocksucker%'))
        And ((c.Comment NOT Like '%fucking%'))
        And ((c.Comment NOT Like '%bust a nut%'))
        And ((c.Comment NOT Like '%cum%'))
        And ((c.Comment NOT Like 'asshole%'))
        And ((c.Comment NOT Like '%fuck%'))
        And ((c.Comment NOT Like '%bitch%'))
        And ((c.Comment NOT Like '%bitches%'))
        And ((c.Comment NOT Like BINARY '%dick%'))
        And ((c.Comment NOT Like 'dick%'))
        And ((c.Comment NOT Like '%cunt%'))
        And ((c.Comment NOT Like '%fingered%'))
        And ((c.Comment NOT Like '%clit%'))
        And ((c.Comment NOT Like '%fingering%'))
        And ((c.Comment NOT Like '%pussy%'))
        And ((c.Comment NOT Like '%pussies%'))
        And ((c.Comment NOT Like 'hoe%'))
        And ((c.Comment NOT Like 'whore%'))
        And ((c.Comment NOT Like '%fucking%'))";
    }
    else { ""; }
    
    return $filterQuery;
}
    