<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_follow.php";
$followGenerator = new dlike\followit\makeFollow();
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}
//$response = [];
if (isset($_POST["profname"])) {
    $follower = validator($_POST["profname"]);
    $username = $_COOKIE['username'];

        $_json = ['follow',[
            'follower'=> $username,
            'following'=> $follower,
            'what'=>['blog']
        ]];

        if (!empty($username) && ($username != $follower )){

            $publish = $followGenerator->followMe($username, $_json);
            $state = $followGenerator->broadcast($publish);
        
            if (isset($state)){
                //$response["status"] = false;
                //$response["message"] = "Some Error";
                die(json_encode([
                    'error' => false,
                    'message' => 'You Followed Successfully', 
                    'data' => 'following'
                ]));      
            }else{
                //$response["status"] = true;
                //$response["message"] = "You Followed Successfully";
                    
                die(json_encode([
                    'error' => true,
                    'message' => 'Some Error', 
                    'data' => 'looks some issue'
                ]));              
            }      
          
        }
        //echo json_encode($response);die; 
} else {die('Invalid Data');}    
var_dump($state);  
?>