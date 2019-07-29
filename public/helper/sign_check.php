<?php

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){

	$return = array();
	$return['status'] = false;
	$return['message'] = '';

	$user =  $_POST['user'];
	//$keys = json_decode(stripslashes($_POST['myKeys']));
	//$active_key = $keys[active];
	$keys = $_POST['myKeys'];
	$keys   = json_decode("$keys", true);
	$active_key =  $keys["active"];

		if($user != ''){
			$return['status'] = true;
			$return['message'] = 'Looks data done'.$active_key;
		}
		else{
			$return['message'] = 'data not good.';
		}
	echo json_encode($return);
	exit;
}

?>