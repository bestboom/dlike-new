<?php
require '../includes/config.php';
if (isset($_POST['action']) && $_POST['action'] == 'add_account' && isset($_POST['user']) && $_POST['user'] != ''){
	$add_user = trim($_POST['user']);
    $add_pass = trim($_POST['pass']);
    $add_email = trim($_POST['email']);
    if(empty($add_user)){$acc_errors = "Username Shoould not be empty";}
    if(empty($add_pass)){$acc_errors = "Password Shoould not be empty";}
    if(empty($add_email)){$acc_errors = "Email Shoould not be empty";}
    if(empty($acc_errors)){die(json_encode(['error' => false,'message' => 'All is fine lets add data!']));}
    else{die(json_encode(['error' => true,'message' => $errors]));}
}