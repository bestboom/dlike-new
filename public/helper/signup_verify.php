<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

require '../includes/config.php';
//require_once("../includes/twilio-php-master/Twilio/autoload.php");


//use Twilio\Rest\Client;

//$sid    = getenv('twilio_sid');
//$token  = getenv('twilio_token');
//$twilio = new Client($sid, $token);

if (isset($_POST['action'])  && $_POST['action'] == 'check_number' && isset($_POST['number'])  && $_POST['number'] != '')
{
	$return = array();
	$return['status'] = false;
	$return['message'] = '';
	$phone =  $_POST['number'];
	$phone_num = md5($phone);

	$check_phone = "SELECT * FROM wallet where phone_number = '".$phone_num."' ";
	$result_phone = $conn->query($check_phone);

	if ($result_phone->num_rows <= 0)
	{
		$return['status'] = true;
		$return['message'] = 'Number is available';
	}
	else{
		$return['message'] = 'Number already in use by other account';
	}
	echo json_encode($return);
	exit;
}


//check if email exist
if (isset($_POST['action'])  && $_POST['action'] == 'verify_email' && isset($_POST['email'])  && $_POST['email'] != '')
{
	$return = array();
	$return['status'] = false;
	$return['message'] = '';
	$email =  $_POST['email'];

	$check_email = "SELECT * FROM wallet where email = '".$email."' ";
	$result_email = $conn->query($check_email);

	if ($result_email->num_rows <= 0)
	{
		$return['status'] = true;
		$return['message'] = 'Fine to Move on!';
	}
	else{
		$return['message'] = 'Email already in use';
	}
	echo json_encode($return);
	exit;
}


if (isset($_POST['action'])  && $_POST['action'] == 'send_sms' && isset($_POST['number'])  && $_POST['number'] != ''){

	$return = array();
	$return['status'] = false;
	$return['message'] = '';

	$phone =  $_POST['number'];
	$phone_num = md5($phone);
	$phone_number_full = '+'.$phone;


	$check_phone = "SELECT * FROM wallet where phone_number = '".$phone_num."' ";
	$result_phone = $conn->query($check_phone);

	if ($result_phone->num_rows <= 0){

		#$verification = $twilio->verify->v2->services("VA7e42d549091ac2261146897b3655b465")->verifications->create($phone_number_full, "sms");
		if($verification){
			$return['status'] = true;
			$return['message'] = 'We have sent you PIN on your number please verify it.';
		}
		else{
			$return['message'] = 'There is some issue.';
		}
	}
	else{
		$return['message'] = 'Number already in use by other account';
	}
	echo json_encode($return);
	exit;
}

if (isset($_POST['action'])  && $_POST['action'] == 'verify_pin' && isset($_POST['mypin'])  && $_POST['mypin'] != ''){

	$return = array();
	$return['status'] = false;
	$return['message'] = '';

	$mypin =  $_POST['mypin'];
	$phone =  $_POST['number'];
	$my_phone = '+'.$phone;


		$verification_check = $twilio->verify->v2->services("VA7e42d549091ac2261146897b3655b465")
                                         ->verificationChecks
                                         ->create($mypin, 
                                                  array("to" => $my_phone)
                                         );
		if($verification_check->valid){ 
		//if($mypin == 7654){	
			$return['status'] = true;
			$return['message'] = 'Thanks! PIN Verified.';
		}
		else{
			$return['message'] = 'PIN is not valid.';
		}
	echo json_encode($return);
	exit;
}

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){

	$return = array();
    $return['status'] = false;
    $return['message'] = '';
	$user = $_POST['user'];
	$refer_by = $_POST['refer_by'];
	$phone = $_POST['number'];
	$phone_num = md5($phone);
	$signup_bonus = 20;
	$referral_bonus = 50;
	$signup_reason = 'Signup Bonus';
	$referral_reason = 'Referral Bonus';

    if ($_POST['user'] !='') {
        $here = dirname(__FILE__);

        $state = shell_exec("node {$here}/../js/newAccount.js \"{$user}\""); 
        $password = trim($state); // do what you want with the password here

        //$password = 'asadadadafadafadad';
        
        if($password !=''){

			 	$sqlm = "INSERT INTO wallet (username, amount, phone_number)
						VALUES ('".$user."', '".$signup_bonus."', '".$phone_num."')";

						if (mysqli_query($conn, $sqlm)) 
						{ 

							$sqlX = "INSERT INTO transactions (username, amount, reason)
								VALUES ('".$user."', '".$signup_bonus."', '".$signup_reason."')";

							$signup_reward =  mysqli_query($conn, $sqlX);

							 if($refer_by !='dlike'){

								$sqlR = "INSERT INTO Referrals (username, refer_by, entry_time)
									VALUES ('".$user."', '".$refer_by."', now())";
								
								if (mysqli_query($conn, $sqlR)) {
								
									$check_ref_balance = "SELECT amount FROM wallet where username = '".$refer_by."' ";
									$result_bal = $conn->query($check_ref_balance);

										if ($result_bal->num_rows > 0) {

											$rowB = $result_bal->fetch_assoc();	
											$user_bal = $rowB['amount'];

											$updateBonus = "UPDATE wallet SET amount = '$user_bal' + '$referral_bonus' WHERE username = '$refer_by'";
											$updateRefBonus = $conn->query($updateBonus);

											if ($updateRefBonus === TRUE) {

												$sqlW = "INSERT INTO transactions (username, amount, reason)
													VALUES ('".$refer_by."', '".$referral_bonus."', '".$referral_reason."')";

							                  	$referral_reward =  mysqli_query($conn, $sqlW);
	
											}
										}
								}
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


// new signup-with IP or email
if (isset($_POST['action'])  && $_POST['action'] == 'acc_create2' && isset($_POST['user'])  && $_POST['user'] != ''  && $_POST['email'] != ''){

	$return = array();
    $return['status'] = false;
    $return['message'] = '';
	$user = $_POST['user'];
	$refer_by = $_POST['refer_by'];
	$email = $_POST['email'];
	//$phone_num = md5($phone);
	$signup_bonus = 20;
	$referral_bonus = 50;
	$signup_reason = 'Signup Bonus';
	$referral_reason = 'Referral Bonus';

    if ($_POST['user'] !='') {
        $here = dirname(__FILE__);

        $state = shell_exec("node {$here}/../js/newAccount.js \"{$user}\""); 
        $password = trim($state); // do what you want with the password here

        //$password = 'asadadadafadafadad';
        
        if($password !=''){

			 	$sqlm = "INSERT INTO wallet (username, amount, email)
						VALUES ('".$user."', '".$signup_bonus."', '".$email."')";

						if (mysqli_query($conn, $sqlm)) 
						{ 

							$sqlX = "INSERT INTO transactions (username, amount, reason)
								VALUES ('".$user."', '".$signup_bonus."', '".$signup_reason."')";

							$signup_reward =  mysqli_query($conn, $sqlX);

							 if($refer_by !='dlike'){

								$sqlR = "INSERT INTO Referrals (username, refer_by, entry_time)
									VALUES ('".$user."', '".$refer_by."', now())";
								
								if (mysqli_query($conn, $sqlR)) {
								
									$check_ref_balance = "SELECT amount FROM wallet where username = '".$refer_by."' ";
									$result_bal = $conn->query($check_ref_balance);

										if ($result_bal->num_rows > 0) {

											$rowB = $result_bal->fetch_assoc();	
											$user_bal = $rowB['amount'];

											$updateBonus = "UPDATE wallet SET amount = '$user_bal' + '$referral_bonus' WHERE username = '$refer_by'";
											$updateRefBonus = $conn->query($updateBonus);

											if ($updateRefBonus === TRUE) {

												$sqlW = "INSERT INTO transactions (username, amount, reason)
													VALUES ('".$refer_by."', '".$referral_bonus."', '".$referral_reason."')";

							                  	$referral_reward =  mysqli_query($conn, $sqlW);
	
											}
										}
								}
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