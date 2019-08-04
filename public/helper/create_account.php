<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

print_r($_POST);
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['username'])  && $_POST['username'] != ''){
 
    $return = array();
    $return['status'] = false;
    $return['message'] = '';

    if ($_POST['username'] !='') {
        try {
            $state = shell_exec('node js/newAccount.js '.$user); 
        
            $password = trim($state); // do what you want with the password here

            echo json_encode($password); // this is the password
            $return['status'] = true;
            $return['message'] = 'account created'.$password;
        
        } catch (Exception $e) {
echo $e->getMessage();
        $return['status'] = false;
        $return['message'] = $e->getMessage();
        echo json_encode($message);


        }
    }
} else {die('Some error');}
?>
