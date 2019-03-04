<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_COOKIE['access_token'])){
echo $myval = $_COOKIE['access_token']);
	}

if (isset($_POST["post_permlink"]) && isset($_POST["post_author"])){

	//echo $_POST["user_at"];
	echo 'okkkkkkkkkkkkkkk';
	echo $_POST["post_permlink"];
	echo '<br>';
	echo $_POST["post_author"];
 	echo '<br>';
 	echo $_POST["cmt_body"];
 	echo '<br>';
	echo $_POST["cmt_author"];
 	echo '<br>';
 	echo $_POST["cmt_permlink"];
} else {die('Some error');}
?>