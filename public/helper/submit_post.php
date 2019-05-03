<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
require '../includes/config.php';
require_once "../helper/publish_post.php";
include('../functions/main.php');

$postGenerator = new dlike\post\makePost();

	$url = $_POST['exturl'];
	$urlImage = $_POST["image"];
	$title = $_POST['title'];
	$_POST['benefactor'] = "dlike:9,dlike.fund:1";
	$category = strtolower($_POST['category']);
	$parent_ctegory = 'dlike';
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

	$beneficiaries = genBeneficiaries($_POST['benefactor']);

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
	
	$body = "<center><img src='" . $urlImage . "' alt='Dhared From Dlike' /></center>  \n\n#####\n\n " . $_POST['description'] . "  \n\n#####\n\n <center><br><a href='" . $url . "'>Source of shared Link</a><hr><br><a href='https://dlike.io/'><img src='https://dlike.io/images/dlike-logo.jpg'></a></center>";

		/*
        $json_php_array = $json_metadata;
        $json_meta = json_encode($json_php_array);
        $postOptions = [
            "operations" => [
                ["comment", [
                    "parent_author" => "",
                    "parent_permlink" => $category,
                    "title" => $title,
                    "body" => $body,
                    "json_metadata" => $json_meta,
                    "author" => $_COOKIE['username'],
                    "permlink" => $permlink
                ]],
                ["comment_options", [
                    "author" => $_COOKIE['username'],
                    "permlink" => $permlink,
                    "max_accepted_payout" => $max_accepted_payout,
                    "percent_steem_dollars" => $percent_steem_dollars,
                    "allow_votes" => true,
                    "allow_curation_rewards" => true,
                    "extensions" => []
                ]]
            ]
        ];

        if ($beneficiaries != []) {
            $postOptions["operations"][1][1]["extensions"] = [[0, ["beneficiaries" => $beneficiaries]]];
        }


	if (empty($errors)) {
    $post = $postGenerator->publish($postOptions);
    $state = $postGenerator->broadcast($post);
	}

	if (isset($state->result)) { ?>
    <script type="text/javascript">
        window.location = "https://dlike.io/";
    </script>
<? 	} else {
		echo $state->error_description;
	} 
	*/



	if (empty($errors)) {
    $publish = $postGenerator->createPost($title, $body, $json_metadata, $permlink, genBeneficiaries($_POST['benefactor']), $parent_ctegory, $max_accepted_payout, $percent_steem_dollars);
    $state = $postGenerator->broadcast($publish);
	}

	if (isset($state->result)) { 
	
		
?>
    <script type="text/javascript">
        window.location = "https://dlike.io/";
    </script>
<? 	} else {
		echo $state->error_description;
	} 
	
?>
