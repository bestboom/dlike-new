<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_vote.php";

function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

$voteGenerator = new dlike\vote\makeVote();

if (isset($_POST["v_permlink"]) && isset($_POST["v_author"])){

	$v_weight = validator($_POST["vote_value"]);
    $v_author = validator($_POST["v_author"]);
    $v_permlink = validator($_POST["v_permlink"]);
    $v_weight = $v_weight*100
    $v_weight = (int) $v_weight;

	if (empty($errors)) {
    $publish = $voteGenerator->createVote($v_weight, $v_author, $v_permlink);
    $state = $voteGenerator->broadcast($publish);
	}

	if (isset($state->result)) { 
			    die(json_encode([
			    	'error' => false,
            		'message' => 'Thankk You', 
            		'data' => 'Upvoting'
            		
        		]));
	} else {
			    die(json_encode([
            		'error' => true,
            		'message' => 'Sorry', 
            		'data' => 'Already Upvoted'
        		]));
	} 

} else {die('Some error');}
?>
