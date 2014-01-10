<?php

$host = "cyclops.cgpfeputg7xh.us-east-1.rds.amazonaws.com";
$username =  'cyclops';
$password = 'testtest1234';
$db="chatlas";
mysql_connect($host,$username,$password) or die('not able to connect');
mysql_select_db($db) or die('not able to connect to db');
?>