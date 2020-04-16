<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';
require_once "../helper/post/publish_post.php";
include('../functions/main.php');

$postGenerator = new dlike\post\makePost();

if (isset($_POST["story_title"]) && isset($_POST["story_tags"]) && isset($_POST["story_content"]) && isset($_POST["story_category"])){

	//$content = mysqli_real_escape_string($conn, $_POST['story_content']);

	$title = validationData($_POST["story_title"]);
	$permlink = validationData(clean($_POST["story_title"]));
	$_POST["story_content"] = preg_replace('#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#', '', $_POST["story_content"]);
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

    $_POST['benefactor'] = "dlike:7.5,dlike.fund:2.5";
    $beneficiaries = genBeneficiaries($_POST['benefactor']);

    $posting_user = $_COOKIE['username'];
    $url = 'https://dlike.io/post/@' . $posting_user .'/'. $permlink;

	$json_metadata = [
    "community" => "dlike",
    "app" => "dlike/3",
    "format" => "html",
    "image" => $urlImage,
    "url" => $url,
    "body" => $_POST['meta_body'],
    "type" => "story",
    "category" => $_POST['story_category'],
    "tags" => array_slice(array_unique(explode(",", $tags)), 0, 7)
	];

	$body = "\n\n#####\n\n " . $_POST['story_content'] . "  \n\n#####\n\n <center><hr><br><a href='https://dlike.io/post/@" . $posting_user . "/" . $permlink . "'><img src='https://dlike.io/images/dlike-logo.jpg'></a></center>";

	if ($title !='') {
		$publish = $postGenerator->createPost($title, $body, $json_metadata, $permlink, genBeneficiaries($_POST['benefactor']), $parent_ctegory, $max_accepted_payout, $percent_steem_dollars);
    	$state = $postGenerator->broadcast($publish);

    	if (isset($state->result)) { 
	    	// insert into DB
			$post_title= mysqli_real_escape_string($conn, $_POST['story_title']);
			$addposts = "INSERT INTO steemposts (`username`,`title`, `permlink`, `ext_url`, `img_url`, `parent_ctegory`,`created_at`) VALUES ('".$posting_user."','".$post_title."', '".$permlink."', '".$url."', '".$urlImage."', '".$category."','".date("Y-m-d H:i:s")."')";
			$addpostsquery = $conn->query($addposts);

			$posts_tags = array_unique(explode(",",$_POST['story_tags']));
			if(count($posts_tags)>0)  {
				foreach($posts_tags as $p_tag) {
					$add_tags = $conn->query("INSERT INTO posttags (`tagname`,`updated_at`) VALUES ('".$p_tag."','".date("Y-m-d H:i:s")."')");
				}
			}
			//send success message
			die(json_encode([
		    	'error' => false,
	    		'message' => 'Success',
	    		'redirect' => $url, 
	    		'data' => 'Post Published!'
			]));
		} else {
			die(json_encode([
		    	'error' => true,
	    		'message' => 'Sorry post could not be published', 
	    		'data' => $state->error_description	
			]));
		}

	} else { echo 'Something went wrong'; }
} else { echo 'some issue'; }
?>