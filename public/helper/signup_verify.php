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

//check if email exist
if (isset($_POST['action'])  && $_POST['action'] == 'verify_email' && isset($_POST['email'])  && $_POST['email'] != '')
{
	$return = array();
	$return['status'] = false;
	$return['message'] = '';
	$email =  $_POST['email'];
	$user =  $_POST['user'];

	$check_ip_address = "SELECT * FROM wallet where loct_ip = '$thisip'";
	$result_ip_address = $conn->query($check_ip_address);

	if ($result_ip_address->num_rows <= 0)
	{
		$check_email = "SELECT * FROM wallet where email = '$email'";
		$result_email = $conn->query($check_email);

		if ($result_email->num_rows <= 0)
		{
			$pin_number = mt_rand(100000, 999999);
			$status = '0';

			$sqlm = "INSERT INTO wallet (username, email, pin_code, verified)
						VALUES ('".$user."', '".$email."', '".$pin_number."', '".$status."')";
			if (mysqli_query($conn, $sqlm)) { 

				$mail->isSMTP();
			    $mail->Host = 'smtp.transmail.com';
			    $mail->SMTPAuth = true;
			    $mail->Username = 'emailapikey';
			    $mail->Password = getenv("TRANMAIL_PASS");
			    $mail->SMTPSecure = 'TLS';
			    $mail->Port = 587;

			    $mail->setFrom('verification@dlike.io', 'DLIKE');
	    		$mail->addAddress($email);

	    		$mail->isHTML(true); 
	    		$mail->Subject = 'DLIKE Email Verification';
	    		$mail->Body    = 'Welcome to DLIKE <br><br> Your Activation Code is '.$pin_number.' <br><br><br>Cheers<br>DLIKE Team<br><a href="https://dlike.io">dlike.io</a>';
				
				$done_email = $mail->send();

				if($done_email) {
					$return['status'] = true;
					$return['message'] = 'Verification code sent to email';
				} else {$return['message'] = 'Email does not seem to work!';}
			} else {$return['message'] = 'Some issue in processing. Please Try later';}
		}else{ $return['message'] = 'Email already in use'; }
	} else { $return['message'] = 'New Account not allowed!';}

	echo json_encode($return);
	exit;
}

// verify pun code
if (isset($_POST['action'])  && $_POST['action'] == 'verify_pin' && isset($_POST['mypin'])  && $_POST['mypin'] != ''){

	$return = array();
	$return['status'] = false;
	$return['message'] = '';

	$mypin =  $_POST['mypin'];
	$my_email =  $_POST['email'];

	$check_pin = "SELECT * FROM wallet where email = '$my_email' and pin_code = '$mypin' ";
	$result_pin = $conn->query($check_pin);

	if ($result_pin->num_rows > 0) { 
		//if($mypin == 765432){	
			$return['status'] = true;
			$return['message'] = 'Thanks! PIN Verified.';
		}
		else{
			$return['message'] = 'PIN is not valid.';
		}
	echo json_encode($return);
	exit;
}

// new signup-with IP or email
if (isset($_POST['action'])  && $_POST['action'] == 'acc_create2' && isset($_POST['user'])  && $_POST['user'] != ''  && $_POST['email'] != ''){

	$return = array();
    $return['status'] = false;
    $return['message'] = '';
	$user = $_POST['user'];
	$refer_by = $_POST['refer_by'];
	$loct_ip = $_POST['loct'];
	$email = $_POST['email'];
	//$phone_num = md5($phone);
	$signup_bonus = 10;
	$referral_bonus = 20;
	$signup_reason = 'Signup Bonus';
	$referral_reason = 'Referral Bonus';

    if ($_POST['user'] !='') {
        $here = dirname(__FILE__);

        $state = shell_exec("node {$here}/../js/newAccount.js \"{$user}\""); 
        $password = trim($state); // do what you want with the password here

        //$password = 'asadadadafadafadad';
        
        if($password !=''){
			 	$updateStatus = "UPDATE wallet SET verified = '1', loct_ip = '$loct_ip' WHERE username = '$user' AND email = '$email'";
			 	$updateUserStatus = $conn->query($updateStatus);
						if ($updateUserStatus === TRUE) { 

							if($refer_by !='dlike'){

								$sqlR = "INSERT INTO referrals (username, refer_by, entry_time)
									VALUES ('".$user."', '".$refer_by."', now())";
								
								$add_referral = mysqli_query($conn, $sqlR);
				            }
				            
				        }

		$return['status'] = true;
		$return['message'] = 'Account Created Successfully';
		$return['password'] = $password;			         		           
        }
        else 
       	{
           $return['status'] = false;
           $return['message'] = 'Some Error';
       	}
        
        echo json_encode($return);die; 
    }
}
?>