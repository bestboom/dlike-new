<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_rewards.php";


$rewardGenerator = new dlike\rewards\claim_rewards();

if (isset($_POST["user"])){

	if (empty($errors)) {
    echo $state = json_encode($rewardGenerator->claim_all());
    //echo $rewards->get_reward_balances($rewards->me());
	}

	if ($state->result) { 
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
