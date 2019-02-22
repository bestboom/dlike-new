<?php
include ('functions/main.php');
	echo $url = $_POST['exturl'];
	echo '<br>';
	echo $urlImage = $_POST["image"];
	echo '<br>';
	echo $title = $_POST['title'];
	echo '<br>';
	$_POST['benefactor'] = "dlike:9,dlike.fund:1";
	echo '<br>';
	echo $post = "<center><img src='" . $urlImage . "' alt='share-with-dlike' /></center>  \n\n#####\n\n " . $_POST['post'] . "  \n\n#####\n\n <center><br><a href='" . $url . "'>Source of shared Link</a><hr><br><a href='https://dlike.io/'><img src='https://dlike.io/special/dlike-logo.jpg'></a></center>";

	$max_accepted_payout = '900.000 SBD';
	$percent_steem_dollars =10000;

	if(isset($_POST['reward_option'])){
    	if($_POST['reward_option']=='2'){
        	$max_accepted_payout = "900.000 SBD";
        	$percent_steem_dollars = 0;
    	} else if($_POST['reward_option']=='3'){
        	$max_accepted_payout = '0.000 SBD';
        	$percent_steem_dollars = 10000;
    	}
	}
	echo $max_accepted_payout;
	echo $title = validationData($title);
	$permlink = validationData(clean($_POST['title']));
	

?>
