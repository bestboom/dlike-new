<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_unfollow.php";
$unfollowGenerator = new dlike\unfollowit\makeunFollow();
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}
$response = [];
if (isset($_POST["profname"])) {

    $follower = validator($_POST["profname"]);
    $username = $_COOKIE['username'];

        $_json = ['follow',[
            'follower'=> $username,
            'following'=> $follower,
            'what'=>[]
        ]];

        if (!empty($username) && ($username != $follower )){  

        $publish = $unfollowGenerator->unfollowMe($username, $_json);
        $state = $unfollowGenerator->broadcast($publish);

            if (isset($state)){
                $response["status"] = true;
                $response["message"] = "You UNFollowed Successfully";  
                echo json_encode($response);die;  
            }else{   
                $response["status"] = false;
                $response["message"] = "Some Error";  
                echo json_encode($response);die;         
            }    
         
        }

} else {die('Invalid Data');}
?>