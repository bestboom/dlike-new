<?php
require '../includes/config.php';
if (isset($_POST['action']) && $_POST['action'] == 'add_account' && isset($_POST['user']) && $_POST['user'] != ''){
	$add_user = trim($_POST['user']);
    $add_pass = trim($_POST['pass']);
    $add_email = trim($_POST['email']);
    $escapedPW = mysqli_real_escape_string($conn, $add_pass);
	$escapedPWN = md5($escapedPW);
	$hashedPW = hash('sha256', $escapedPWN);
	$profile_img = 'https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';
	$profile_pic = mysqli_real_escape_string($conn, $profile_img);

    if(empty($add_user)){$acc_errors = "Username Shoould not be empty";}
    if(empty($add_pass)){$acc_errors = "Password Shoould not be empty";}
    if(empty($add_email)){$acc_errors = "Email Shoould not be empty";}

    if(empty($acc_errors)){
    	$sqlm = "INSERT INTO dlikeaccounts (username, email, password, refer_by, status, profile_pic, verified, admin_account, created_time)VALUES ('".$add_user ."', '".$add_email."', '".$hashedPW."', 'dlike', '0', '".$profile_pic."', '1',  '1', '".date("Y-m-d H:i:s")."')";
    	if (mysqli_query($conn, $sqlm)) {
    		die(json_encode(['error' => false,'message' => 'WOW, Account created!']));} else{die(json_encode(['error' => true,'message' => 'Some issue in account creation!']));}
    }else{die(json_encode(['error' => true,'message' => $errors]));}
}