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
	    $publish = $postGenerator->createPost($title, $body, $json_metadata, $permlink, genBeneficiaries($_POST['benefactor']), $parent_ctegory, $max_accepted_payout, $percent_steem_dollars);
	    $state = $postGenerator->broadcast($publish);

		if (isset($state->result)) { 
			// insert into DB	
			$post_title= mysqli_real_escape_string($conn, $_POST['title']);
			$addposts = "INSERT INTO steemposts (`username`,`title`, `permlink`, `ext_url`, `img_url`, `parent_ctegory`,`created_at`) VALUES ('".$_COOKIE['username']."','".$post_title."', '".$permlink."', '".$url."', '".$urlImage."', '".$category."','".date("Y-m-d H:i:s")."')";
			$addpostsquery = $conn->query($addposts);

			$posts_tags = array_unique(explode(",",$_POST['tags']));
			if(count($posts_tags)>0)  {
				foreach($posts_tags as $p_tag) {
					$add_tags = $conn->query("INSERT INTO posttags (`tagname`,`updated_at`) VALUES ('".$p_tag."','".date("Y-m-d H:i:s")."')");
				}
			}
			//send success message
			die(json_encode([
		    	'error' => false,
	    		'redirect' => $redirect_url, 
	    		'message' => 'Post Published!'
			]));
		} else {
			die(json_encode([
		    	'error' => true,
	    		'message' => $state->error_description	
			]));
		}
	} else { echo 'Something went wrong'; }	
} else { echo 'some issue'; }
?>