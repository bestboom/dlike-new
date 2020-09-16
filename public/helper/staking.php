<?php 
require '../includes/config.php';
include_once '../vendor/autoload.php';
include_once '../includes/contract_config.php';
if (isset($_POST['action'])  && $_POST['action'] == 'staking' && isset($_POST['amount'])  && $_POST['amount'] != '') { 

	$stk_amount = trim(mysqli_real_escape_string($conn, $_POST["amount"]));
	$username = $_COOKIE['dlike_username'];
    $wallet = trim(mysqli_real_escape_string($conn, $_POST["wallet"]));
    $trx_id = trim(mysqli_real_escape_string($conn, $_POST["trx_id"]));
    $tron_decimals = '1000000';
    $stk_amount = $stk_amount/$tron_decimals;
	if(empty($stk_amount)){ $errors = "Please enter staking amount";}
    if(empty($username)){$errors = "Seems You are not login";}
    if(empty($wallet)){ $errors = "Wallet address error. Please contact support";}
    if(empty($trx_id)){ $errors = "TRX ID error. Please contact support";}

    if (empty($errors)) {$type = 'stakeIn';

        $stk_account = $conn->query("SELECT * FROM dlike_staking where username='$username'");
        if ($stk_account->num_rows > 0) {$row_stk = $stk_account->fetch_assoc();$old_amount = $row_stk['amount'];

            $updateStaking = $conn->query("UPDATE dlike_staking SET amount = '$old_amount' + '$stk_amount', tron_address = '$wallet', tron_trx='$trx_id' WHERE username='$username'");

            $sql_stu = $conn->query("INSERT INTO dlike_staking_transactions (username, amount, tron_address, tron_trx, type, trx_time) VALUES ('".$username."', '".$stk_amount."', '".$wallet."', '".$trx_id."', '".$type."', now())");

        } else {$rew_amt = '0';
            $sql_s = $conn->query("INSERT INTO dlike_staking (username, amount, tron_address, tron_trx, trx_time) VALUES ('".$username."', '".$stk_amount."', '".$wallet."', '".$trx_id."', now())");
            
            $sql_sw = $conn->query("INSERT INTO dlike_staking_rewards (username, reward, tron_address) VALUES ('".$username."', '".$rew_amt."', '".$wallet."')");

            $sql_st = $conn->query("INSERT INTO dlike_staking_transactions (username, amount, tron_address, tron_trx, type, trx_time) VALUES ('".$username."', '".$stk_amount."', '".$wallet."', '".$trx_id."', '".$type."', now())");
        }
	   die(json_encode(['error' => false,'message' => 'WOW! Tokens staked Successfully.']));
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}

if (isset($_POST['action']) && $_POST['action']=='unstaking' && isset($_POST['amount']) && $_POST['amount'] !='') { 

	$unstk_amount = trim(mysqli_real_escape_string($conn, $_POST["amount"]));
	$username = $_COOKIE['dlike_username'];
    $wallet = trim(mysqli_real_escape_string($conn, $_POST["wallet"]));
    $trx_id = trim(mysqli_real_escape_string($conn, $_POST["trx_id"]));
    $tron_decimals = '1000000';
    $unstk_amount = $unstk_amount/$tron_decimals;
	if(empty($unstk_amount)){$errors = "Please enter unstaking amount";}

    if (empty($errors)) {$type = 'stakeOut';
        $stk_account = $conn->query("SELECT * FROM dlike_staking where username='$username'");
        if ($stk_account->num_rows > 0) {$row_stk=$stk_account->fetch_assoc();$old_amount = $row_stk['amount'];

            $updateStaking = $conn->query("UPDATE dlike_staking SET amount = '$old_amount' - '$unstk_amount', tron_address = '$wallet', tron_trx='$trx_id' WHERE username='$username'");

            $sql_stu = $conn->query("INSERT INTO dlike_staking_transactions (username, amount, tron_address, tron_trx, type, trx_time) VALUES ('".$username."', '".$unstk_amount."', '".$wallet."', '".$trx_id."', '".$type."', now())");
        }
       die(json_encode(['error' => false,'message' => 'Tokens unStaked Successfully.']));
    } else {die(json_encode(['error' => true,'message' => $errors]));}

}


if (isset($_POST['action'])  && $_POST['action'] == 'claim_stake' && isset($_POST['claim_amount'])  && $_POST['claim_amount'] != '') { 

	$claim_amount = trim($_POST["claim_amount"]);
	$username = $_COOKIE['dlike_username'];

	if(empty($claim_amount)){$errors = "Not a valid claim amount value";}
    if(empty($username)){$errors = "Seems You are not login";}

    $check_user = $conn->query("SELECT * FROM dlikeaccounts where username = '$username'");
	if ($check_user->num_rows > 0) {$row_C = $check_user->fetch_assoc(); $dlike_user_id=$row_C['id'];$verified = $row_C['verified'];
        if ($verified !='1'){$errors = 'Phew... You must verify your email before withdrawing!';}
    }else{$errors = "User does not exist!";}

    $check_amount = $conn->query("SELECT reward FROM dlike_staking_rewards where username = '$username'");
    if ($check_amount->num_rows > 0) {$row_A = $check_amount->fetch_assoc();$reward_bal = $row_A['reward'];
		if ($claim_amount > $reward_bal) {$errors = 'Not enough reward balance!';}
        if ($reward_bal <= 0) {$errors = 'Not enough balance';}
        if ($claim_amount <= 0) {$errors = 'Not valid value';}
	}else{$errors = 'Some issue in reward claiming. Please try later!';}


    if (empty($errors)) {die(json_encode(['error' => false,'message' => 'All is fine to withdraw!']));
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}


if (isset($_POST['action']) && $_POST['action'] == 'pay_staking_reward' && isset($_POST['wallet']) && $_POST['wallet'] != '') {
    $wallet = trim(mysqli_real_escape_string($conn, $_POST['wallet']));
    $out_amount = trim(mysqli_real_escape_string($conn, $_POST['claim_amount']));

    $username = $_COOKIE['dlike_username'];
    $check_Bal = $conn->query("SELECT * FROM dlike_staking_rewards WHERE username = '$username'");
    if ($check_Bal->num_rows > 0) { $row = $check_Bal->fetch_assoc();$bal= $row['reward'];
        if($bal > 0){
            $check_map = $conn->query("SELECT * FROM dlike_rewards_mapping WHERE username = '$username' and  update_time > now() - INTERVAL 24 HOUR");
            if ($check_map->num_rows > 0) { die(json_encode(['error' => true,'message' => 'Mapping update issue']));
            }else{
                $amount = $bal * 1000000;
                $wallets = array($tron->address2HexString($wallet));
                $amounts = array($amount);
                $abi = json_decode(ABI,true);

                $vAdminAddress=SIGNER;
                $vHExAddress=$tron->address2HexString($vAdminAddress);
                $tron->setAddress($vAdminAddress);
                $tron->setPrivateKey(SIGNER_PK);

                $contract = CONTRACT_ADDRESS;
                $function = 'payReward';

                $params = array($wallets , $amounts);
                $address =  $vHExAddress;
                $feeLimit = 1000000000;
                $callValue = 0;

                $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$address,$callValue ,$bandwidthLimit = 0);
                $signedTransaction = $tron->signTransaction($triggerContract);
                $response = $tron->sendRawTransaction($signedTransaction);
                if ($response['result'] == 1) {$status="0";
                    $sql_cur = $conn->query("INSERT INTO dlike_rewards_mapping (username, tron_address, amount, status, update_time) VALUES ('".$username."', '".$wallet."', '".$out_amount."', '".$status."', now())");
                die(json_encode(['error' => false,'message' => 'All is fine to withdraw!']));
                }else{die(json_encode(['error' => true,'message' => $e->getMessage()]));}
            }
        }
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'reward_paid' && isset($_POST['wallet']) && $_POST['wallet'] != '') {
    $wallet = trim(mysqli_real_escape_string($conn, $_POST['wallet']));
    $trx_id = trim(mysqli_real_escape_string($conn, $_POST['trx_id']));
    $claim_amount = trim(mysqli_real_escape_string($conn, $_POST['amount']));
    $username = $_COOKIE['dlike_username'];
    $tron_decimals = '1000000';
    $amount = $claim_amount/$tron_decimals;
    $type='Reward';
    $check_Bal = $conn->query("SELECT * FROM dlike_staking_rewards WHERE username = '$username'");
    if ($check_Bal->num_rows > 0) { $row = $check_Bal->fetch_assoc();$old_amount = $row['reward'];
        
        $updateWallet = $conn->query("UPDATE dlike_staking_rewards SET reward = '$old_amount' - '$amount' WHERE username = '$username'");

        $sql_st = $conn->query("INSERT INTO dlike_staking_transactions (username, amount, tron_address, tron_trx, type, trx_time) VALUES ('".$username."', '".$amount."', '".$wallet."', '".$trx_id."', '".$type."', now())");
    }
}
?>