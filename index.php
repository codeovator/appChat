<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the Licenssdfe is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require 'assets/facebook.php';
require 'assets/connect.php';
require 'functions.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
	'appId'  => '1434847386732269',
	'secret' => '1c500d02a9a8c52dd1b8fd84546ec172',
	));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
	try {
    // Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	} catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	}
}

// Login or logout url will be needed depending on current user state.
if ($user) {
	$logoutUrl = $facebook->getLogoutUrl();
	saveProfile($user_profile);
	$result = getArea($user_profile);
} else {
	$statusUrl = $facebook->getLoginStatusUrl();
	$loginUrl = $facebook->getLoginUrl();
	saveProfile('none');
	$result = getArea('none');
}

// This call will always work since we are fetching public data.
// $naitik = $facebook->api('/naitik');
?>
<!DOCTYPE HTML>
<!--
	Overflow 1.1 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
	<title>chatlas</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,300italic" rel="stylesheet" type="text/css" />
	<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
	<script src="js/jquery.min.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false" 
	type="text/javascript"></script>
	<script src="js/jquery.poptrox.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/init.js"></script>
	<script src="js/functions.js"></script>
	<noscript>
		<link rel="stylesheet" href="css/skel-noscript.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="http://refaktorthemes.com/other/sites/default/files/css/css_TADBuXPPmrbFPyk6hDkPf84uFQkeNTvGKIQWxMUpw28.css" />
	</noscript>
	<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
</head>
<body>
	<input type="hidden" value="<?php echo $user?'1':'0';?>" id="is_fb_logged"/>

	<!-- Header -->
	<section id="header">
		<header>
			<img class="logo" src="images/logo_chat.png"/>
			<h1 class="logo-title"><span class="chat">chat</span><span class="atlas">las</span></h1>
			<p>BANG in Your Name</p>
			<input type="text" name="user-name" id="user-name" class="textbox"/>
		</header>
		<footer>
			<a href="#banner" id="start-chat" class="button style2 scrolly scrolly-centered">SMACK IN</a>
		</footer>
	</section>


	<!-- Banner -->
	<section id="banner">
		<header>
			<!-- <h2>It's Me</h2> -->
		</header>
		<?php if ($user): ?>
			<?php if($user_profile['gender']=="female"){?>
			<div class="4u">
				<span class="me image image-full profile-section"><img src="images/girl.png" alt=""></span>
			</div>
			<?php }else{?>
			<div class="4u">
				<span class="me image image-full profile-section"><img src="images/boy.png" alt=""></span>
			</div>
			<?php }?>
			<span class="badge">
				<p>Howdy, <?php echo strtoupper($user_profile['first_name']);?></p>
			</span>
		<?php else: ?>
			<div class="4u">
				<span class="me image image-full profile-section"><img src="images/sex-icon.png" alt=""></span>
			</div>
			<span class="badge">
				<p class="my-name"></p>
			</span>
		<?php endif;?>
		<footer>
			<a href="#first" id="start-map" class="button style2 scrolly">Checkout buddies near your location...</a>
		</footer>
	</section>

	<!-- Banner -->
	<section id="map">
		<!-- <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $result['latitude'];?>,<?php echo $result['longitude'];?>&zoom=20&size=200x200&sensor=false"> -->
		<div id="map-div" style="width: 500px; height: 400px;"></div>
		<footer>
			<a href="#first" id="start-chatroom" class="button style2 scrolly">Start IMAGECHAT</a>
		</footer>
	</section>

	<!-- Banner -->
	<section id="chatroom">
	<form method="post" action="send_msg.php" id="setmsg">
		<header>
			<div id="image-dashboard"></div>
			<p>Set Message</p>
			<input type="text" name="msg" id="user-message" class="textbox"/>
		</header>
		<footer>
			<a href="#banner" id="ping" class="button style2 scrolly scrolly-centered">POST IT</a>
		</footer>
		</form>
	</section>


	<section id="dashboard">
		<div class="content">
			<ul>
			<?php 
				//get all images
			?>
			<li><img src="http://refaktorthemes.com/other/sites/default/files/1.jpg"/></li>
			</ul>
		</div>
	</section>

	<section id="footer">
		<?php if ($user): ?>

			<ul class="icons">
				<li>Hi <?php echo $user_profile['first_name'];?></li>
				<li><a href="<?php echo $logoutUrl; ?>">Logout</a></li>
			</ul>
		<?php else: ?>
			
			<ul class="icons" style="background:#35619E;">
				<!-- <li><a href="#" class="fa fa-twitter solo"><span>Twitter</span></a></li>
				<li><a href="<?php echo $loginUrl;?>" id="fb-login" class="fa fa-facebook solo"><span>Facebook</span></a></li>
				<li><a href="#" class="fa fa-google-plus solo"><span>Google+</span></a></li>
				<li><a href="#" class="fa fa-pinterest solo"><span>Pinterest</span></a></li>
				<li><a href="#" class="fa fa-dribbble solo"><span>Dribbble</span></a></li>
				<li><a href="#" class="fa fa-linkedin solo"><span>LinkedIn</span></a></li> -->
				<li><a href="<?php echo $loginUrl;?>" id="fb-login" class="fb">Dive in with FACEBOOK</a></li>
			</ul>
		<?php  endif;?>
			<!-- <div class="copyright">
				<ul class="menu">
					<li>&copy; Untitled. All rights reserved.</li>
					<li>Design: <a href="http://html5up.net/">HTML5 UP</a></li>
					<li>Demo Images: <a href="http://ineedchemicalx.deviantart.com">Felicia Simion</a></li>
				</ul>
			</div> -->
		</section>
		<?php include('map.php'); ?>
</body>
</html>