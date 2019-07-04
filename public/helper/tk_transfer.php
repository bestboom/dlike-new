<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

	if (isset($_POST["reciever"]) && isset($_POST["send_amt"]) && isset($_POST["user_bal"]) && isset($_POST["user_name"]))
	{
		echo $reciever = $_POST["reciever"];
		echo $amount = $_POST["send_amt"];
		echo $total_bal = $_POST["user_bal"];
		echo $user = $_POST["user_name"];

		$sqls = "SELECT amount FROM wallet where username='$user'"; 
		$resultAmount = $conn->query($sqls);
		if ($resultAmount->num_rows > 0) {
				$rowIt = $resultAmount->fetch_assoc();	
				$user_bal = $rowIt['amount'];
			if ($amount > $user_bal){ echo '<div class="alert alert-danger">You do not have enough tokens!</div>';}
			else 
			{
				echo '<div class="alert alert-success">Looks Good</div>';
			}
		}
	}
	else 
	{
		echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
	}

?>