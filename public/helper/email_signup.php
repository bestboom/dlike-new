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

if (isset($_POST['action']) && $_POST['action'] == 'signup' && isset($_POST['signup_email'])  && $_POST['signup_email'] != '' && isset($_POST['signup_username'])  && $_POST['signup_username'] != '' && isset($_POST['signup_pass'])  && $_POST['signup_pass'] != '')
{
	$signup_username = trim($_POST["signup_username"]);
	$signup_email = trim($_POST["signup_email"]);
	$signup_password = trim($_POST["signup_pass"]);
	$refer_by = $_POST["signup_refer_by"];
	$loct_ip = $_POST['signup_loct_ip'];
	$company_name = 'dlike';
	$not_allowed_username = ["dlike", "dliker", "dlikedex", "fuck", "steem", "steemit"];
    $check_dlike_name = stripos($signup_username, $company_name);
    $g_token=$_POST["gr_check"];

    $gs_ip=$_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?";
    $data = array('secret' => $recpatch_key, 'response' => $g_token, 'remoteip'=> $gs_ip);
    $options = array('http' => array('method'  => 'POST','content' => http_build_query($data)));
    $context  = stream_context_create($options);
    //$result = file_get_contents($url, false, $context);
    //die(json_encode(['error' => true,'message' => $result]));
    //$gs_response = json_decode($result);
    
    //if($gs_response->success){die(json_encode(['error' => true,'message' => 'Signup disabled!']));

		if(empty($signup_username)){$errors = "Username Shoould not be empty";}
		if(strlen($signup_username) > 20 || strlen($signup_username) < 3) {$errors = 'username length must be between 3 and 20 words!';}
		if(preg_match('/\s/',$signup_username)){$errors = "No Space Allowed in UserName";}
		if (stripos(json_encode($not_allowed_username),$signup_username) !== false) {$errors = 'Username not available!';}
	    if($check_dlike_name == true){
	        $errors = "Username not available";
	    }
	    if(empty($signup_email)){
	        $errors = "Email Shoould not be empty";
	    }
		if(empty($signup_password)){
	        $errors = "Password Shoould not be empty";
	    }
		if (strlen($signup_password) > 20 || strlen($signup_password) < 5) {
			$errors = 'Password must be between 5 and 20 characters long!';
		}
		if (!filter_var($_POST['signup_email'], FILTER_VALIDATE_EMAIL)) {
			$errors = 'Email is not valid!';
		}

		$check_email = "SELECT * FROM dlikeaccounts where email = '$signup_email'";
		$result_email = $conn->query($check_email);
		if ($result_email->num_rows > 0) {
			$errors = 'Email already in use!';
		}
		
		$check_user= "SELECT * FROM dlikeaccounts where username = '$signup_username'";
		$result_user = $conn->query($check_user);
		if ($result_user->num_rows > 0) {
			$errors = 'Username already taken!';
		}

		$check_ip_address = "SELECT * FROM dlikeaccounts where loct_ip = '$thisip'";
		$result_ip_address = $conn->query($check_ip_address);
		if ($result_ip_address->num_rows > 0) {
			$errors = 'You already have Account. New Account not allowed!';
		}
		//if(!preg_match('/^[\w-]+$/', $signup_username)) {
		//	$errors = 'Username is not valid!';
		//}
		if (empty($errors)) {
			$pin_number = mt_rand(100000, 999999);
			$status = '0';
			$verified = '0';
			$profile_img = 'https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';
			$profile_pic = mysqli_real_escape_string($conn, $profile_img);

			$escapedPW = mysqli_real_escape_string($conn, $signup_password);
			$escapedPWN = md5($escapedPW);
			$hashedPW = hash('sha256', $escapedPWN);

			$signup_username = mysqli_real_escape_string($conn, $signup_username);
			$signup_email = mysqli_real_escape_string($conn, $signup_email);

			$sqlm = "INSERT INTO dlikeaccounts (username, email, password, refer_by, status, profile_pic, loct_ip, verify_code, verified, created_time)
					VALUES ('".$signup_username."', '".$signup_email."', '".$hashedPW."', '".$refer_by."', '".$status."', '".$profile_pic."', '".$loct_ip."', '".$pin_number."', '".$verified."', '".date("Y-m-d H:i:s")."')";
			if (mysqli_query($conn, $sqlm)) {
				$amount = '0';
				$sql_W = "INSERT INTO dlike_wallet (username, amount)
						VALUES ('".$signup_username."', '".$amount."')";
				$create_wallet = mysqli_query($conn, $sql_W);

				$mail->isSMTP();
			    $mail->Host = 'smtp.transmail.com';
			    $mail->SMTPAuth = true;
			    $mail->Username = 'emailapikey';
			    $mail->Password = getenv("TRANMAIL_PASS");
			    $mail->SMTPSecure = 'SSL';
			    $mail->Port = 587;

			    $mail->setFrom('verification@dlike.io', 'DLIKE');
	    		$mail->addAddress($signup_email);

	    		$mail->isHTML(true); 
	    		$mail->Subject = 'DLIKE Email Verification';
	    		$mail->Body    = 'Welcome to DLIKE <br><br> Your Activation Code is '.$pin_number.' <br><br><br>Cheers<br>DLIKE Team<br><a href="https://dlike.io">dlike.io</a>';
				
				$done_email = $mail->send();

				if($done_email){die(json_encode(['error' => false,'message' => 'Signup successful. Please verify Email!']));	
				} else {die(json_encode(['error' => true,'message' => 'Email does not seem to work']));}
			} else {die(json_encode(['error' => true,'message' => 'There is some issue. Please Try later']));}
		} else {die(json_encode(['error' => true,'message' => $errors]));} 
	//}else {die(json_encode(['error' => true,'message' => 'Captcha check failed!']));}
} 
//else {die('Some error');}



if (isset($_POST['action']) && $_POST['action'] == 'resend_pin') {
    //$user_email = trim(mysqli_real_escape_string($conn, $_POST['user_email']));
    $username = $_COOKIE['dlike_username'];
    $check_user= $conn->query("SELECT * FROM dlikeaccounts where username = '$username'");
	$row_U = $check_user->fetch_assoc();$user_email = $row_U['email'];

    $pin_number = mt_rand(100000, 999999);

    if(!empty($user_email)){
    	$update_code=$conn->query("UPDATE dlikeaccounts SET verify_code='$pin_number' WHERE username='$username'");
		if ($update_code) {
			$mail->isSMTP();
		    $mail->Host = 'smtp.transmail.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = 'emailapikey';
		    $mail->Password = getenv("TRANMAIL_PASS");
		    $mail->SMTPSecure = 'SSL';
		    $mail->Port = 587;

		    $mail->setFrom('verification@dlike.io', 'DLIKE');
    		$mail->addAddress($user_email);

    		$mail->isHTML(true); 
    		$mail->Subject = 'DLIKE Email Verification';
    		$mail->Body    = 'Welcome to DLIKE <br><br> Your Activation Code is '.$pin_number.' <br><br><br>Cheers<br>DLIKE Team<br><a href="https://dlike.io">dlike.io</a>';
			
			$done_email = $mail->send();
			if($done_email){die(json_encode(['error' => false,'message' => 'Verification code sent to email!']));
			} else {die(json_encode(['error' => true,'message' => 'Email does not seem to work']));}
		}
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'email_verify' && isset($_POST['email_pin_code'])  && $_POST['email_pin_code'] != '') { 

	$username = $_COOKIE['dlike_username'];
	$email_pin_code = trim($_POST["email_pin_code"]);
    if(empty($email_pin_code)){ $errors = "PIN Should not be empty!";}
    if (empty($errors)) {
		$check_pin = $conn->query("SELECT * FROM dlikeaccounts where username = '$username' and verify_code = '$email_pin_code' ");
		if ($check_pin->num_rows > 0) {$verified = '1';
			$verifyuser = $conn->query("UPDATE dlikeaccounts SET verified = '$verified' WHERE username='$username'");
				if ($verifyuser) {$dlike_user_verify_url = 'https://dlike.io';
		    		die(json_encode(['error' => false,'message' => 'Email Verified Successfully!','redirect' => $dlike_user_verify_url]));
				}else {die(json_encode(['error'=>true,'message'=>'There is some issue in Email Verification!']));}
		} else {die(json_encode(['error' => true,'message' => 'Does not seems to be a valid pin code for this email!'])); }
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}


if (isset($_POST['action']) && $_POST['action'] == 'reset_pass' && isset($_POST['reset_email'])  && $_POST['reset_email'] != '') { 

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
}



if (isset($_POST['action']) && $_POST['action'] == 'set_new_pass' && isset($_POST['reset_pass'])  && $_POST['reset_pass'] != '' && isset($_POST['confirm_reset_pass'])  && $_POST['confirm_reset_pass'] != '' && isset($_POST['reset_email'])  && $_POST['reset_email'] != '') { 

	$reset_pass = trim($_POST["reset_pass"]);
	$confirm_reset_pass = trim($_POST["confirm_reset_pass"]);
	$reset_email = trim($_POST["reset_email"]);

	if(empty($reset_pass)){$errors = "Password Shoould not be empty";}
    if(empty($confirm_reset_pass)){$errors = "Confirm Password Shoould not be empty";}
    if($confirm_reset_pass != $reset_pass){$errors = "Both Passwords do nto match";}

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

			die(json_encode(['error' => false,'message' => 'Password Updated Successful!','redirect' => $dlike_user_login_url]));

		} else {die(json_encode(['error' => true,'message' => 'Some issue in password reset. Please try later!'])); }
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}
?>