<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_rewards.php";

$rewardGenerator = new SnaddyvitchDispenser\rewards\claim_rewards();

if (isset($_COOKIE["access_token"])){

	if (empty($errors)) {
    $state = $rewardGenerator->claim_all();
	}

	if ($state[0]) { 
			    die(json_encode([
			    	'error' => false,
            		'message' => 'Thankk You', 
            		'data' => 'Claiming'
            		
        		]));
	} else {
			    die(json_encode([
            		'error' => true,
            		'message' => 'Sorry', 
            		'data' => 'Some Issue'
        		]));
	} 

} else {die('Some error');}
?>
