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
	echo '<br>';
	echo $cat = $_POST['category'];
	echo '<br>';
	$_POST['tags'] = "dlike," . 'dlike-' . $cat . ',' . preg_replace('#\s+#', ',', trim(strtolower($_POST['tags'])));
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
	echo '<br>';
	echo $permlink = validationData(clean($_POST['title']));
	echo '<br>';
	$json_metadata = [
    "community" => "dlike",
    "app" => "dlike/1",
    "format" => "html",
    "image" => $urlImage,
    "url" => $url,
    "body" => $_POST["post"],    
    "category" => $_POST['category'],
    "scheduled_at" => $_POST['scheduled'],
    "tags" => array_slice(array_unique(explode(",", $_POST['tags'])), 0, 5)
];
	

?>
