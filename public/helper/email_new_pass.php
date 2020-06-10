<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

if (isset($_POST['reset_pass'])  && $_POST['reset_pass'] != '' && isset($_POST['confirm_reset_pass'])  && $_POST['confirm_reset_pass'] != '' && isset($_POST['reset_email'])  && $_POST['reset_email'] != '') { 

	$reset_pass = trim($_POST["reset_pass"]);
	$confirm_reset_pass = trim($_POST["confirm_reset_pass"]);
	$reset_email = trim($_POST["reset_email"]);

	if(empty($reset_pass)){
        $errors = "Password Shoould not be empty";
    }
    if(empty($confirm_reset_pass)){
        $errors = "Confirm Password Shoould not be empty";
    }
    if($confirm_reset_pass != $reset_pass){
        $errors = "Both Passwords do nto match";
    }

    if (empty($errors)) {
    	$email = mysqli_real_escape_string($conn, $reset_email);
    	$newPW = mysqli_real_escape_string($conn, $reset_pass);
		$escapedPWN = md5($newPW);
		$hashedPW = hash('sha256', $escapedPWN);

		$update_pass = "UPDATE dlikeaccounts SET password = '$hashedPW' WHERE email = '$email'";
		$result_update_pass = $conn->query($update_pass);
		if ($result_update_pass === TRUE) {

			$dlike_user_login_url = 'https://dlike.io';

			$deleteuser = "DELETE FROM dlikepasswordreset where email = '$email'";
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

} else {die('Some error');}

?>