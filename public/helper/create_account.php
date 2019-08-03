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
    $state = exec("node js/newAccount.js", $output); 
    echo $result = implode("\n", $output);
	} 

	if (isset($state)) { 
			$return['status'] = true;
            $return['message'] = 'Account Created'.$result;
	} else {
			$return['message'] = 'Failed'.$result;

	} 

    echo json_encode($return);
    exit;

} else {die('Some error');}
?>
