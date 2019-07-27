<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

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
}

?>