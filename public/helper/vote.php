<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}


//if (isset($_POST["v_permlink"]) && isset($_POST["v_author"])){

	echo $v_weight = validator($_POST["vote_value"]);
    echo $v_author = validator($_POST["v_author"]);
    echo $v_permlink = validator($_POST["v_permlink"]);
    echo $v_weight = (int) $v_weight;


		if (empty($v_permlink)) {
			    die(json_encode([
			    	'error' => true,
            		'message' => 'Sorry', 
            		'data' => 'Already Upvoted'
            		
        		]));
		} else { 
			    die(json_encode([
            		'error' => false,
            		'message' => 'Thank You', 
            		'data' => 'Lets Upvote'
        		]));
		}

//

?>