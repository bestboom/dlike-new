<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo 'coment';

if (isset($_POST["post_permlink"]) && isset($_POST["post_author"])){

	echo $_POST["post_permlink"];
	echo '<br>';
	echo $_POST["post_author"];
 	echo '<br>';
 	echo $_POST["cmt_body"];
} else {die('Some error');}
?>