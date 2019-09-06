<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}


//if (isset($_POST["url"])){
    $url = $_GET['url'];
    $sqls = "SELECT ext_url FROM steemposts WHERE ext_url = '$url' and created_at > now() - INTERVAL 48 HOUR"; 
    $resultAmount = $conn->query($sqls);
        if ($resultAmount->num_rows > 0) {

            echo 'url exist'; } else { echo 'New url'; }

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