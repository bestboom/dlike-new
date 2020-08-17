<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

if (isset($_POST['email_pin_code'])  && $_POST['email_pin_code'] != '') { 

	//$user_email = trim($_POST["user_email"]);
	$username = $_COOKIE['dlike_username'];
	$email_pin_code = trim($_POST["email_pin_code"]);

	//if(empty($user_email)){$errors = "We have Email missing issue";}
    if(empty($email_pin_code)){ $errors = "PIN Should not be empty!";}
    if (empty($errors)) {
		$check_pin = $conn->query("SELECT * FROM dlikeaccounts where username = '$username' and verify_code = '$email_pin_code' ");

		if ($check_pin->num_rows > 0) {$verified = '1';

			$verifyuser = "UPDATE dlikeaccounts SET verified = '$verified' WHERE email = '$user_email'";
				$updateverifyuser = $conn->query($verifyuser);
				if ($updateverifyuser === TRUE) {

					$dlike_user_verify_url = 'https://dlike.io';

		    		die(json_encode(['error' => false,'message' => 'Email Verified Successfully!','redirect' => $dlike_user_verify_url]));
				}else {die(json_encode(['error'=>true,'message'=>'There is some issue in Email Verification!']));}
		} else {die(json_encode(['error' => true,'message' => 'Does not seems to be a valid pin code for this email!'])); }
    } else {die(json_encode(['error' => true,'message' => $errors]));}
} else {die('Some error');}

?>