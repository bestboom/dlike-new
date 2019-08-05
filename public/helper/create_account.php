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

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){
 $user = $_POST['user'];


    if ($_POST['user'] !='') {
        $here = dirname(__FILE__);
        //$state = shell_exec("node {$here}/../js/newAccount.js \"{$user}\""); 
    
        //$password = trim($state); // do what you want with the password here

        $password = 'faflfnbdubbdklmajALDSakasDDd';

        
        if($password !=''){
            $return['status'] = true;
            $return['message'] = 'Account Created Successfully';
            $return['password'] = $password;
            
        }
        else 
       {
           $return['status'] = false;
           $return['message'] = 'Some Error';
           //echo json_encode($return);die;
       }
        
        echo json_encode($return);die;
       
    }
} else {die('Some error');}
    
        //echo json_encode($password); // this is the password
        //$password = $state; // to check if trim() is causing error    
?>
