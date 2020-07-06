<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

if (isset($_POST['action'])  && $_POST['action'] == 'dlike_con' && isset($_POST['dlk_amount'])  && $_POST['dlk_amount'] != '') { 

	$dlk_amount = trim($_POST["dlk_amount"]);
	$username = $_COOKIE['username'];

	if(empty($dlk_amount)){
        $errors = "Please enter valid amount to withdraw";
    }
    if(empty($username)){
        $errors = "Seems You are not login";
    }

    $check_amount = "SELECT amount FROM wallet where username = '$username'";
	$validate_amount = $conn->query($check_amount);
	$row_A = $validate_amount->fetch_assoc();
	$wallet_amount = $row_A['amount'];
	if ($wallet_amount <= 0) {
		$errors = 'Not enough balance';
	}
    if (empty($errors)) {
    	$dlike_amount = mysqli_real_escape_string($conn, $dlk_amount);
    	$status = '0';
    	$type = '0';
    	$add_draw = "INSERT INTO convert_dlike (steem_username, amount, status, type, req_on)
						VALUES ('".$username."', '".$dlike_amount."', '".$status."', '".$type."', '".date("Y-m-d H:i:s")."')";
		//$add_draw_query = $conn->query($add_draw);
		if (mysqli_query($conn, $add_draw)) {

			$checkWallet = "SELECT username, amount FROM wallet WHERE username = '$username'";
			$result = mysqli_query($conn, $checkWallet);

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$old_amount = $row['amount'];


					$updateWallet = "UPDATE wallet SET amount = '$old_amount' - '$dlike_amount' WHERE username = '$username'";
					$updateWalletQuery = $conn->query($updateWallet);
					if ($updateWalletQuery === TRUE) {

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
				}
		}
    } else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors
		]));
	}

}
 //else {die('Some error');}


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