<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

if (isset($_POST['signup_email'])  && $_POST['signup_email'] != '' && isset($_POST['signup_username'])  && $_POST['signup_username'] != '' && isset($_POST['signup_pass'])  && $_POST['signup_pass'] != '')
{
	$signup_username = trim($_POST["signup_username"]);
	$signup_email = trim($_POST["signup_email"]);
	$signup_password = trim($_POST["signup_pass"]);
	$refer_by = $_POST["signup_refer_by"];
	$loct_ip = $_POST['signup_loct_ip'];

	if(empty($signup_username)){
        $errors = "Username Shoould not be empty";
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
	if(!preg_match('/^[\w-]+$/', $signup_username)) {
		$errors = 'Username is not valid!';
	}
	$not_allowed_username = ["dlike", "dliker", "dlikedex", "fuck", "steem", "steemit"];
	if (stripos(json_encode($not_allowed_username),$signup_username) !== false) {
		$errors = 'Username not available!';
	}


	$check_ip_address = "SELECT * FROM dlikeaccounts where loct_ip = '$thisip'";
	$result_ip_address = $conn->query($check_ip_address);
	if ($result_email->num_rows > 0) {
		$errors = 'You already have Account. New Account not allowed!';
	}

	$check_email = "SELECT * FROM dlikeaccounts where email = '$signup_email'";
	$result_email = $conn->query($check_email);
	if ($result_email->num_rows > 0)
		$errors = 'Email already in use!';
	}

	$check_user= "SELECT * FROM dlikeaccounts where username = '$signup_username'";
	$result_user = $conn->query($check_user);
	if ($result_user->num_rows > 0)
		$errors = 'Username already taken!';
	}

	if (empty($errors)) {

		$pin_number = mt_rand(100000, 999999);
		$status = '0';
		$verified = '0';

		$escapedPW = mysqli_real_escape_string($conn, $signup_password);
		$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		$saltedPW =  $escapedPW . $salt;
		$hashedPW = hash('sha256', $saltedPW);

		$signup_username = mysqli_real_escape_string($conn, $signup_username);
		$signup_email = mysqli_real_escape_string($conn, $signup_email);

		$sqlm = "INSERT INTO dlikeaccounts (username, email, password, refer_by, status, loct_ip, verify_code, verified, created_time)
				VALUES ('".$signup_username."', '".$signup_email."', '".$hashedPW."', '".$refer_by."', '".$status."', '".$loct_ip."', '".$pin_number."', '".$verified."','".date("Y-m-d H:i:s")."')";
		if (mysqli_query($conn, $sqlm)) {

			$mail->isSMTP();
		    $mail->Host = 'smtp.zoho.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = 'verification@dlike.io';
		    $mail->Password = getenv("EMAIL_PASS");
		    $mail->SMTPSecure = 'tls';
		    $mail->Port = 587;

		    $mail->setFrom('verification@dlike.io', 'DLIKE');
    		$mail->addAddress($email);

    		$mail->isHTML(true); 
    		$mail->Subject = 'DLIKE Email Verification';
    		$mail->Body    = 'Welcome to DLIKE <br><br> Your Activation Code is '.$pin_number.' <br><br><br>Cheers<br>DLIKE Team<br><a href="https://dlike.io">dlike.io</a>';
			
			$done_email = $mail->send();

			if($done_email) { 
				die(json_encode([
			    	'error' => false,
		    		'message' => 'Signup successful. Please verify Email!', 
		    		'data' => 'Signup'
				]));	
			} else {
			    die(json_encode([
		    		'error' => true,
		    		'message' => 'Email does not seem to work', 
		    		'data' => 'Email Send Issue'
				]));
			}
		} else {
		    die(json_encode([
	    		'error' => true,
	    		'message' => 'There is some issue. Please Try later';
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