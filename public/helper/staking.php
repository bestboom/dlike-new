<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

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

    if (empty($errors)) {$type = 'stakIn';

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
		//} else {die(json_encode(['error' => true,'message' => 'Some issue in adding stake. Please contact support!'])); }
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}

if (isset($_POST['action'])  && $_POST['action'] == 'unstaking' && isset($_POST['amount'])  && $_POST['amount'] != '') { 

	$unstk_amount = trim(mysqli_real_escape_string($conn, $_POST["amount"]));
	$username = $_COOKIE['dlike_username'];
    $wallet = trim(mysqli_real_escape_string($conn, $_POST["wallet"]));
    $trx_id = trim(mysqli_real_escape_string($conn, $_POST["trx_id"]));

	if(empty($unstk_amount)){
        $errors = "Please enter unstaking amount";
    }

    if (empty($errors)) {$type = 'stakOut';

        $stk_account = $conn->query("SELECT * FROM dlike_staking where username='$username'");
        if ($stk_account->num_rows > 0) {$row_stk = $stk_account->fetch_assoc();$old_amount = $row_stk['amount'];

            $updateStaking = $conn->query("UPDATE dlike_staking SET amount = '$old_amount' - '$unstk_amount', tron_address = '$wallet', tron_trx='$trx_id' WHERE username='$username'");

            $sql_stu = $conn->query("INSERT INTO dlike_staking_transactions (username, amount, tron_address, tron_trx, type, trx_time) VALUES ('".$username."', '".$unstk_amount."', '".$wallet."', '".$trx_id."', '".$type."', now())");

        }
       die(json_encode(['error' => false,'message' => 'Tokens unStaked Successfully.']));
    } else {die(json_encode(['error' => true,'message' => $errors]));}

}


if (isset($_POST['action'])  && $_POST['action'] == 'claim_stake' && isset($_POST['claim_amount'])  && $_POST['claim_amount'] != '') { 

	$claim_amount = trim($_POST["claim_amount"]);
	$username = $_COOKIE['dlike_username'];

	if(empty($claim_amount)){
        $errors = "Not a valid claim amount value";
    }
    if(empty($username)){
        $errors = "Seems You are not login";
    }

    $check_user = $conn->query("SELECT * FROM dlikeaccounts where username = '$username'");
	if ($check_user->num_rows > 0) {$row_C = $check_user->fetch_assoc(); $dlike_user_id=$row_C['id'];}
	else{$errors = "User does not exist!";}

    $check_amount = $conn->query("SELECT reward FROM dlike_staking_rewards where username = '$username'");
    if ($check_amount->num_rows > 0) {$row_A = $check_amount->fetch_assoc();$reward_bal = $row_A['reward'];
		if ($claim_amount > $reward_bal) {$errors = 'Not enough reward balance!';}
	}else{$errors = 'Some issue in reward claiming. Please try later!';}

    if (empty($errors)) {die(json_encode(['error' => false,'id' => $dlike_user_id,'amt' => $claim_amount]));} else {die(json_encode(['error' => true,'message' => $errors]));
	}

}

?>