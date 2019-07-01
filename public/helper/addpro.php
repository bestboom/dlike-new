<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

if (isset($_POST["pro_user"]))
{
	$user = $_POST["pro_user"];
	$amount = '10000';
	$pro_status = '3';
	$set_by = 'Paid';
	$reason = 'PRO Membership';

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

			$updateWallet = "UPDATE wallet SET amount = '$user_bal' - '$amount' WHERE username = '$user'";
				$updateWalletQuery = $conn->query($updateWallet);
									if ($updateWalletQuery === TRUE) 
									{
										$sqlj = "INSERT INTO transactions (username, amount, reason)
											VALUES ('".$user."', '".$amount."', '".$reason."')";

											if (mysqli_query($conn, $sqlj)) 
											{

												$sqlu = "SELECT * FROM userstatus where username='$user'"; 
												$resultu = $conn->query($sqlu);

												if($resultu->num_rows > 0)
												{
													$updat_u = "UPDATE userstatus SET status = '$pro_status', set_by = '$set_by' WHERE username = '$user'";
													$updateUserQuery = $conn->query($updat_u);
													if ($updateUserQuery === TRUE) {}
												} 
												else 
												{
													$adduserstatus = "INSERT INTO userstatus (`username`, `status`  , `set_by` , `set_time` )
														VALUES ('".$user."', '".$pro_status."', '".$set_by."', now())";
													$adduserstatusQuery = $conn->query($adduserstatus);		
												}

												echo '<div class="alert alert-success">PRO status Added</div>';
												echo '<script>$(".pro-bt").attr("disabled","disabled"); document.getElementById("pro_sub").reset(); setTimeout(function(){location.reload();},2000);</script>';
											}
									}

		}
	}

} else {echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';}

?>