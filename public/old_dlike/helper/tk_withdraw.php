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
		$tok_eth 	=  $_POST['tok_eth'];
		$tok_type 	=  $_POST['tok_type'];
		if($tok_type == '1'){$tok_type = 'USDT';}else{$tok_type = 'unknown';}
		$paid = '0';

		if($user != $tok_user)
		{
			echo '<div class="alert alert-danger">There is login issue. Please Try Later!</div>';
		}
		if($tok_amt < $min_tip_withdraw)
		{
			echo '<div class="alert alert-danger">Token Amount entered is less than minimum !</div>';
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
						$sqlm = "INSERT INTO TokWithdraw (username, amount, token, eth_addr, paid, with_time)
							VALUES ('".$user."', '".$tok_amt."', '".$tok_type."', '".$tok_eth."', '".$paid."',  now())";

						if (mysqli_query($conn, $sqlm)) {

							$updateTipWallet = "UPDATE TipsWallet SET tip1 = '$tok_bal' - '$tok_amt' WHERE username = '$user'";
							$updateTipWalletQuery = $conn->query($updateTipWallet);
							
							if ($updateTipWalletQuery === TRUE) 
							{
								echo '<div class="alert alert-success">Withdrawl Request Successful!</div>';
								echo '<script>$(".tk_out_btn").attr("disabled","disabled"); document.getElementById("tok_out").reset(); setTimeout(function(){location.reload();},1000);</script>';
							}	
						}
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