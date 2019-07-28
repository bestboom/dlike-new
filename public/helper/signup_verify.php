<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

require '../includes/config.php';
require_once("../includes/twilio-php-master/Twilio/autoload.php");


use Twilio\Rest\Client;

$sid    = getenv('twilio_sid');
$token  = getenv('twilio_token');
$twilio = new Client($sid, $token);

if (isset($_POST['action'])  && $_POST['action'] == 'check_number' && isset($_POST['number'])  && $_POST['number'] != '')
{
	$return = array();
	$return['status'] = false;
	$return['message'] = '';
	$phone =  $_POST['number'];

	$check_phone = "SELECT * FROM wallet where phone_number = '".$phone."' ";
	$result_phone = $conn->query($check_phone);

	if ($result_phone->num_rows <= 0)
	{
		$return['status'] = true;
		$return['message'] = 'Number is availabel';
	}
	else{
		$return['message'] = 'Number already in use by other account';
	}
	echo json_encode($return);
	exit;
}

else if (isset($_POST['action'])  && $_POST['action'] == 'send_sms' && isset($_POST['number'])  && $_POST['number'] != ''){

	$return = array();
	$return['status'] = false;
	$return['message'] = '';

	$phone =  $_POST['number'];
	$phone_number_full = '+'.$phone;

	$check_phone = "SELECT * FROM wallet where phone_number = '".$phone."' ";
	$result_phone = $conn->query($check_phone);

	if ($result_phone->num_rows <= 0){

		$verification = $twilio->verify->v2->services("VA7e42d549091ac2261146897b3655b465")->verifications->create($phone_number_full, "sms");
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

?>