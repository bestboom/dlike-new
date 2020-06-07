<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

if (isset($_POST['signup_email'])  && $_POST['signup_email'] != '' && isset($_POST['signup_username'])  && $_POST['signup_username'] != '' && isset($_POST['signup_pass'])  && $_POST['signup_pass'] != '')
{
	if (strlen($_POST['signup_pass']) > 20 || strlen($_POST['signup_pass']) < 5) {
		$errors = 'Password must be between 5 and 20 characters long!' ;
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