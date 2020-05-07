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
	$_POST['benefactor'] = "dlike:11,dlike.fund:2";
	$category = strtolower($_POST['category']);
	$parent_ctegory = 'hive-116221';
	$_POST['tags'] = "hive-116221,dlike," . preg_replace('#\s+#', ',', trim(strtolower($_POST['tags'])));

	$_POST["description"] = preg_replace('#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#', '', $_POST["description"]);

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


	if (empty($errors)) {
    $publish = $postGenerator->createPost($title, $body, $json_metadata, $permlink, genBeneficiaries($_POST['benefactor']), $parent_ctegory, $max_accepted_payout, $percent_steem_dollars);
    $state = $postGenerator->broadcast($publish);
	}

	if (isset($state->result)) { 
		// insert into DB	
		$tags = $_POST['tags'];
		$post_title= mysqli_real_escape_string($conn, $_POST['title']);
		$addposts = "INSERT INTO steemposts (`username`,`title`, `permlink`, `ext_url`, `img_url`, `parent_ctegory`,`created_at`) VALUES ('".$_COOKIE['username']."','".$post_title."', '".$permlink."', '".$url."', '".$urlImage."', '".$category."','".date("Y-m-d H:i:s")."')";
		$addpostsquery = $conn->query($addposts);

		$posts_tags = array_unique(explode(",",$_POST['tags']));
		if(count($posts_tags)>0)  {
			foreach($posts_tags as $p_tag) {
				$add_tags = $conn->query("INSERT INTO posttags (`tagname`,`updated_at`) VALUES ('".$p_tag."','".date("Y-m-d H:i:s")."')");
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
<?	} 	?>
<script>
	function goBack() {window.history.back()}
</script>