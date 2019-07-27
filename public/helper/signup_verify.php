<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';
// Sandbox Twillio Constants
define("TWILIO_FROM_NO", "+919586561149");
define("TWILIO_SID", "ACe117d252bc601c7d773357dcbfa29f69");
define("TWILIO_TOKEN", "30c7d02328017d4b76ddb7652ec32bc1"); 
function sendSMS($country_code = '',$mobile_no, $message) {
    require_once("../includes/Twilio/autoload.php");
    $client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);
    $message = $client->messages->create($country_code.$mobile_no, array('from' => TWILIO_FROM_NO, 'body' => $message));
    /*File writer code*/
	  $txt = '========================='.date('Y-m-d H:i:s').'=====================';
	  $myfile = fopen("sms-log.txt", "a");
	  fwrite($myfile, "\n". $message);
	  fclose($myfile);
	  /*File writer code*/
    if($message != ""){
        $message = print_r($message, true);
    	return true;
    }
    else{
    	return false;
    }
}
if (isset($_POST['action'])  && $_POST['action'] == 'check_number' && isset($_POST['number'])  && $_POST['number'] != ''){
	$return = array();
	$return['status'] = false;
	$return['message'] = '';
	$phone =  $_POST['number'];
	$check_phone = "SELECT * FROM wallet where phone_number = '".$phone."' ";
	$result_phone = $conn->query($check_phone);
	if ($result_phone->num_rows <= 0){
		$return['status'] = true;
		$return['message'] = 'Number is availabel';
	}
	else{
		$return['message'] = 'Number already in use by other account';
	}
	echo json_encode($return);
	exit;
}
else if (isset($_POST['action'])  && $_POST['action'] == 'send_sms' && isset($_POST['number'])  && $_POST['number'] != '' && isset($_POST['countryCode'])  && $_POST['countryCode'] != ''){
	$return = array();
	$return['status'] = false;
	$return['message'] = '';
	$countryCode =str_replace('+','',$_POST['countryCode']); 
	$phone =  $countryCode.$_POST['number'];
	$check_phone = "SELECT * FROM wallet where phone_number = '".$phone."' ";
	$result_phone = $conn->query($check_phone);
	if ($result_phone->num_rows <= 0){
		$otp = mt_rand(1111,9999);
		echo $otp.'<br/>'.$countryCode.$_POST['number'].'<br/>'.$_POST['countryCode'].'<br/>'.$_POST['number'];die;
		$txt = "Your otp is : ".$otp;
		$sms = sendSMS($_POST['countryCode'],$_POST['number'],$txt);
		if($sms){
			$return['status'] = true;
			$return['message'] = 'We have sent you otp on your number please verify it.';
		}
		else{
			$return['message'] = 'We are unable to send otp, Please try again later.';
		}
	}
	else{
		$return['message'] = 'Number already in use by other account';
	}
	echo json_encode($return);
	exit;
}

?>