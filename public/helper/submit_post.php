<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish.php";
include('../functions/main.php');

$postGenerator = new snaddyvitch_dispenser\operations\makePost();



	$url = $_POST['exturl'];
	$urlImage = $_POST["image"];
	$title = $_POST['title'];
	$_POST['benefactor'] = "dlike:9,dlike.fund:1";
	$category = $_POST['category'];
	$_POST['tags'] = "dlike," . 'dlike-' . $category . ',' . preg_replace('#\s+#', ',', trim(strtolower($_POST['tags'])));

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

	$title = validationData($title);
	$permlink = validationData(clean($_POST['title']));
	
	$json_metadata = [
    "community" => "dlike",
    "app" => "dlike/1",
    "format" => "html",
    "image" => $urlImage,
    "url" => $url,
    "body" => $_POST["description"],    
    "category" => $_POST['category'],
    "tags" => array_slice(array_unique(explode(",", $_POST['tags'])), 0, 5)
	];
	
	$post = "<center><img src='" . $urlImage . "' alt='Dhared From Dlike' /></center>  \n\n#####\n\n " . $_POST['description'] . "  \n\n#####\n\n <center><br><a href='" . $url . "'>Source of shared Link</a><hr><br><a href='https://dlike.io/'><img src='https://dlike.io/images/dlike-logo.jpg'></a></center>";

	if (empty($errors)) {
    $post = $postGenerator->createPost($title, $post, $json_metadata, $permlink, genBeneficiaries($_POST['benefactor']), $category, $max_accepted_payout, $percent_steem_dollars);
    $state = $postGenerator->broadcast($post);
	}

	if (isset($state->result)) { ?>
    <script type="text/javascript">
        window.location = "https://dlike.io/";
    </script>
<? 	} else {
		echo $state->error_description;
	} 
?>
