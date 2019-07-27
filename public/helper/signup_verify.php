<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

if (isset($_POST["phone_number"]))

{
	$phone =  $_POST['phone_number'];

	$check_phone = "SELECT * FROM wallet where phone_number = '$phone''";
	$result_phone = $conn->query($check_phone);

	if ($result_phone->num_rows > 0) 
	{
		//do twilio curl
	}
	else 
	{
		echo '<div class="alert alert-danger">Phone Number Already in use</div>';
	}

}

?>