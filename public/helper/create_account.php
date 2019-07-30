<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$active=getenv('active_account');
require_once "../helper/publish_account.php";

function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}
$accountGenerator = new dlike\signup\makeAccount();

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){

	$user =  $_POST['user'];
    $keys = $_POST['myKeys'];
    $keys   = json_decode("$keys", true);
    $active_key =  $keys["activePubkey"];
    $owner_key =  $keys["ownerPubkey"];
    $memo_key =  $keys["memoPubkey"];
    $posting_key =  $keys["postingPubkey"];

    $return = array();
    $return['status'] = false;
    $return['message'] = '';

	if (empty($errors)) {
    $publish = $accountGenerator->createAccount($active, $user, $owner_key, $active_key, $posting_key, $memo_key);
    $state = $accountGenerator->broadcast($publish);
	}

	if (isset($state->result)) { 
			    die(json_encode([
			    	'error' => false,
            		'message' => 'Account created successfully', 
            		'data' => 'creating'
            		
        		]));
	} else {
			    die(json_encode([
            		'error' => true,
            		'message' => 'Sorry, Some issue!'.$state->error_description, 
            		'data' => 'Some issue'
        		]));
	} 

} else {die('Some error');}
?>