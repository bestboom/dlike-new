<?php

function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST["permlink"]) && isset($_POST["author"])){

	$v_weight = validator($_POST["weight"]);
    $p_author = validator($_POST["v_author"]);
    $p_permlink = validator($_POST["v_permlink"]);
    $user = validator($_POST["author"]);
    echo $v_weight = (int) $v_weight;


    $response["success"] = true;
    $response["message"] = "data Successfully";
}

?>