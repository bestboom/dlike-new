<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_follow.php";

function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST["profname"])) {
    $follower = validator($_POST["profname"]);
    $username = $_COOKIE['username'];
    $response = [];

        $_json = ['follow',[
            'follower'=> $username,
            'following'=> $follower,
            'what'=>['blog']
        ]];

    $followGenerator = new dlike\followit\makeFollow();
        if (!empty($username) && ($username != $follower )){

            $publish = $followGenerator->followMe($username, $_json);
            $state = $followGenerator->broadcast($publish);
        
            if (isset($state->error)){
                $response["success"] = false;
                $response["message"] = "Some Error";
            }else{
                $response["success"] = true;
                $response["message"] = "You Followed Successfully";
            }
        }
} else {die('Invalid Data');}        
?>