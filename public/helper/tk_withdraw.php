<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

	if (isset($_POST["tok_amt"]) && isset($_POST["tok_user"]) && isset($_POST["tok_eth"]) && isset($_POST["tok_type"]))
	{
		$tok_user 	=  $_POST['tok_user'];	
		$user 		=  $_COOKIE['username'];
		$tok_amt 	=  $_POST['tok_amt'];
		$tok_type 	=  $_POST['tok_type'];
		if($tok_type == '1'){$tok_type = 'USDT';}else{$tok_type = 'unknown';}
		$paid = '0';

		if($user != $tok_user)
		{
			echo '<div class="alert alert-danger">There is login issue. Please Try Later!</div>';
		}
		else
		{

			$sqls = "SELECT eth FROM wallet where username='$user'"; 
			$resultAmount = $conn->query($sqls);
			if ($resultAmount->num_rows > 0) 
			{
				$rowIt = $resultAmount->fetch_assoc();
				$user_eth = $rowIt['eth'];

				$sqlT = "SELECT tip1 FROM TipsWallet where username='$user'"; 
				$resultTip = $conn->query($sqlT);

				if ($resultTip->num_rows > 0) 
				{
					$rowT = $resultTip->fetch_assoc();
					$tok_bal = $rowT['tip1'];

					if($tok_amt > $tok_bal)
					{
						echo '<div class="alert alert-danger">Balance is not enough!</div>';
					}
					else 
					{
						echo '<div class="alert alert-success">Looks good!</div>';
					}

				}
				else 
				{
					echo '<div class="alert alert-danger">There is balance issue. Please Try Later!</div>';
				}

				
			} 
			else 
			{
				echo '<div class="alert alert-danger">ETH Address does not exist!</div>';
			}

		}

	}
	else 
	{
		echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
	}
?>