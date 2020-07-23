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

    if (empty($errors)) {die(json_encode(['error' => false,'id' => $dlike_user_id,'staked_amt' => $unstk_amount]));} else {die(json_encode(['error' => true,'message' => $errors]));
	}

}
 //else {die('Some error');}
?>
<!--
if (isset($_POST['action'])  && $_POST['action'] == 'eth_con' && isset($_POST['eth_amount'])  && $_POST['eth_amount'] != '' && isset($_POST['steem_addr'])  && $_POST['steem_addr'] != '') { 

	$eth_amount = trim($_POST["eth_amount"]);
	$steem_addr = trim($_POST["steem_addr"]);
	$eth_addr = trim($_POST["eth_addr"]);
	$earn_method = trim($_POST["earn_method"]);
	if(empty($steem_addr)){
        $errors = "Please enter steem username";
        //$errors = "ETH test Seems working";
    }

    if (empty($errors)) {
    	$eth_amount = mysqli_real_escape_string($conn, $eth_amount);
    	$steem_addr = mysqli_real_escape_string($conn, $steem_addr);
    	$earn_method = mysqli_real_escape_string($conn, $earn_method);
    	$eth_addr = mysqli_real_escape_string($conn, $eth_addr);

    	$status = '0';
    	$type = '1';
    	$add_eth_draw = "INSERT INTO convert_dlike (steem_username, amount, eth_add, earned_by, status, type, req_on)
						VALUES ('".$steem_addr."', '".$eth_amount."', '".$eth_addr."', '".$earn_method."', '".$status."', '".$type."', '".date("Y-m-d H:i:s")."')";
		//$add_draw_query = $conn->query($add_draw);
		if (mysqli_query($conn, $add_eth_draw)) {

			die(json_encode([
	    	'error' => false,
    		'message' => 'Request submitted successfully!'
			]));
		}  else {
		    die(json_encode([
	    	'error' => true,
	    	'message' => 'Some issue in conversion. Please try later!'
			])); 
		}
    } else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors
		]));
	}
} 
//else {die('Some error');}


if (isset($_POST['action'])  && $_POST['action'] == 'pay_con' && isset($_POST['conv_id'])  && $_POST['conv_id'] != '') { 
	$conv_id = trim($_POST["conv_id"]);
	if(empty($conv_id)){
        $errors = "Id is empty";
        //$errors = "conv test Seems working";
    }

    if (empty($errors)) {
    	$conv_id = mysqli_real_escape_string($conn, $conv_id);

    	$status = '1';

    	$updateCon = "UPDATE convert_dlike SET status = '$status' WHERE id = '$conv_id'";
			$updateConQuery = $conn->query($updateCon);
			if ($updateConQuery === TRUE) {
				$checkuser = "SELECT steem_username, amount FROM convert_dlike WHERE id = '$conv_id'";
					$result = mysqli_query($conn, $checkuser);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						$bal_amount = $row['amount'];
						$user = $row['steem_username'];
						$reason = "Converted to DLIKER";
						$sqlm_trx = "INSERT INTO transactions (username, amount, reason)
							VALUES ('".$user."', '".$bal_amount."', '".$reason."')";

						if (mysqli_query($conn, $sqlm_trx)) {
							die(json_encode([
							'error' => false,
							'message' => 'Payment upated successfully!'
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

?>