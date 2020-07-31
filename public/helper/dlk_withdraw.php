<?php 
require '../includes/config.php';

if (isset($_POST['action'])  && $_POST['action'] == 'withdraw' && isset($_POST['dlk_out_amount']) && $_POST['dlk_out_amount'] != '') { 

	$dlk_amount = trim($_POST["dlk_out_amount"]);
	$username = $_COOKIE['dlike_username'];

	if(empty($dlk_amount)){$errors = "Please enter valid amount to withdraw";}
    if(empty($username)){$errors = "Seems You are not login";}
    if ($dlk_amount > $max_withdraw_limit) {$errors = 'Phew... Max allowed amount is 5000 DLIKE per 24 hours';}

    $check_amount = $conn->query("SELECT amount FROM dlike_wallet where username = '$username'");
	$row_A = $check_amount->fetch_assoc();
	$wallet_amount = $row_A['amount'];
	if ($wallet_amount <= 0) {$errors = 'Not enough balance';}
	if ($wallet_amount < $dlk_amount) {$errors = 'Not enough balance';}
	if ($dlk_amount <= 0) {$errors = 'Not valid value';}
	$check_limit = $conn->query("SELECT * FROM dlike_withdrawals where username = '$username' and DATE(req_on) = CURDATE()");
	if ($check_limit->num_rows > 0) {$errors = 'Phew... One withdrawal allowed daily!';}

	$check_address = $conn->query("SELECT * FROM dlikeaccounts where username = '$username'");
	if ($check_address->num_rows > 0) {$row_add = $check_address->fetch_assoc();$tron_address = $row_add['offchain_address']; } else {$errors = 'Phew... You must add your tron wallet address!';}

    if (empty($errors)) { 
    	die(json_encode(['error' => false,'tronaddress' => $tron_address,'amt' => $dlk_amount]));
    	//$status = '0';
    	//$dlike_amount = mysqli_real_escape_string($conn, $dlk_amount);
    	//$add_draw = $conn->query("INSERT INTO dlike_withdrawals (username, amount, status, req_on) VALUES ('".$username."', '".$dlike_amount."', '".$status."', '".date("Y-m-d H:i:s")."')");
		//if ($add_draw) {
			//$checkWallet = $conn->query("SELECT * FROM dlike_wallet WHERE username = '$username'");
				//if ($checkWallet->num_rows > 0) { $row = $checkWallet->fetch_assoc();
				//	$old_amount = $row['amount'];
    			//
				//	$updateWallet = $conn->query("UPDATE dlike_wallet SET amount = '$old_amount' - '$dlike_amount' WHERE username = '$username'");
				//	if ($updateWallet === TRUE) {die(json_encode(['error' => false,'message' => 'Withdrawal Request submitted successfully!']));
				//	}  else {die(json_encode(['error' => true,'message' => 'Some issue in withdrawal. Please try later!'])); 
				//	}
				//}
		//}
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}
//else {die('Some error');}

if (isset($_POST['action']) && $_POST['action'] == 'address' && isset($_POST['offchain_address']) && $_POST['offchain_address'] != '') {
    $offchain_address = trim(mysqli_real_escape_string($conn, $_POST['offchain_address']));
    $username = $_COOKIE['dlike_username'];

	if(empty($offchain_address)){$errors = "Address seems to be empty!";}
    if(empty($username)){$errors = "Seems You are not login";}
    if (empty($errors)) {
		$update_address= $conn->query("UPDATE dlikeaccounts SET offchain_address = '$offchain_address' WHERE username = '$username'");
		if ($update_address === TRUE) {die(json_encode(['error' => false,'message' => 'Address added successfully!']));
		}  else {die(json_encode(['error' => true,'message' => 'There is some issue. please try later!'])); }
	} else {die(json_encode(['error' => true,'message' => $errors]));}
}
?>