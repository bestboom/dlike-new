<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

if (isset($_POST['signup_email'])  && $_POST['signup_email'] != '' && isset($_POST['signup_username'])  && $_POST['signup_username'] != '' && isset($_POST['signup_pass'])  && $_POST['signup_pass'] != '')
{
	$signup_username = trim($_POST["signup_username"]);
	$signup_email = trim($_POST["signup_email"]);
	$signup_password = trim($_POST["signup_pass"]);

	if(empty($signup_username)){
        $errors = "Username Shoould not be empty";
    }
    if(empty($signup_email)){
        $errors = "Email Shoould not be empty";
    }
    if(empty($signup_password)){
        $errors = "Password Shoould not be empty";
    }
	if (strlen($signup_password) > 20 || strlen($signup_password) < 5) {
		$errors = 'Password must be between 5 and 20 characters long!';
	}
	if (!filter_var($_POST['signup_email'], FILTER_VALIDATE_EMAIL)) {
		$errors = 'Email is not valid!';
	}
	if(!preg_match('/^[\w-]+$/', $signup_username)) {
		$errors = 'Username is not valid!';
	}
	$not_allowed_username = ["dlike", "dliker", "dlikedex", "fuck", "steem", "steemit"];
	if (stripos(json_encode($not_allowed_username),$signup_username) !== false) {
		$errors = 'Username not available!';
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