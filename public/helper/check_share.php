<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}


//if (isset($_POST["url"])){

    $sqls = "SELECT ext_url FROM steemposts WHERE created_at >= now() - INTERVAL 1 DAY"; 
    $resultAmount = $conn->query($sqls);
        if ($resultAmount->num_rows > 0) {

	/*if (empty($errors)) {
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
	} */

//} else {die('Some error');}
?>