<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

	if (isset($_POST["reciever"]) && isset($_POST["send_amt"]) && isset($_POST["user_bal"]) && isset($_POST["user_name"]))
	{
		$reciever = $_POST["reciever"];
		$amount = $_POST["send_amt"];
		$total_bal = $_POST["user_bal"];
		$user = $_POST["user_name"];
		$reason = "Transfer To ".$reciever."";

		$sqlR = "SELECT amount FROM wallet where username='$reciever'";
		$resultR = $conn->query($sqlR);
		$rowR = $resultR->fetch_assoc();
		$reciever_bal = $rowR['amount'];

		if($amount < 10) { echo '<div class="alert alert-danger">Minimum amount to transfer is 10 DLIKE!</div>'; die();}
		else{
			$sqls = "SELECT amount FROM wallet where username='$user'"; 
			$resultAmount = $conn->query($sqls);

			if ($resultAmount->num_rows > 0) {
					$rowIt = $resultAmount->fetch_assoc();	
					$user_bal = $rowIt['amount'];

				if ($amount > $user_bal){ echo '<div class="alert alert-danger">You do not have enough tokens!</div>'; die();}
				else 
				{
					$updateWallet = "UPDATE wallet SET amount = '$user_bal' - '$amount' WHERE username = '$user'";
					$updateWalletQuery = $conn->query($updateWallet);

						if ($updateWalletQuery === TRUE) 
						{
							$sqlD = "SELECT amount FROM wallet where username='$reciever'"; 
							$resultD = $conn->query($sqlD);

								if ($resultD->num_rows > 0) {

									$updateRec = "UPDATE wallet SET amount = '$reciever_bal' + '$amount' WHERE username = '$reciever'";
									$updateRecQuery = $conn->query($updateRec);
			
								}
								else
								{
									$sqln = "INSERT INTO WALLET (username, amount)
											VALUES ('".$reciever."', '".$amount."')";
									$addNewWallet = $conn->query($sqln);
								}


							$sqlj = "INSERT INTO transactions (username, amount, reason, receiver)
										VALUES ('".$user."', '".$amount."', '".$reason."', '".$reciever."')";

								if (mysqli_query($conn, $sqlj)) {

									echo '<div class="alert alert-success">Transfer Successful</div>';
									echo '<script>$(".tsf_btn").attr("disabled","disabled"); document.getElementById("tsf_sub").reset(); setTimeout(function(){location.reload();},2000);</script>';
								}
						}
				}
			}
		}
	}
	else 
	{
		echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
	}

?>