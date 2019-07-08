<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

	if (isset($_POST["tok_amt"]) && isset($_POST["tok_user"]) && isset($_POST["tok_eth"]))
	{
		echo $tok_user =  $_POST['tok_user'];	
		echo $user =  $_COOKIE['username'];
		echo $tok_amt =  $_POST['tok_amt'];

	}
	else 
	{
		echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
	}
?>