<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_unfollow.php";

$follower = 'goldenwhale';
echo $username = $_COOKIE['username'];
$response = [];

    $_json = ['follow',[
        'follower'=> $username,
        'following'=> $follower,
        'what'=>[]
    ]];

$voteGenerator = new dlike\unfollowit\makeunFollow();
    if (!empty($username)){

    $publish = $voteGenerator->unfollowMe($username, $_json);
    $state = $voteGenerator->broadcast($publish);
    //var_dump($state);
        if (isset($state->error)){
            $response["success"] = false;
            $response["message"] = $state->error_description;
        }else{
            $response["success"] = true;
            $response["message"] = "You Unfollowed Successfully";
        }

    }
print json_encode($response);
?>