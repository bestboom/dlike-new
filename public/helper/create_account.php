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

    $active_owner=getenv('active_account');

	$user =  $_POST['user'];
    $created_by = 'dlike';
    $owner_key = $_POST['owner'];
    $active_key = $_POST['active'];
    $posting_key = $_POST['posting'];
    $memo_key = $_POST['memo'];

    $return = array();
    $return['status'] = false;
    $return['message'] = '';

	if (empty($errors)) {
    $publish = $accountGenerator->createAccount($created_by, $user, $owner_key, $active_key, $posting_key, $memo_key);
    $state = $accountGenerator->broadcast($active_owner, $publish);
	} 

	if (isset($state)) { 
			$return['status'] = true;
            $return['message'] = 'Account created';
	} else {
			$return['message'] = 'Failed'.$state;

	} 

    echo json_encode($return);
    exit;

} else {die('Some error');}
?>