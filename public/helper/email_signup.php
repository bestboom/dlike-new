<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

if (isset($_POST['signup_email'])  && $_POST['signup_email'] != '' && isset($_POST['signup_username'])  && $_POST['signup_username'] != '' && isset($_POST['signup_pass'])  && $_POST['signup_pass'] != '')
{
	$signup_username = $_POST['signup_username'];
	if (strlen($_POST['signup_pass']) > 20 || strlen($_POST['signup_pass']) < 5) {
		$errors = 'Password must be between 5 and 20 characters long!';
	}
	if (!filter_var($_POST['signup_email'], FILTER_VALIDATE_EMAIL)) {
		$errors = 'Email is not valid!';
	}
	//if (preg_match('/[A-Za-z0-9]+/', $_POST['signup_username'])) {
		//$errors = 'Username is not valid!';
	//}
	if(!preg_match('/^[\w-]+$/', $signup_username)) {
		$errors = 'Username is not valid!';
   		//echo "String 1 not acceptable acceptable";
   		// String2 acceptable
	}
	if (empty($errors)) { 
	    die(json_encode([
	    	'error' => false,
    		'message' => 'Thankk You', 
    		'data' => 'Upvoting'
    		
		]));
	} else {
	    die(json_encode([
    		'error' => true,
    		'message' => $errors, 
    		'data' => 'Already Upvoted'
		]));
	} 
} else {die('Some error');}
?>