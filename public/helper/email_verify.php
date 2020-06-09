<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

if (isset($_POST['email_pin_code'])  && $_POST['email_pin_code'] != '' && isset($_POST['user_email'])  && $_POST['user_email'] != '') { 

	$user_email = trim($_POST["user_email"]);
	$email_pin_code = trim($_POST["email_pin_code"]);

	if(empty($user_email)){
        $errors = "We have Email missing issue";
    }
    if(empty($email_pin_code)){
        $errors = "PIN Should not be empty!";
    }
    if (empty($errors)) {

		$check_pin = "SELECT * FROM dlikeaccounts where email = '$user_email' and verify_code = '$email_pin_code' ";
		$result_pin = $conn->query($check_pin);

		if ($result_pin->num_rows > 0) {




			
			$dlike_user_login_url = 'https://dlike.io';
    		die(json_encode([
	    	'error' => false,
    		'message' => 'Login Successful!',
    		'redirect' => $dlike_user_login_url,
    		'dlikeuser' => $login_username
			]));
		} else {
	    die(json_encode([
    		'error' => true,
    		'message' => 'Login details does not match!'
		])); }
    } else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors
		]));
	}
} else {die('Some error');}

?>