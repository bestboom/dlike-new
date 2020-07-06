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

if (isset($_POST['signup_email'])  && $_POST['signup_email'] != '' && isset($_POST['signup_username'])  && $_POST['signup_username'] != '' && isset($_POST['signup_pass'])  && $_POST['signup_pass'] != '')
{
	$signup_username = trim($_POST["signup_username"]);
	$signup_email = trim($_POST["signup_email"]);
	$signup_password = trim($_POST["signup_pass"]);
	$refer_by = $_POST["signup_refer_by"];
	$loct_ip = $_POST['signup_loct_ip'];
	$company_name = 'dlike';

	if(empty($signup_username)){
        $errors = "Username Shoould not be empty";
    }
    if(empty($signup_email)){
        $errors = "Email Shoould not be empty";
    }
	//if(!preg_match('/^[\w-]+$/', $signup_username)) {
	//	$errors = 'Username is not valid!';
	//}
	if (strlen($signup_username) > 20 || strlen($signup_username) < 3) {
		$errors = 'username length must be between 3 and 20 words!';
	}
	$not_allowed_username = ["dlike", "dliker", "dlikedex", "fuck", "steem", "steemit"];
	if (stripos(json_encode($not_allowed_username),$signup_username) !== false) {
		$errors = 'Username not available!';
	}
    $check_dlike_name = stripos($signup_username, $company_name);
    if($check_dlike_name === true){
        $errors = "Username not available";
    }
	$check_ip_address = "SELECT * FROM dlikeaccounts where loct_ip = '$thisip'";
	$result_ip_address = $conn->query($check_ip_address);
	if ($result_ip_address->num_rows > 0) {
		$errors = 'You already have Account. New Account not allowed!';
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
		    $mail->Host = 'smtp.zoho.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = 'verification@dlike.io';
		    $mail->Password = getenv("EMAIL_PASS");
		    $mail->SMTPSecure = 'tls';
		    $mail->Port = 587;

		    $mail->setFrom('verification@dlike.io', 'DLIKE');
    		$mail->addAddress($signup_email);

    		$mail->isHTML(true); 
    		$mail->Subject = 'DLIKE Email Verification';
    		$mail->Body    = 'Welcome to DLIKE <br><br> Your Activation Code is '.$pin_number.' <br><br><br>Cheers<br>DLIKE Team<br><a href="https://dlike.io">dlike.io</a>';
			
			$done_email = $mail->send();

			if($done_email) { 
				die(json_encode([
			    	'error' => false,
		    		'message' => 'Signup successful. Please verify Email!'
				]));	
			} else {
			    die(json_encode([
		    		'error' => true,
		    		'message' => 'Email does not seem to work'
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