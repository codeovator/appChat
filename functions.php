<?php 
function getArea(){
	$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	$url = "http://freegeoip.net/json/".$ip;
	$ch  = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$data = curl_exec($ch);
	curl_close($ch);

	if ($data) {
		$location = json_decode($data);

		$lat = $location->latitude;
		$lon = $location->longitude;

		mysqli_query($con,"INSERT INTO users (lat, long) VALUES ('".$lat."','".$lon."')");
		return array('latitude'=>$lat,'longitude'=>$lon);
	}	
}

function getAllLoggedUser(){

	$result = mysql_query("SELECT name,gender FROM users where is_online='y'");
	return $result;
}

function saveProfile($user_profile){
	mysqli_query("INSERT INTO users (name, gender,fb_id,is_online) VALUES ('".$user_profile['first_name']."', '".$user_profile['gender']."','".$user_profile['id']."',1)");
}
?>