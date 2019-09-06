<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
	
	$body = "<center><img src='" . $urlImage . "' alt='Shared From Dlike' /></center>  \n\n#####\n\n " . $_POST['description'] . "  \n\n#####\n\n <center><br><a href='" . $url . "'>Source of shared Link</a><hr><br><a href='https://dlike.io/'><img src='https://dlike.io/images/dlike-logo.jpg'></a></center>";

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
		
		$jsonmetadata = [
    		"image" => $urlImage,
    		"url" => $url,   
    		"category" => $_POST['category']
		];
		
		
	$beneficiaries = json_encode(genBeneficiaries($_POST['benefactor']),JSON_UNESCAPED_SLASHES);
		$addposts = "INSERT INTO steemposts (`username`,`title`, `body`, `json_metadata`, `permlink` , `benefactor` , `parent_ctegory`,`max_accepted_payout`,`percent_steem_dollars`,`created_at`) VALUES ('".$_COOKIE['username']."','".$title."', '".$_POST['description']."', '".json_encode($jsonmetadata,JSON_UNESCAPED_SLASHES)."', '".$permlink."', '".$beneficiaries."', '".$category."', '".$max_accepted_payout."', '".$percent_steem_dollars."','".date("Y-m-d H:i:s")."')";

	$addpostsquery = $conn->query($addposts);
	$post_id = mysqli_insert_id($conn);

$posts_tags = array_unique(explode(",",$_POST['tags']));
if(count($posts_tags)>0 && $post_id > 0) {
	foreach($posts_tags as $p_tag) {
		$sql = "SELECT * FROM posttags WHERE tagname = '$p_tag' LIMIT 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$setcounter = $row['tagcount']+1;
				$setpostids = $row['postid'].",".$post_id;
				$main_id = $row['id'];
			}
			$update_posttagscounter = $conn->query("UPDATE posttags set `tagcount` = '".$setcounter."',`postid` = '".$setpostids."', `updated_at` = '".date("Y-m-d H:i:s")."' where `id` = '".$main_id."'");
		}
		else {
			$setcounter = 1;
			$setpostids = $post_id;
			$insert_posttagscounter = $conn->query("INSERT INTO posttags (`tagname`, `postid`, `tagcount`,`updated_at`) VALUES ('".$p_tag."', '".$setpostids."', '".$setcounter."','".date("Y-m-d H:i:s")."')");
		}
	}
}
		
?>
    <script type="text/javascript">
        window.location = "https://dlike.io/";
    </script>
<? 	} else { ?>
		
	<div style="margin-top: 10%;position:relative;min-height:95vh;">
		<center>
			<div style="background-color: #ff6600;max-width: 550px;color:#111;border-radius: 5px;font-family:tahoma;">
				<div style="min-height:400px;padding:30px;padding-top: 30%;">
					<h3 style="color:#fff;">There seems some error!</h3>
					<h4 style="color:#fff;">Please contact support if issue persist</h4><br>
					<?php echo '<p style="border-top: 1px dashed #111;border-bottom: 1px dashed #111;padding:8px;">' . $state->error_description . '</p>';
					?>
					<br>
					<button style="padding: 7px 10px;background: #fff;border: 1px solid #111;color: #111;border-radius: 4px;cursor: pointer;" onclick="goBack()">Go Back</button>
				</div>
			</div>
		</center>
	</div>
<?	} 
	
?>
<script>
	function goBack() {window.history.back()}
</script>