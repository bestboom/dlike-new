<?php

namespace dlike\follow;

class makeFollow
{

    public function followMe($_json)
    {
        $do_follow = [
            "operations"=> [
                ["custom_json", [
                    "required_auths"=> [],
                    "required_posting_auths"=> $_COOKIE['access_token'],
                    "id"=> 'follow',
                    "json"=> $_json
                ]]
            ]
        ];
        $fixed_str = json_encode($do_follow);
        //print($fixed_str);
        return $fixed_str;
    }


    public function broadcast($post)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://steemconnect.com/api/broadcast",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: " . $_COOKIE['access_token'],
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return json_decode('{"error":"server_comms","error_description":"Failed to connect to the server!"}');
        } else {
            return json_decode($response);
        }
    }
}


$follower = 'goldenwhale';
echo $username = $_COOKIE['username'];
$response = [];

    $_json = ["follow",[
        "follower"=> $_COOKIE['username'],
        "following"=> $follower,
        "what"=>['blog']
    ]];

$voteGenerator = new dlike\follow\makeFollow();
    if (!empty($username)){

    $publish = $voteGenerator->followMe($_json);
    $state = $voteGenerator->broadcast($publish);

        if (array_key_exists("error",$state)){
            $response["success"] = false;
            $response["message"] = $state["error_description"];
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