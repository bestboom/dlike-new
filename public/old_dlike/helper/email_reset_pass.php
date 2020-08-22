<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__ . '/../../vendor/autoload.php';
	require '../includes/config.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;	

	require '../helper/mailer/src/Exception.php';
	require '../helper/mailer/src/PHPMailer.php';
	require '../helper/mailer/src/SMTP.php';

	$mail = new PHPMailer();

if (isset($_POST['reset_email'])  && $_POST['reset_email'] != '') { 

	$reset_email = trim($_POST["reset_email"]);
	if(empty($reset_email)){$errors = "Email Shoould not be empty";}

    $check_email = $conn->query("SELECT * FROM dlikeaccounts where email = '$reset_email'");
	if ($check_email->num_rows <= 0) {$errors = 'Sorry, no user exists with this email';}

    if (empty($errors)) {

    	$key = md5(2418*3);
		$addKey = substr(md5(uniqid(rand(),1)),3,50);
		$token = $key . $addKey;

    	$sqlm = "INSERT INTO dlikepasswordreset (email, token, reset_time)
				VALUES ('".$reset_email."', '".$token."', '".date("Y-m-d H:i:s")."')";

		if (mysqli_query($conn, $sqlm)) {

			$mail->isSMTP();
		    $mail->Host = 'smtp.zoho.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = 'no_reply@dlike.io';
		    $mail->Password = getenv("EMAIL_PASS");
		    $mail->SMTPSecure = 'tls';
		    $mail->Port = 587;

		    $mail->setFrom('no_reply@dlike.io', 'DLIKE');
    		$mail->addAddress($reset_email);

    		$mail->isHTML(true); 
    		$mail->Subject = 'DLIKE Password Reset';
    		$mail->Body    = 'Hi, We got password reset request for your DLIKE account! <br><br> To reset password, visit <a href=\'https://dlike.io/password_reset.php?token='.$token.'&email='.$reset_email.'\'>this link</a> <br>If you did not requested please ignore this message!<br><br>DLIKE Team<br><a href="https://dlike.io">dlike.io</a>';
			
			$done_email = $mail->send(); 

			if($done_email) {die(json_encode(['error' => false,'message' => 'Password reset instructions sent to Email!']));	
			} else {die(json_encode(['error' => true,'message' => 'Some Issue in password reset. Please contact support']));
			}
		} else {die(json_encode(['error' => true,'message' => 'There is some issue. Please Try later']));}
    } else { die(json_encode(['error' => true,'message' => $errors]));}
} else {die('Some error');}
?>