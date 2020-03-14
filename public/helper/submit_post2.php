<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';
require_once "../helper/publish_post.php";
include('../functions/main.php');

$postGenerator = new dlike\post\makePost();

if (isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["image"])){

	$url = $_POST['exturl'];
	$urlImage = $_POST["image"];
	$title = $_POST['title'];
	$_POST['benefactor'] = "dlike:11,dlike.fund:2";
	$category = strtolower($_POST['category']);
	$parent_ctegory = 'hive-116221';
	$_POST['tags'] = "hive-116221,dlike," . preg_replace('#\s+#', ',', trim(strtolower($_POST['tags'])));

	$_POST["description"] = preg_replace('#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#', '', $_POST["description"]);

	if($_POST['rewards']=='1'){
        $max_accepted_payout = "900.000 SBD";
        $percent_steem_dollars = 10000;
	} else if($_POST['rewards']=='2'){
        $max_accepted_payout = "900.000 SBD";
        $percent_steem_dollars = 0;
    } else if($_POST['rewards']=='3'){
        $max_accepted_payout = '0.000 SBD';
        $percent_steem_dollars = 10000;
    } else {
        $max_accepted_payout = '900.000 SBD';
		$percent_steem_dollars =10000;
    }

	$title = validationData($title);
	$permlink = validationData(clean($_POST['title']));
	$post = validationData($_POST["description"]);

	$beneficiaries = genBeneficiaries($_POST['benefactor']);

	$json_metadata = [
    "community" => "dlike",
    "app" => "dlike/3",
    "format" => "html",
    "image" => $urlImage,
    "url" => $url,
    "body" => $post,
    "type" => "share",
    "category" => $_POST['category'],
    "tags" => array_slice(array_unique(explode(",", $_POST['tags'])), 0, 7)
	];
	$posting_user = $_COOKIE['username'];
	$body = "<center><img src='" . $urlImage . "' alt='Shared From Dlike' /></center>  \n\n#####\n\n " . $_POST['description'] . "  \n\n#####\n\n <center><br><a href='https://dlike.io/post/@" . $posting_user . "/" . $permlink . "'>Shared On DLIKE</a><hr><br><a href='https://dlike.io/'><img src='https://dlike.io/images/dlike-logo.jpg'></a></center>";

	$redirect_url = 'https://dlike.io/post/@' . $posting_user .'/'. $permlink;
		if ($title !='') {

			//send success message
			die(json_encode([
		    	'error' => false,
	    		'message' => 'Success',
	    		'redirect' => $redirect_url, 
	    		'data' => 'Post Published!'
			]));
		} else {
			die(json_encode([
		    	'error' => true,
	    		'message' => 'Sorry post could not be published', 
	    		'data' => '$state->error_description'	
			]));
		}
	//} else { echo 'Something went wrong'; }	
} else { echo 'some issue'; }
?>