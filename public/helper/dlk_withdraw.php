<?php 
require '../includes/config.php';
include_once '../vendor/autoload.php';
include_once '../includes/contract_config.php';

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
	if ($check_limit->num_rows > 5) {$errors = 'Phew... One withdrawal allowed daily!';}

	$check_address = $conn->query("SELECT * FROM dlikeaccounts where username = '$username'");
	$row_add = $check_address->fetch_assoc();$tron_address = $row_add['offchain_address']; 
	$verified = $row_add['verified'];
	if (empty($tron_address)){$errors = 'Phew... You must add your tron wallet address!';}
	if ($verified !='1'){$errors = 'Phew... You must verify your email before withdrawing!';}
    if (empty($errors)) { 
    	$amount = $dlk_amount;$wallet = $tron_address;
    	die(json_encode(['error' => false,'message' => 'All is fine to withdraw!']));
    	/*
    	$addressValidate =  $tron->validateaddress($tron_address);
		if( $addressValidate['result'] == false){die(json_encode(['error' => true,'message' => $addressValidate['message']]));
		}

	    $vSendAmount=$amount; 
	    $abi = json_decode(ABI,true);
	    $vAdminAddress=SIGNER;
	    $vHExAddress=$tron->address2HexString($vAdminAddress);
	    $tron->setAddress($vAdminAddress);
	    $tron->setPrivateKey(SIGNER_PK);

	    $vUserAddress=$wallet;
	    $vHExUser=$tron->address2HexString($vUserAddress);

	    // write contract data
	    $contract = CONTRACT_ADDRESS;
	   
	    $function = 'mintToken';
	    $vSendAmount  = $vSendAmount * 1e6;
	    $params= array($vHExUser, $vSendAmount);
	    $address =  $vHExAddress;
	    $feeLimit = 10000000;
	    $callValue = 0;

	    $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$address,$callValue,$bandwidthLimit = 0);
        $signedTransaction = $tron->signTransaction($triggerContract);
        $response = $tron->sendRawTransaction($signedTransaction);
        if ($response['result'] == 1) {
        	die(json_encode(['error' => false,'message' => 'Withdraw successful!', 'hash' => $triggerContract['txID']]));
        }else{die(json_encode(['error' => true,'message' => 'There is some issue in token withdraw. Please try Later!']));}
		*/
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}
//else {die('Some error');}

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
		if ($update_address === TRUE) {die(json_encode(['error' => false,'message' => 'Address added successfully!']));
		}  else {die(json_encode(['error' => true,'message' => 'There is some issue. please try later!'])); }
	} else {die(json_encode(['error' => true,'message' => $errors]));}
}



if (isset($_POST['action']) && $_POST['action'] == 'paid' && isset($_POST['wallet']) && $_POST['wallet'] != '') {
    $wallet = trim(mysqli_real_escape_string($conn, $_POST['wallet']));
    $trx_id = trim(mysqli_real_escape_string($conn, $_POST['trx_id']));
    $dlk_out_amount = trim(mysqli_real_escape_string($conn, $_POST['dlk_out_amount']));
    $username = $_COOKIE['dlike_username'];

	$check_Bal = $conn->query("SELECT * FROM dlike_wallet WHERE username = '$username'");
	if ($check_Bal->num_rows > 0) { $row = $check_Bal->fetch_assoc();$old_amount = $row['amount'];
		
		$updateWallet = $conn->query("UPDATE dlike_wallet SET amount = '$old_amount' - '$dlk_out_amount' WHERE username = '$username'");

		$add_draw = $conn->query("INSERT INTO dlike_withdrawals (username, amount, tron_address, status, req_on) VALUES ('".$username."', '".$dlk_out_amount."',  '".$wallet."', '".$trx_id."', '".date("Y-m-d H:i:s")."')");
	}
}



if (isset($_POST['action']) && $_POST['action'] == 'pay_user' && isset($_POST['wallet']) && $_POST['wallet'] != '') {
    $wallet = trim(mysqli_real_escape_string($conn, $_POST['wallet']));
    $amount = trim(mysqli_real_escape_string($conn, $_POST['dlk_out_amount']));

	    $vSendAmount=$amount; 
	    $abi = json_decode(ABI,true);
	    $vAdminAddress=SIGNER;
	    $vHExAddress=$tron->address2HexString($vAdminAddress);
	    $tron->setAddress($vAdminAddress);
	    $tron->setPrivateKey(SIGNER_PK);

	    $vUserAddress=$wallet;
	    $vHExUser=$tron->address2HexString($vUserAddress);

	    // write contract data
	    $contract = CONTRACT_ADDRESS;
	   
	    $function = 'multiMintToken';
	    $vSendAmount  = $vSendAmount * 1e6;
	    $params= array($vHExUser, $vSendAmount);
	    $address =  $vHExAddress;
	    $feeLimit = 10000000;
	    $callValue = 0;

	    $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$address,$callValue,$bandwidthLimit = 0);
        $signedTransaction = $tron->signTransaction($triggerContract);
        $response = $tron->sendRawTransaction($signedTransaction);

}
?>