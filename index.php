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
} else {
	$statusUrl = $facebook->getLoginStatusUrl();
	$loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
// $naitik = $facebook->api('/naitik');
?>
<?php $result = getArea();?>
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
			<a href="#first" id="start-chatroom" class="button style2 scrolly">Go to CHATROOM</a>
		</footer>
	</section>

	<section id="article">
		
		<!-- Feature 1 -->
		<article id="first" class="container box style1 right">
			<a href="http://ineedchemicalx.deviantart.com/art/Time-goes-by-too-fast-335982438" class="image full"><img src="images/pic01.jpg" alt="" /></a>
			<div class="inner">
				<header>
					<h2>Lorem ipsum<br />
						dolor sit amet</h2>
					</header>
					<p>Tortor faucibus ullamcorper nec tempus purus sed penatibus. Lacinia pellentesque eleifend vitae est elit tristique velit tempus etiam.</p>
				</div>
			</article>

			<!-- Feature 2 -->
			<article class="container box style1 left">
				<a href="http://ineedchemicalx.deviantart.com/art/Kingdom-of-the-Wind-348268044" class="image full"><img src="images/pic02.jpg" alt="" /></a>
				<div class="inner">
					<header>
						<h2>Mollis posuere<br />
							lectus lacus</h2>
						</header>
						<p>Rhoncus mattis egestas sed fusce sodales rutrum et etiam ullamcorper. Etiam egestas scelerisque ac duis magna lorem ipsum dolor.</p>
					</div>
				</article>

				<!-- Portfolio -->
				<article class="container box style2">
					<header>
						<h2>Magnis parturient</h2>
						<p>Justo phasellus et aenean dignissim<br />
							placerat cubilia purus lectus.</p>
						</header>
						<div class="inner gallery">
							<div class="row flush">
								<div class="3u"><a href="images/fulls/01.jpg" class="image full"><img src="images/thumbs/01.jpg" alt="" title="Ad infinitum" /></a></div>
								<div class="3u"><a href="images/fulls/02.jpg" class="image full"><img src="images/thumbs/02.jpg" alt="" title="Dressed in Clarity" /></a></div>
								<div class="3u"><a href="images/fulls/03.jpg" class="image full"><img src="images/thumbs/03.jpg" alt="" title="Raven" /></a></div>
								<div class="3u"><a href="images/fulls/04.jpg" class="image full"><img src="images/thumbs/04.jpg" alt="" title="I'll have a cup of Disneyland, please" /></a></div>
							</div>
							<div class="row flush">
								<div class="3u"><a href="images/fulls/05.jpg" class="image full"><img src="images/thumbs/05.jpg" alt="" title="Cherish" /></a></div>
								<div class="3u"><a href="images/fulls/06.jpg" class="image full"><img src="images/thumbs/06.jpg" alt="" title="Different." /></a></div>
								<div class="3u"><a href="images/fulls/07.jpg" class="image full"><img src="images/thumbs/07.jpg" alt="" title="History was made here" /></a></div>
								<div class="3u"><a href="images/fulls/08.jpg" class="image full"><img src="images/thumbs/08.jpg" alt="" title="People come and go and walk away" /></a></div>
							</div>
						</div>
					</article>

					<!-- Contact -->
					<article class="container box style3">
						<header>
							<h2>Nisl sed ultricies</h2>
							<p>Diam dignissim lectus eu ornare volutpat orci.</p>
						</header>
						<form>
							<div class="row half">
								<div class="6u"><input type="text" class="text" name="name" placeholder="Name" /></div>
								<div class="6u"><input type="text" class="text" name="email" placeholder="Email" /></div>
							</div>
							<div class="row half">
								<div class="12u">
									<textarea name="message" placeholder="Message"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="12u">
									<ul class="actions">
										<li><a href="#" class="button form">Send Message</a></li>
									</ul>
								</div>
							</div>
						</form>
					</article>

					<!-- Generic -->
		<!--
			<article class="container box style3">
				<header>
					<h2>Generic Box</h2>
					<p>Just a generic box. Nothing to see here.</p>
				</header>
				<section>
					<header>
						<h3>Paragraph</h3>
						<p>This is a byline</p>
					</header>
					<p>Phasellus nisl nisl, varius id <sup>porttitor sed pellentesque</sup> ac orci. Pellentesque 
					habitant <strong>strong</strong> tristique <b>bold</b> et netus <i>italic</i> malesuada <em>emphasized</em> ac turpis egestas. Morbi 
					leo suscipit ut. Praesent <sub>id turpis vitae</sub> turpis pretium ultricies. Vestibulum sit 
					amet risus elit.</p>
				</section>
				<section>
					<header>
						<h3>Blockquote</h3>
					</header>
					<blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget.
					tempus euismod. Vestibulum ante ipsum primis in faucibus.</blockquote>
				</section>
				<section>
					<header>
						<h3>Divider</h3>
					</header>
					<p>Donec consectetur <a href="#">vestibulum dolor et pulvinar</a>. Etiam vel felis enim, at viverra 
					ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel. Praesent nec orci 
					facilisis leo magna. Cras sit amet urna eros, id egestas urna. Quisque aliquam 
					tempus euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices 
					posuere cubilia.</p>
					<hr />
					<p>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra 
					ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel. Praesent nec orci 
					facilisis leo magna. Cras sit amet urna eros, id egestas urna. Quisque aliquam 
					tempus euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices 
					posuere cubilia.</p>
				</section>
				<section>
					<header>
						<h3>Unordered List</h3>
					</header>
					<ul class="default">
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
					</ul>
				</section>
				<section>
					<header>
						<h3>Ordered List</h3>
					</header>
					<ol class="default">
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
					</ol>
				</section>
				<section>
					<header>
						<h3>Table</h3>
					</header>
					<div class="table-wrapper">
						<table class="default">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Description</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>45815</td>
									<td>Something</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>29.99</td>
								</tr>
								<tr>
									<td>24524</td>
									<td>Nothing</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>19.99</td>
								</tr>
								<tr>
									<td>45815</td>
									<td>Something</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>29.99</td>
								</tr>
								<tr>
									<td>24524</td>
									<td>Nothing</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>19.99</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3"></td>
									<td>100.00</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</section>
				<section>
					<header>
						<h3>Form</h3>
					</header>
					<form method="post" action="#">
						<div class="row">
							<div class="6u">
								<input class="text" type="text" name="name" id="name" value="" placeholder="John Doe" />
							</div>
							<div class="6u">
								<input class="text" type="text" name="email" id="email" value="" placeholder="johndoe@domain.tld" />
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<select name="department" id="department">
									<option value="">Choose a department</option>
									<option value="1">Manufacturing</option>
									<option value="2">Administration</option>
									<option value="3">Support</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<input class="text" type="text" name="subject" id="subject" value="" placeholder="Enter your subject" />
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<textarea name="message" id="message" placeholder="Enter your message"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<ul class="actions">
									<li><a href="#" class="button form">Submit</a></li>
									<li><a href="#" class="button style3 form-reset">Clear Form</a></li>
								</ul>
							</div>
						</div>
					</form>
				</section>
			</article>
		-->
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