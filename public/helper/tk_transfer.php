<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

	if (isset($_POST["reciever"]) && isset($_POST["send_amt"]) && isset($_POST["user_bal"]) && isset($_POST["user_name"]))
	{
		echo $reciever = $_POST["reciever"];
		echo '<div class="alert alert-success">Looks Good</div>';
	}
	else 
	{
		echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
	}

?>