<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_follow.php";

$follower = '@crypto.genius';
echo $username = $_COOKIE['username'];
$response = [];

    $_json = ["follow",[
        "follower"=> $_COOKIE['username'],
        "following"=> $follower,
        "what"=>['blog']
    ]];

$voteGenerator = new dlike\follow\makeFollow();
    if (!empty($username)){

    $publish = $voteGenerator->followMe($username, $_json);
    $state = $voteGenerator->broadcast($publish);

        if (array_key_exists("error",$state)){
            $response["success"] = false;
            $response["message"] = $state->error_description;
        }else{
            $response["success"] = true;
            $response["message"] = "You Followed Successfully";
        }

    }
print json_encode($response);
var_dump($state);


/*
echo $username = $_COOKIE['username'];

$id = 1;
$follower = 'goldenwhale';
$following = $_COOKIE['username'];
$response = [];
//if (isset($_POST["auth"]) && isset($_POST["p_auth"])){

    $_json = ["follow",[
        "follower"=> $_COOKIE['username'],
        "following"=> $follower,
        "what"=>['blog']
        ]];
    if (!empty($username)){
        $voteOptions = [
            "operations"=> [
                ["custom_json", [
                    "required_auths"=> [],
                    "required_posting_auths"=> $_COOKIE['access_token'],
                    "id"=> 'follow',
                    "json"=> $_json
                ]]
            ]
        ];
        $response["user"] = $_COOKIE['access_token'];
        $steemconnect->url = "https://steemconnect.com/api/broadcast";
        $steemconnect->headers[] = "accept: application/json";
        $steemconnect->vote($voteOptions);
        $steem_res = get_object_vars($steemconnect->HttpResponse($steemconnect));
        if (array_key_exists("error",$steem_res)){
            $response["success"] = false;
            $response["message"] = $steem_res["error_description"];
        }else{
            $response["success"] = true;
            $response["message"] = "You Followed Successfully";
        }
    } else{$response["user"] = "";
        $response["success"] = false;
        $response["message"] = "No Vailid user session";
    }
//}else{
//    $response["user"] = "";
//    $response["success"] = false;
//   $response["message"] = "Parameter empty";
//}
print json_encode($response);
var_dump($steem_res);

*/
?>