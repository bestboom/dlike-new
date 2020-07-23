<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

if (isset($_POST['action'])  && $_POST['action'] == 'staking' && isset($_POST['amount'])  && $_POST['amount'] != '') { 

	$stk_amount = trim($_POST["amount"]);
	$username = $_COOKIE['dlike_username'];

	if(empty($stk_amount)){
        $errors = "Please enter staking amount";
    }
    if(empty($username)){
        $errors = "Seems You are not login";
    }
    if (empty($errors)) {
    	$check_user = $conn->query("SELECT * FROM dlikeaccounts where username = '$username'");
		if ($check_user->num_rows > 0) {$row_C = $check_user->fetch_assoc(); $dlike_user_id=$row_C['id'];
    		die(json_encode(['error' => false,'id' => $dlike_user_id,'dlikeuser' => $username]));
		} else {die(json_encode(['error' => true,'message' => 'Seems issue in account!'])); }
    } else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors
		]));
	}

}

if (isset($_POST['action'])  && $_POST['action'] == 'unstaking' && isset($_POST['unstake_amount'])  && $_POST['unstake_amount'] != '') { 

	$unstk_amount = trim($_POST["unstake_amount"]);
	$username = $_COOKIE['dlike_username'];

	if(empty($unstk_amount)){
        $errors = "Please enter unstaking amount";
    }
    if(empty($username)){
        $errors = "Seems You are not login";
    }
    $check_user = $conn->query("SELECT * FROM dlikeaccounts where username = '$username'");
	if ($check_user->num_rows > 0) {$row_C = $check_user->fetch_assoc(); $dlike_user_id=$row_C['id'];}
	else{$errors = "User does not exist!";}
    //$check_amount = $conn->query("SELECT amount FROM dlike_staking where user_id = '$dlike_user_id'");
	//$row_A = $check_amount->fetch_assoc();$staked_amount = $row_A['amount'];
	//if ($unstk_amount > $staked_amount) {$errors = 'Not enough staked!';}

    if (empty($errors)) {die(json_encode(['error' => false,'id' => $dlike_user_id,'amt' => $unstk_amount]));} else {die(json_encode(['error' => true,'message' => $errors]));
	}

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