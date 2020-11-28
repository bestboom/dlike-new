<?php 
require '../includes/config.php';
include_once '../vendor/autoload.php';
include_once '../includes/contract_config.php';

if (isset($_POST['action'])  && $_POST['action'] == 'withdraw' && isset($_POST['dlk_out_amount']) && $_POST['dlk_out_amount'] != '') { 
	$dlk_amount = trim($_POST["dlk_out_amount"]);
	$username = $_COOKIE['dlike_username'];
	$admin_users = array('dlike_airdrop','dlike_dao','dlike_foundation','dlike_team','dlike_charity');

	if(empty($dlk_amount)){$errors = "Please enter valid amount to withdraw";}
    if(empty($username)){$errors = "Seems You are not login";}
    if(!in_array($username, $admin_users)){if ($dlk_amount > $max_withdraw_limit) {$errors = 'Phew...Max allowed amount is 5000 DLIKE per 24 hours';}}

    $check_amount = $conn->query("SELECT * FROM dlike_wallet where username = '$username'");
	$row_A = $check_amount->fetch_assoc(); $wallet_amount = $row_A['amount'];$user_wallet_add = $row_A['tron_address'];
	if ($wallet_amount <= 0) {$errors = 'Not enough balance';}
	if ($wallet_amount < $dlk_amount) {$errors = 'Not enough balance';}
	if ($dlk_amount <= 0) {$errors = 'Not valid value';}
	if ($dlk_amount < 5) {$errors = 'Minimum amount to withdraw is 5 DLIKE';}
	$check_limit = $conn->query("SELECT * FROM dlike_withdrawals where username = '$username' and DATE(req_on) = CURDATE()");
	if ($check_limit->num_rows > 0) {$errors = 'Phew... One withdrawal allowed daily!';} else{$withdraw="more than one withdrawals done!";}

	$check_address = $conn->query("SELECT * FROM dlikeaccounts where username = '$username'");
	$row_add = $check_address->fetch_assoc();$tron_address = $row_add['offchain_address']; 
	$verified = $row_add['verified'];
	if (empty($tron_address)){$errors = 'Phew... You must add your tron wallet address!';}
	if ($verified !='1'){$errors = 'Phew... You must verify your email before withdrawing!';}
    if (empty($errors)) { 
    	die(json_encode(['error' => false,'message' => 'All is fine to withdraw!','user_wallet_add' => $user_wallet_add]));
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}



if (isset($_POST['action']) && $_POST['action'] == 'address' && isset($_POST['offchain_address']) && $_POST['offchain_address'] != '') {
    $offchain_address = trim(mysqli_real_escape_string($conn, $_POST['offchain_address']));
    $username = $_COOKIE['dlike_username'];

	if(empty($offchain_address)){$errors = "Address seems to be empty!";}
    if(empty($username)){$errors = "Seems You are not login";}

    $unique_address = $conn->query("SELECT * FROM dlikeaccounts where offchain_address = '$offchain_address'");
	if ($unique_address->num_rows > 0) {$errors = 'Phew... Address already in use by some other account!';}
    if (empty($errors)) {

    	$addressValidate =  $tron->validateaddress($offchain_address);
		if( $addressValidate['result'] == false){die(json_encode(['error' => true,'message' => 'Not a valid Tron address '.$addressValidate['message']]));}

		$update_address= $conn->query("UPDATE dlikeaccounts SET offchain_address = '$offchain_address' WHERE username = '$username'");
		if ($update_address === TRUE) {
			$update_wallet= $conn->query("UPDATE dlike_wallet SET tron_address = '$offchain_address' WHERE username = '$username'");
			die(json_encode(['error' => false,'message' => 'Address added successfully!']));
		}  else {die(json_encode(['error' => true,'message' => 'There is some issue. please try later!'])); }
	} else {die(json_encode(['error' => true,'message' => $errors]));}
}



if (isset($_POST['action']) && $_POST['action'] == 'paid' && isset($_POST['wallet']) && $_POST['wallet'] != '') {
    $wallet = trim(mysqli_real_escape_string($conn, $_POST['wallet']));
    $trx_id = trim(mysqli_real_escape_string($conn, $_POST['trx_id']));
    $dlk_out_amount = trim(mysqli_real_escape_string($conn, $_POST['dlk_out_amount']));
    $username = $_COOKIE['dlike_username'];
    $pay_status="1";

    
    //$update_map = $conn->query("UPDATE dlike_tokens_mapping SET status = '$pay_status' WHERE username = '$username' and amount='$dlk_out_amount'");

    $update_dlkw = $conn->query("UPDATE dlike_withdrawals SET status = '$trx_id' WHERE username = '$username' and amount='$dlk_out_amount'");
    
	//$check_Bal = $conn->query("SELECT * FROM dlike_wallet WHERE username = '$username'");
	//if ($check_Bal->num_rows > 0) { $row = $check_Bal->fetch_assoc();$old_amount = $row['amount'];
		
	//$updateWallet = $conn->query("UPDATE dlike_wallet SET amount = '$old_amount' - '$dlk_out_amount' WHERE username = '$username'");
    	
    //$add_draw = $conn->query("INSERT INTO dlike_withdrawals (username, amount, tron_address, status, req_on) VALUES ('".$username."', '".$dlk_out_amount."',  '".$wallet."', '".$trx_id."', '".date("Y-m-d H:i:s")."')");
		
	//}
}



if (isset($_POST['action']) && $_POST['action'] == 'pay_user' && isset($_POST['wallet']) && $_POST['wallet'] != '') {
    $user_wallet = trim(mysqli_real_escape_string($conn, $_POST['wallet']));
    $dlkamount = trim(mysqli_real_escape_string($conn, $_POST['dlk_out_amount']));

    $username = $_COOKIE['dlike_username'];
    $check_Bal = $conn->query("SELECT * FROM dlike_wallet WHERE username = '$username'");
	if ($check_Bal->num_rows > 0) { $row = $check_Bal->fetch_assoc();$bal= $row['amount'];$wallet= $row['tron_address'];
		if($bal > 0){
			$check_map = $conn->query("SELECT * FROM dlike_tokens_mapping WHERE username = '$username' and  update_time > now() - INTERVAL 24 HOUR");
			if ($check_map->num_rows > 0) { die(json_encode(['error' => true,'message' => 'Withdraw time issue']));
			}else{

				$amount = $dlkamount * 1000000;
		    	$wallets = array($tron->address2HexString($wallet));
		    	$amounts = array($amount);
		    	$abi = json_decode(ABI,true);

		    	$vAdminAddress=SIGNER;
		    	$vHExAddress=$tron->address2HexString($vAdminAddress);
		    	$tron->setAddress($vAdminAddress);
		    	$tron->setPrivateKey(SIGNER_PK);

		    	$contract = CONTRACT_ADDRESS;
		    	$function = 'payToken';

		    	$params = array($wallets , $amounts );
		    	$address =  $vHExAddress;
		    	$feeLimit = 1000000000;
		    	$callValue = 0;
		       
		        $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$address,$callValue ,$bandwidthLimit = 0);
		        $signedTransaction = $tron->signTransaction($triggerContract);
		        $response = $tron->sendRawTransaction($signedTransaction);
		        if ($response['result'] == 1) {

		        	$status="0";
		        	$sql_cur = $conn->query("INSERT INTO dlike_tokens_mapping (username, tron_address, amount, status, update_time) VALUES ('".$username."', '".$wallet."', '".$dlkamount."', '".$status."', now())");

		        	$updateWallet = $conn->query("UPDATE dlike_wallet SET amount = '$bal' - '$dlkamount' WHERE username = '$username'");

		        	$add_draw = $conn->query("INSERT INTO dlike_withdrawals (username, amount, tron_address, status, req_on) VALUES ('".$username."', '".$dlkamount."',  '".$wallet."', '".$status."', '".date("Y-m-d H:i:s")."')");

		            die(json_encode(['error' => false,'message' => 'All is fine to withdraw!']));
		        }else{die(json_encode(['error' => true,'message' => $e->getMessage()]));}
		    }
	    }
    }
}

?>