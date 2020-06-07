<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

if (isset($_POST['signup_email'])  && $_POST['signup_email'] != '' && isset($_POST['signup_username'])  && $_POST['signup_username'] != '' && isset($_POST['signup_pass'])  && $_POST['signup_pass'] != '')
{
	
} else {die('Some error');}
?>