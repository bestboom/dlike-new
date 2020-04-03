<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}
if (isset($_POST["v_permlink"]) && isset($_POST["v_author"])){

	$v_weight = validator($_POST["vote_value"]);
    $v_author = validator($_POST["v_author"]);
    $v_permlink = validator($_POST["v_permlink"]);
    $v_weight = (int) $v_weight;
    $voter =  $_COOKIE['username'];

	if (empty($errors)) { ?>

        <script type="text/javascript">
            console.log(username);
            voter = "<?php echo $voter ?>";
            author = "<?php echo $v_author ?>";
            permlink = "<?php echo $v_permlink ?>";
            weight = "<?php echo $v_weight ?>";

            api.vote(voter, author, permlink, weight, function (err, res) {
                console.log(err, res)
            });
        </script>

	<?php } ?>
    <!--
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
	} -->
<?php
} else {die('Some error');}
?>