<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo  myCode = $.cookie("access_token");

echo 'coment';

if (isset($_POST["post_permlink"]) && isset($_POST["post_author"])){

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