<?php 
function getArea($user_profile){
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

		// if($user_profile=="none"){
		// 	$sql = "UPDATE users SET lat=".$lat." AND long=".$lon." WHERE id=".$user_profile["id"];
		// 	mysql_query($sql);
		// }else{
		// 	$sql = "UPDATE users SET lat=".$lat." AND long=".$lon." WHERE fb_id=".$user_profile["id"];
		// 	mysql_query($sql);
		// }

		// mysql_query("INSERT INTO users (lat, long) VALUES ('".$lat."','".$lon."')");
		return array('latitude'=>$lat,'longitude'=>$lon);
	}	
}

function getAllLoggedUser(){

	$result = mysql_query("SELECT * FROM users where is_online='y'");
	return $result;
}

function saveProfile($user_profile){
	if($user_profile=="none"){
		$result = getArea();
		mysql_query("INSERT INTO users (name,lat,long,is_online) VALUES ('guest','".$result['latitude']."','".$result['longitude']."','y')");
	}else{
		$result = mysql_query("SELECT fb_id FROM users where fb_id='".$user_profile['id']."'");
		if(!$result){
			$result = getArea();
			mysql_query("INSERT INTO users (name, gender,lat,long,fb_id,is_online) VALUES ('".$user_profile['first_name']."', '".$user_profile['gender']."','".$result['latitude']."','".$result['longitude']."','".$user_profile['id']."','y')");
		}
	}
}
?>