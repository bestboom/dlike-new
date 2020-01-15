<?php 
require '../includes/config.php';
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


if (isset($_POST["user"]) && isset($_POST["amount"]) && isset($_POST["reason"])){

	$username = $_POST["user"];
	$amount = $_POST["amount"];
	$reason = stripslashes($_POST["reason"]);


	$sqlm = "INSERT INTO transactions (username, amount, reason)
			VALUES ('".$username."', '".$amount."', '".$reason."')";

			if (mysqli_query($conn, $sqlm)) {

				$checkWallet = "SELECT username, amount FROM wallet WHERE username = '$username'";
					$result = mysqli_query($conn, $checkWallet);

					if ($result->num_rows > 0) {

						while($row = $result->fetch_assoc()) {
							$old_amount = $row['amount'];

							$updateWallet = "UPDATE wallet SET amount = '$old_amount' + '$amount' WHERE username = '$username'";
								$updateWalletQuery = $conn->query($updateWallet);
									if ($updateWalletQuery === TRUE) {} 
						}

					} else {

						$addWallet = "INSERT INTO wallet (username, amount)
													VALUES ('".$username."', '".$amount."')";
										$addWalletQuery = $conn->query($addWallet);
					}
			echo '<div class="alert alert-success">Added Successfully!</div>';
    		echo '<script>document.getElementById("toksubmit").reset(); setTimeout(function(){location.reload();}, 1000);</script>';
			}
} else {echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';}

?>