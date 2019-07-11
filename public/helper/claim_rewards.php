<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_rewards.php";


$rewardGenerator = new dlike\rewards\claim_rewards();

if (isset($_POST["user"])){

	if (empty($errors)) {

    public function claim_all() {
        $get = $this->get_reward_balances($this->me());
        if ($get != null) {
            $claim = $this->raw_claim($get);
            $ret = $this->broadcast($claim);
            if (isset($ret->error_description) and $ret->error_description == "reward_steem.amount > 0 || reward_sbd.amount > 0 || reward_sbd.amount > 0 || reward_sp.amount > 0: Must claim something.") {
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
        } else {
            return [false, []];
        }
    }
    //echo $state = json_encode($rewardGenerator->claim_all());
    //echo $rewards->get_reward_balances($rewards->me());
	}

	//if ($state->result) { 
	//		    die(json_encode([
	//		    	'error' => false,
    //        		'message' => 'Thankk You', 
    //        		'data' => 'Claiming'
            		
    //    		]));
	//} else {
	//		    die(json_encode([
    //        		'error' => true,
    //        		'message' => 'Sorry', 
    //        		'data' => 'Some Issue'
    //    		]));
	//} 

} else {die('Some error');}
?>
