<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo 'coment';

if (isset($_POST["permlink"]) && isset($_POST["author"])){

	echo $_POST["permlink"];
	echo '<br>';
	echo $_POST["author"];
 echo 'good';
}
?>