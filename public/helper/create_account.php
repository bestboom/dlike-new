<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_account.php";

function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}
$accountGenerator = new dlike\signup\makeAccount();

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){

    $active=getenv('active_account');
	$user =  $_POST['user'];
    $keys = $_POST['myKeys'];
    $keys   = json_decode("$keys", true);
    $active_key =  $keys["active"];
    $owner_key =  $keys["owner"];
    $memo_key =  $keys["memo"];
    $posting_key =  $keys["posting"];
    $created_by = 'dlike';

    $return = array();
    $return['status'] = false;
    $return['message'] = '';

	if (empty($errors)) {
    $publish = $accountGenerator->createAccount($created_by, $user, $owner_key, $active_key, $posting_key, $memo_key);
    $state = $accountGenerator->broadcast($publish);
	}

	if ($state) { 
			$return['status'] = true;
            $return['message'] = 'Looks data done';
	} else {
			$return['message'] = 'data not good.';
            var_dump($state);

	} 

    echo json_encode($return);
    exit;

} else {die('Some error');}
?>