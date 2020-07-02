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

    if (empty($errors)) {
    	$dlike_amount = mysqli_real_escape_string($conn, $dlk_amount);
    	$status = '0';
    	$add_draw = "INSERT INTO convert_dlike (steem_username, amount, status, req_on)
						VALUES ('".$username."', '".$dlike_amount."',  '".$status."', '".date("Y-m-d H:i:s")."')";
		//$add_draw_query = $conn->query($add_draw);
		if (mysqli_query($conn, $add_draw)) {

			$checkWallet = "SELECT username, amount FROM wallet WHERE username = '$username'";
			$result = mysqli_query($conn, $checkWallet);

				if ($result->num_rows > 0) {
					$old_amount = $row['amount'];
				}

			die(json_encode([
	    	'error' => false,
    		'message' => 'Request submitted successfully!',
    		'amount' => $old_amount
			]));

		} else {
	    die(json_encode([
    		'error' => true,
    		'message' => 'Some issue in conversion. Please try later!'
		])); }

    } else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors
		]));
	}

}
 //else {die('Some error');}




if (isset($_POST['action'])  && $_POST['action'] == 'eth_con' && isset($_POST['eth_amount'])  && $_POST['eth_amount'] != '') { 

	$eth_amount = trim($_POST["eth_amount"]);

	if(!empty($eth_amount)){
        //$errors = "Please enter valid amount to withdraw";
        $errors = "ETH test Seems working";
    }

    if (empty($errors)) {
    	$email = mysqli_real_escape_string($conn, $dlk_amount);

		$update_pass = "UPDATE dlikeaccoun SET password = '$hashedPW' WHERE email = '$email'";
		$result_update_pass = $conn->query($update_pass);
		if ($result_update_pass === TRUE) {

			$dlike_user_login_url = 'https://dlike.io';

			$deleteuser = "DELETE FROM dlikepassword where email = '$email'";
			$deleteuser_q = $conn->query($deleteuser);

			die(json_encode([
	    	'error' => false,
    		'message' => 'Password Updated Successful!',
    		'redirect' => $dlike_user_login_url
			]));

		} else {
	    die(json_encode([
    		'error' => true,
    		'message' => 'Some issue in password reset. Please try later!'
		])); }

    } else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors
		]));
	}

} 
//else {die('Some error');}

?>