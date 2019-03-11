<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

if (isset($_POST["name"]) && isset($_POST["amount"]) && isset($_POST["reason"])){

	echo $username = $_POST["name"];
	echo $amount = $_POST["amount"];
	echo $reason = stripslashes($_POST["reason"]);




}

?>