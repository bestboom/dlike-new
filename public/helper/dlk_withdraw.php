<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

if (isset($_POST['dlk_out_amount'])  && $_POST['dlk_out_amount'] != '') { 

	$dlk_amount = trim($_POST["dlk_out_amount"]);
	$username = $_COOKIE['dlike_username'];

	if(empty($dlk_amount)){
        $errors = "Please enter valid amount to withdraw";
    }
    if(empty($username)){
        $errors = "Seems You are not login";
    }

    $check_amount = $conn->query("SELECT amount FROM dlike_wallet where username = '$username'");
	$row_A = $check_amount->fetch_assoc();
	$wallet_amount = $row_A['amount'];
	if ($wallet_amount <= 0) {
		$errors = 'Not enough balance';
	}
	if ($wallet_amount < $dlk_amount) {
		$errors = 'Not enough balance';
	}
	if ($dlk_amount <= 0) {
		$errors = 'Not valid value';
	}
	//check last withdraw here
    if (empty($errors)) {
    	$dlike_amount = mysqli_real_escape_string($conn, $dlk_amount);
    	$status = '0';
    	$add_draw = $conn->query("INSERT INTO dlike_withdrawals (username, amount, status, req_on) VALUES ('".$username."', '".$dlike_amount."', '".$status."', '".date("Y-m-d H:i:s")."')");
		if ($add_draw) {

			$checkWallet = $conn->query("SELECT * FROM dlike_wallet WHERE username = '$username'");
				if ($checkWallet->num_rows > 0) {
					$row = $checkWallet->fetch_assoc();
					$old_amount = $row['amount'];

					$updateWallet = $conn->query("UPDATE dlike_wallet SET amount = '$old_amount' - '$dlike_amount' WHERE username = '$username'");
					if ($updateWallet === TRUE) {
						die(json_encode([
				    	'error' => false,
			    		'message' => 'Withdrawal Request submitted successfully!'
						]));
					}  else {
					    die(json_encode([
				    		'error' => true,
				    		'message' => 'Some issue in withdrawal. Please try later!'
						])); 
					}
				}
		}
    } else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors
		]));
	}

}
else {die('Some error');}
?>