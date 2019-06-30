<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

if (isset($_POST["pro_user"]))
{
	$user = $_POST["pro_user"];
	$amount = '10000';

	$sqls = "SELECT amount FROM wallet where username='$user'"; 
	$resultAmount = $conn->query($sqls);
		$rowIt = $resultAmount->fetch_assoc();	
		$user_bal = $rowIt['amount'];

	if ($amount > $user_bal)
	{ 
		echo '<div class="alert alert-danger">You do not have enough tokens!</div>';
	}
	else 
	{
		$sqlm = "INSERT INTO prousers (username, amount, buy_time)
					VALUES ('".$user."', '".$amount."', now())";

		if (mysqli_query($conn, $sqlm))
		{
			echo '<div class="alert alert-success">Looks Good</div>';
		}
	}

} else {echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';}

?>