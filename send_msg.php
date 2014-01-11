  <?php
   $msg = isset($_REQUEST['msg'])?$_REQUEST['msg']:'';
//   require 'assets/facebook.php';
  require 'assets/connect.php';
//   require 'functions.php';

// // Create our Application instance (replace this with your appId and secret).
//   $facebook = new Facebook(array(
//     'appId'  => '1434847386732269',
//     'secret' => '1c500d02a9a8c52dd1b8fd84546ec172',
//     ));

// // Get User ID
//   $user = $facebook->getUser();

// // We may or may not have this data based on whether the user is logged in.
// //
// // If we have a $user id here, it means we know the user is logged into
// // Facebook, but we don't know if the access token is valid. An access
// // token is invalid if the user logged out of Facebook.

//   if ($user) {
//     try {
//     // Proceed knowing you have a logged in user who's authenticated.
//       $user_profile = $facebook->api('/me');
//     } catch (FacebookApiException $e) {
//       error_log($e);
//       $user = null;
//     }
//   }

// Login or logout url will be needed depending on current user state.
  // if ($user) {
  //   $logoutUrl = $facebook->getLogoutUrl();
  //   saveProfile($user_profile);
  //   $result = getArea($user_profile);
  // } else {
  //   $statusUrl = $facebook->getLoginStatusUrl();
  //   $loginUrl = $facebook->getLoginUrl();
  //   saveProfile('none');
  //   $result = getArea('none');
  // }
  ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>

    <script src="js/jquery.min.js"></script>
    <script src="https://www.google.com/jsapi"></script>
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
    <script type="text/javascript">

      google.load('search', '1');

      var imageSearch;

      function addPaginationLinks() {

          // To paginate search results, use the cursor function.
          var cursor = imageSearch.cursor;
          var curPage = cursor.currentPageIndex; // check what page the app is on
          var pagesDiv = document.createElement('div');
          for (var i = 0; i < cursor.pages.length; i++) {
            var page = cursor.pages[i];
            if (curPage == i) { 

            // If we are on the current page, then don't make a link.
            var label = document.createTextNode(' ' + page.label + ' ');
            pagesDiv.appendChild(label);
          } else {

              // Create links to other pages using gotoPage() on the searcher.
              var link = document.createElement('a');
              link.href="/image-search/v1/javascript:imageSearch.gotoPage("+i+');';
              link.innerHTML = page.label;
              link.style.marginRight = '2px';
              pagesDiv.appendChild(link);
            }
          }

          var contentDiv = document.getElementById('content');
          contentDiv.appendChild(pagesDiv);
        }

        function searchComplete() {

          // Check that we got results
          if (imageSearch.results && imageSearch.results.length > 0) {

            // Grab our content div, clear it.
            var contentDiv = document.getElementById('content');
            contentDiv.innerHTML = '';

            // Loop through our results, printing them to the page.
            var results = imageSearch.results;
            var i = 0;
            //for (var i = 0; i < results.length; i++) {
              // For each result write it's title and image to the screen
              var result = results[i]; //alert(result.url);
              var imgContainer = document.createElement('div');
              var title = document.createElement('div');
              
              // We use titleNoFormatting so that no HTML tags are left in the 
              // title
              title.innerHTML = result.titleNoFormatting;
              var newImg = document.createElement('img');

              // There is also a result.url property which has the escaped version
              var img_path = result.url;
              newImg.src=img_path;//"/image-search/v1/result.tbUrl;"
              //imgContainer.appendChild(title);
              //imgContainer.appendChild(newImg);
              $.ajax({
                type: "POST",
                url: "write_image.php",
                data: { img_url: img_path, img_name: result.titleNoFormatting, post_msg: "<?php echo $msg; ?>"}
              }).done(function(data) {
                $('#dashboard').show();
                $('#latest_img').attr('src', data);
              });

              // Put our title + image in the content
              contentDiv.appendChild(imgContainer);
            //}

            // Now add links to additional pages of search results.
            addPaginationLinks(imageSearch);
          }
        }

        function OnLoad() {

          // Create an Image Search instance.
          imageSearch = new google.search.ImageSearch();

          imageSearch.setRestriction(
            google.search.ImageSearch.RESTRICT_IMAGESIZE,
            google.search.ImageSearch.IMAGESIZE_SMALL);

          imageSearch.setRestriction(
            google.search.ImageSearch.RESTRICT_FILETYPE,
            google.search.ImageSearch.FILETYPE_JPG
            );

          // Set searchComplete as the callback function when a search is 
          // complete.  The imageSearch object will have results in it.
          imageSearch.setSearchCompleteCallback(this, searchComplete, null);

          // Find me a beautiful car.
          imageSearch.execute("<?php echo $msg; ?>");
          
          // Include the required Google branding
          google.search.Search.getBranding('branding');
        }
        google.setOnLoadCallback(OnLoad);
      </script>

    </head>
    <body style="font-family: Arial;border: 0 none;">
    <div id="branding"  style="float: left;display:none"></div><br />
      <div id="content" style="display:none">Loading...</div>
      <section id="dashboard" style="margin-top: -5%;">
        <div class="content">
          <ul>
            <li><img src="" id="latest_img" class="allimg" /></li>
            <?php 
        //get all images
            $res = mysql_query("select picture from conversation where picture is not null order by id desc");
            while($row = mysql_fetch_array($res)){
              //echo '=='.$row['picture'];
              if(file_exists($row['picture'])){
            ?>
            <li><img src="<?php echo $row['picture']; ?>" class="allimg" /></li>
            <?php
              }
            }
            ?>
            <li><img src="post_images/img_1174025557_140111_050523" class="allimg" /></li>
            <li><img src="post_images/new_img_942533377_140111_062406" class="allimg"/></li>
            <li><img src="post_images/new_img_1321478248_140111_010628"/></li>
            <li><img src="post_images/new_img_610419253_140111_010711"/></li> 
          </ul>
        </div>
      </section>
    </body>
    </html>