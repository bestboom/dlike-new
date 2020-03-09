<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';
require_once "../helper/publish_post.php";
include('../functions/main.php');

if (isset($_POST["story_title"]) && isset($_POST["story_tags"]) && isset($_POST["story_content"]) && isset($_POST["story_category"])){

	//$content = mysqli_real_escape_string($conn, $_POST['story_content']);

	$title = validationData($_POST["story_title"]);
	$permlink = validationData(clean($_POST["story_title"]));
	$post = validationData($_POST["story_content"]);
	$urlImage = $_POST["story_image"];

	$category = strtolower($_POST['story_category']);
	$parent_ctegory = 'hive-116221';
	$tags = "hive-116221,dlike," . preg_replace('#\s+#', ',', trim(strtolower($_POST['story_tags'])));

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

    $_POST['benefactor'] = "dlike:11,dlike.fund:2";
    $beneficiaries = genBeneficiaries($_POST['benefactor']);

    $posting_user = $_COOKIE['username'];
    $url = 'https://dlike.io/post/@' . $posting_user .'/'. $permlink;

	$json_metadata = [
    "community" => "dlike",
    "app" => "dlike/3",
    "format" => "html",
    "image" => $urlImage,
    "url" => $url,
    "body" => $post,
    "category" => $_POST['story_category'],
    "tags" => array_slice(array_unique(explode(",", $tags)), 0, 7)
	];

	$body = "\n\n#####\n\n " . $_POST['story_content'] . "  \n\n#####\n\n <center><hr><br><a href='https://dlike.io/post/@" . $posting_user . "/" . $permlink . "'><img src='https://dlike.io/images/dlike-logo.jpg'></a></center>";

	$check = ' reward' . $url . ' 2nd reward ' . $percent_steem_dollars . ' permlink ' . $permlink . ' category ' . $category . ' tags ' . $tags . ' user ' . $posting_user . ' body ' . $body;
	if ($title !='') {

			die(json_encode([
		    	'error' => false,
	    		'message' => 'Success', 
	    		'data' => $check
			]));
		} else {
			die(json_encode([
		    	'error' => true,
	    		'message' => 'Sorry post could not be published', 
	    		'data' => $state->error_description	
			]));
		}

	//} else { echo 'Something went wrong'; }
} else { echo 'some issue'; }
?>