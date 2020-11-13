<?php 
require '../includes/config.php';
if (isset($_POST['login_username'])  && $_POST['login_username'] != '' && isset($_POST['login_pass'])  && $_POST['login_pass'] != '') { 
    $token=$_POST["g-token"]; 
    $g_ip=$_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?".$recpatch_key."&response=".$token."&remoteip=".$g_ip;
    $request = file_get_contents($url);
    $g_response = json_decode($request);
    if($g_response->success){json_encode(['error' => false,'message' => $g_response]);}
    	$login_username = trim($_POST["login_username"]);
    	$login_pass = trim($_POST["login_pass"]);
    	if(empty($login_username)){ $errors = "Username Shoould not be empty";}
        if(empty($login_pass)){ $errors = "Password Shoould not be empty";}
        if (empty($errors)) {
        	$escapedPW = mysqli_real_escape_string($conn, $login_pass);
    		$escapedPWN = md5($escapedPW);
    		$hashedPW = hash('sha256', $escapedPWN);

    		$check_user = $conn->query("SELECT * FROM dlikeaccounts where username = '$login_username' and password = '$hashedPW'");
    		if ($check_user->num_rows>0){$row_C = $check_user->fetch_assoc(); $dlike_username=$row_C['username'];
    			$dlike_user_login_url = 'https://dlike.io';
        		die(json_encode(['error' => false,'message' => 'Login Successful!','redirect' => $dlike_user_login_url,'dlikeuser' => $dlike_username]));
    		} else {die(json_encode(['error' => true,'message' => 'Login details does not match!'])); }
        } else {die(json_encode(['error' => true,'message' => $errors]));}
        //}else {die(json_encode(['error' => true,'message' => 'Verification failed, please try again']));}
} else {die('Some error');}
?>