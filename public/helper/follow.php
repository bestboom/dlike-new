<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = 1;
 $follower = 'goldenwhale';
$following = $_COOKIE['username'];
$response = [];
//if (isset($_POST["auth"]) && isset($_POST["p_auth"])){

    $_json = ["follow",[
        "follower"=> $follower,
        "following"=> $following,
        "what"=>['blog']
        ]];
    if (!empty($userName)){
        $voteOptions = [
            "operations"=> [
                ["custom_json", [
                    "required_auths"=> $follow,
                    "required_posting_auths"=> $following,
                    "id"=> $id,
                    "json"=> $_json
                ]]
            ]
        ];
        $response["user"] = $_COOKIE['username'];
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


?>