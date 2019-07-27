<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';
require_once("../includes/Twilio/autoload.php");

$client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);
$phone =  $_POST['number'];

use Twilio\Rest\Client;

$sid    = getenv('twilio_sid');
$token  = getenv('twilio_token');
$twilio = new Client($sid, $token);

$verification = $twilio->verify->v2->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                   ->verifications
                                   ->create($phone, "sms");

print($verification->sid);



// Sandbox Twillio Constants
//define("TWILIO_FROM_NO", "+13237759845");
//define("TWILIO_SID", "ACe117d252bc601c7d773357dcbfa29f69");
//define("TWILIO_TOKEN", "30c7d02328017d4b76ddb7652ec32bc1"); 
//function sendSMS($country_code = '',$mobile_no, $message){
    //require_once("../includes/Twilio/autoload.php");
    //$client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);
    //$message = $client->messages->create($country_code.$mobile_no, array('from' => TWILIO_FROM_NO, 'body' => $message));
    /*$verification = $client->verify->v2->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->verifications->create($country_code.$mobile_no,"sms");*/
    //$creatService = $client->verify->v2->services->create("Number Verification Service");
    
	// $verification = $client->verify->v2->services('VAcd3624a0276d7eb9e0b442625771d7c1')->verifications->create($country_code.$mobile_no,"sms");
	// /*File writer code*/
	// $txt = '========================='.date('Y-m-d H:i:s').'=====================';
	// $myfile = fopen("sms-log.txt", "a");
	// fwrite($myfile, "\n". $verification);
	// fclose($myfile);
	// /*File writer code*/
	// if($verification && isset($verification->sid) && $verification->sid != ''){
	// 	return true;
	// }
	// else{
	// 	return false;
	// }
    

    /*File writer code*/
	//$txt = '========================='.date('Y-m-d H:i:s').'=====================';
	//$myfile = fopen("sms-log.txt", "a");
	//fwrite($myfile, "\n". $message);
	//fclose($myfile);
	/*File writer code*/
    //if($message != ""){
    //    $message = print_r($message, true);
    //	return true;
    //}
    //else{
    //	return false;
    //}
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