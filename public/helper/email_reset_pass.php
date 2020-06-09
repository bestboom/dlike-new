<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

if (isset($_POST['reset_email'])  && $_POST['reset_email'] != '') { 

	$reset_email = trim($_POST["reset_email"]);

	if(empty($reset_email)){
        $errors = "Email Shoould not be empty";
    }

    $check_email = "SELECT * FROM dlikeaccounts where email = '$reset_email'";
	$result_email = $conn->query($check_email);
	if ($result_email->num_rows <= 0) {
		$errors = 'Sorry, no user exists with this email';
	}

    if (empty($errors)) {

    	$key = md5(2418*3);
		$addKey = substr(md5(uniqid(rand(),1)),3,50);
		$token = $key . $addKey;
    	//$token = bin2hex(random_bytes(50));

    	$sqlm = "INSERT INTO dlikepasswordreset (email, token, reset_time)
				VALUES ('".$reset_email."', '".$token."', '".date("Y-m-d H:i:s")."')";

		if (mysqli_query($conn, $sqlm)) {

			$mail->isSMTP();
		    $mail->Host = 'smtp.zoho.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = 'noreply@dlike.io';
		    $mail->Password = getenv("EMAIL_PASS");
		    $mail->SMTPSecure = 'tls';
		    $mail->Port = 587;

		    $mail->setFrom('noreply@dlike.io', 'DLIKE');
    		$mail->addAddress($reset_email);

    		$mail->isHTML(true); 
    		$mail->Subject = 'DLIKE Password Reset';
    		$mail->Body    = 'Hi, We got password reset request for your DLIKE account! <br><br> To reset password, visit <a href=\'https://dlike.io/password_reset.php?token='.$token.'\'>this link</a> <br>If you did not requested please ignore this message!<br><br>DLIKE Team<br><a href="https://dlike.io">dlike.io</a>';
			
			$done_email = $mail->send(); 

			if($done_email) { 
				die(json_encode([
			    	'error' => false,
		    		'message' => 'Password reset instructions sent to Email!'
				]));	
			} else {
			    die(json_encode([
		    		'error' => true,
		    		'message' => 'Some Issue in password reset. Please contact support'
				]));
			}
		} else {
		    die(json_encode([
	    		'error' => true,
	    		'message' => 'There is some issue. Please Try later'
			]));
		}
    } else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors
		]));
	}
} else {die('Some error');}

?>