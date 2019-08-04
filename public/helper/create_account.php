<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
//print_r($_POST);
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

    $return = array();
    $return['status'] = false;
    $return['message'] = '';
    
   // echo 555;

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){
 $user = $_POST['user'];


    if ($_POST['user'] !='') {
  //  echo 12345;
            $state = shell_exec('/usr/local/bin/node app/public/js/newAccount.js '.$user); 
        $password = $state; // to check if trim() is causing error
           // $password = trim($state); // do what you want with the password here

            //echo json_encode($password); // this is the password
            $return['status'] = true;
            $return['message'] = 'account created'.$password;
        $return['password'] = $password;
        
        echo json_encode($return);
        
       
    }
} else {die('Some error');}
    
    
?>
