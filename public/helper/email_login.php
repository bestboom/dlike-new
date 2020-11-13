<?php 
require '../includes/config.php';
if (isset($_POST['login_username'])  && $_POST['login_username'] != '' && isset($_POST['login_pass'])  && $_POST['login_pass'] != '') { 
    $token=$_POST["g_catch"]; 
    $g_ip=$_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?";
    $data = array('secret' => $recpatch_key, 'response' => $token, 'remoteip'=> $g_ip);
    $options = array('http' => array('method'  => 'POST','content' => http_build_query($data)));
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $g_response = json_decode($result);
    print_r($g_response);
    if($g_response->success){
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
    }else {die(json_encode(['error' => true,'message' => 'Captcha check failed!']));}
} else {die('Some error');}
?>