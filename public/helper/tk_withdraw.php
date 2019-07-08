<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

	if (isset($_POST["tok_amt"]) && isset($_POST["tok_user"]) && isset($_POST["tok_eth"]))
	{
		 $tok_user =  $_POST['tok_user'];	
		echo $user =  $_COOKIE['username'];
		echo $tok_amt =  $_POST['tok_amt'];

		if($user != $tok_user)
		{
			echo '<div class="alert alert-danger">There is login issue. Please Try Later!</div>';
		}
		else
		{

			$sqls = "SELECT * FROM wallet where username='$user'"; 
			$resultAmount = $conn->query($sqls);
			if ($resultAmount->num_rows > 0) 
			{
				$rowIt = $resultAmount->fetch_assoc();	
				$user_bal = $rowIt['amount'];
				$user_eth = $rowIt['eth'];
				$user_bal = $rowIt['amount'];
			} 
			else 
			{
				echo '<div class="alert alert-danger">User Does not exist!</div>';
			}

		}

	}
	else 
	{
		echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
	}
?>