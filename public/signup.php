<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
require '/includes/config.php';
require_once("/includes/Twilio/autoload.php");

//$client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);

use Twilio\Rest\Client;

$sid    = getenv('twilio_sid');
$token  = getenv('twilio_token');
$twilio = new Client($sid, $token);

$verification = $twilio->verify->v2->services("VA7e42d549091ac2261146897b3655b465")->verifications->create("+923137636220", "sms");

print($verification->sid);

?>