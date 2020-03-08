<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

if (isset($_POST["story_title"]) && isset($_POST["story_tags"]) && isset($_POST["story_content"]) && isset($_POST["story_category"])){

	$content = mysqli_real_escape_string($conn, $_POST['story_content']);


	if($_POST['story_rewards']=='1'){
        $max_accepted_payout = "900.000 SBD";
        $percent_steem_dollars = 10000;
	} else if($_POST['story_rewards']=='2'){
        $max_accepted_payout = "900.000 SBD";
        $percent_steem_dollars = 0;
    } else if($_POST['story_rewards']=='3'){
        $max_accepted_payout = '0.000 SBD';
        $percent_steem_dollars = 10000;
    } else {
        $max_accepted_payout = '900.000 SBD';
		$percent_steem_dollars =10000;
    }

	if ($content !='') {

		die(json_encode([
	    	'error' => false,
    		'message' => 'Success', 
    		'data' => $content. ' reward' . $max_accepted_payout . ' 2nd reward ' . $percent_steem_dollars
		]));
		} else {
			die(json_encode([
		    	'error' => true,
        		'message' => 'Sorry', 
        		'data' => 'There is some issue'	
    		]));
		}

} else { echo 'some issue'; }
?>