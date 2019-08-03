<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){
 
    $active_owner=getenv('active_account');

	$user =  $_POST['user'];

    $return = array();
    $return['status'] = false;
    $return['message'] = '';

	if ($user !='') {
    //run code here
	} 

	if (isset($state)) { 
			$return['status'] = true;
            $return['message'] = 'Account Created';
	} else {
			$return['message'] = 'Failed';

	} 

    echo json_encode($return);
    exit;

} else {die('Some error');}
?>
