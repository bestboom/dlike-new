<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

$response = [];
if (isset($_POST["permlink"]) && isset($_POST["author"])){

	$v_weight = validator($_POST["weight"]);
    $p_author = validator($_POST["v_author"]);
    $p_permlink = validator($_POST["v_permlink"]);
    $user = validator($_POST["author"]);
    echo $v_weight = (int) $v_weight;

    if (!empty($user)){

    	$voteOptions = [
            "operations"=> [
                ["vote", [
                    "voter"=> $user,
                    "author"=> $p_author,
                    "permlink"=> $p_permlink,
                    "weight"=> $v_weight
                ]]
            ]
        ];


}
print json_encode($response);

?>