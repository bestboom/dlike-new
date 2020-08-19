<?php
require '../../includes/config.php';

if (isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["author"]) && isset($_POST["image"])){

	$author = trim(mysqli_real_escape_string($conn, $_POST['author']));
	$url = mysqli_real_escape_string($conn, $_POST['exturl']);
	$urlImage = mysqli_real_escape_string($conn, $_POST["image"]);
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$permlink = mysqli_real_escape_string($conn, $_POST['permlink']);
	$category = strtolower(mysqli_real_escape_string($conn, $_POST['category']));
	$tags = trim(strtolower(mysqli_real_escape_string($conn, $_POST['tags'])));
	$body = mysqli_real_escape_string($conn, $_POST['description']);
	$verifyUrl = mysqli_real_escape_string($conn, $_POST['in_url']);
	
	if (in_array($verifyUrl, $restricted_urls)){die(json_encode(['error' => true, 'message' => 'phew... Sharing from this url is not allowed']));}

	$redirect_url = 'https://dlike.io/post/' . $author .'/'. $permlink;
	//$redirect_url = 'https://dlike.io/index2.php';
	if ($title !='') {
		$addposts = $conn->query("INSERT INTO dlikeposts (`username`,`title`,`permlink`,`ext_url`,`img_url`, `ctegory`, `description`, `tags`, `created_at`) VALUES ('".$author."','".$title."', '".$permlink."', '".$url."', '".$urlImage."', '".$category."', '".$body."', '".$tags."','".date("Y-m-d H:i:s")."')");
		$posts_tags = array_unique(explode(" ",$tags));
		if(count($posts_tags)>0)  {
			foreach($posts_tags as $p_tag) {
				$add_tags = $conn->query("INSERT INTO dlike_tags (`tag`,`author`,`permlink`,`created_time`) VALUES ('".$p_tag."','".$author."','".$permlink."','".date("Y-m-d H:i:s")."')");
			}
		}
		die(json_encode(['error' => false,'redirect' => $redirect_url,'message' => 'Link Shared Successfully!']));
	} else {die(json_encode(['error' => true,'message' => 'Some error in this link sharing!']));}
} else { echo 'some issue. Please Try Later'; }
?>