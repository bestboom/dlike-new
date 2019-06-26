<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

if (isset($_POST["stakemaount"]) && isset($_POST["stake_option"]) && isset($_POST["staker"])){

	$amount = $_POST["stakemaount"];
	$period = $_POST["stake_option"];
	$user = $_POST["staker"];
	$reason = 'Staking';
	$sqls = "SELECT amount FROM wallet where username='$user'"; 
	$resultAmount = $conn->query($sqls);
		if ($resultAmount->num_rows > 0) {
				$rowIt = $resultAmount->fetch_assoc();	
				$user_bal = $rowIt['amount'];
			if ($amount > $user_bal){ echo '<div class="alert alert-danger">You do not have enough tokens!</div>';}
			else {

				$sqlm = "INSERT INTO staking (username, amount, period, start_time)
					VALUES ('".$user."', '".$amount."', '".$period."', now())";

				if (mysqli_query($conn, $sqlm)) {

					$updateWallet = "UPDATE wallet SET amount = '$user_bal' - '$amount' WHERE username = '$user'";
						$updateWalletQuery = $conn->query($updateWallet);
									if ($updateWalletQuery === TRUE) {
										$sqlj = "INSERT INTO transactions (username, amount, reason)
											VALUES ('".$user."', '".$amount."', '".$reason."')";
											if (mysqli_query($conn, $sqlj)) {

											echo '<div class="alert alert-success">Staking done successfully</div>';
											echo '<script>$("#stake_me").attr("disabled","disabled"); document.getElementById("stake_sub").reset(); setTimeout(function(){location.reload();},1000);</script>';
											}
									} 
				}
			}
		} else {echo '<div class="alert alert-danger">Do not have token balance!</div>';}



} else {echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';}

?>