<?php
//header('Content-type: image/jpeg');
	$img_name = 'img_'.rand().'_'.date('ymd_his');
	$ch = curl_init($_REQUEST['img_url']);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $rawdata=curl_exec ($ch);
    curl_close ($ch);

	$fp = fopen('post_images/'.$img_name,'w');
	fwrite($fp, $rawdata); 
	fclose($fp);
	
      // Create Image From Existing File
      $jpg_image = imagecreatefromjpeg('post_images/'.$img_name);


      
      $height = 200;
      $width = 250;
      list($orig_width, $orig_height) = getimagesize('post_images/'.$img_name);
	    $ratio = $orig_width / $orig_height;
	    if ($ratio < 1) {
	        $width = $height * $ratio;
	    } else {
	        $height = $width / $ratio;
	    }
      
        
      // Allocate A Color For The Text
      $white = ImageColorAllocate($jpg_image, 250, 250, 250);

      // Set Path to Font File
      $font_path = 'assets/helvetica_neue-webfont.ttf';

      // Set Text to Be Printed On Image
      $text = $_REQUEST['post_msg'];

      // Print Text On Image
      //imagestring($jpg_image, 865, 229, 290, $text, $white);
      imagettftext($jpg_image, $orig_width/strlen($text), 0, 355, $orig_height/2, $white, $font_path, $text);

      // Send Image to Browser
      imagejpeg($jpg_image, 'post_images/new_'.$img_name);

      // START: resizing image
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresized($new_image, $jpg_image,
        0, 0, 0, 0,
        $width, $height,
        $orig_width, $orig_height);
        
      imagejpeg($new_image, 'post_images/new_'.$img_name);
      // END

      echo 'post_images/new_'.$img_name;
      // Clear Memory
      imagedestroy($jpg_image);
      ?>