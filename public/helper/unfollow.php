<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_unfollow.php";
$unfollowGenerator = new dlike\unfollowit\makeunFollow();
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST["profname"])) {

    $follower = validator($_POST["profname"]);
    $username = $_COOKIE['username'];
    
    $return = array();
    $return['status'] = false;
    $return['message'] = '';

        $_json = ['follow',[
            'follower'=> $username,
            'following'=> $follower,
            'what'=>[]
        ]];

        if (!empty($username) && ($username != $follower )){

        $publish = $unfollowGenerator->unfollowMe($username, $_json);
        $state = $unfollowGenerator->broadcast($publish);

            if (isset($state->error)){
                //$return["status"] = false;
                $return["message"] = "Some Error";
            }else{
                $return["status"] = true;
                $return["message"] = "You Unfollowed Successfully";
            }    
        }
        echo json_encode($return);die; 
} else {die('Invalid Data');}
?>