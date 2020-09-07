<?php
require '../includes/config.php';
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
	$sql_post_limit = $conn->query("SELECT * FROM dlikeposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR");if ($sql_post_limit->num_rows >= 5) {die(json_encode(['error' => true, 'message' => 'Phew ... You reached max daily share limit!']));}
	$sql_unique_url = $conn->query("SELECT ext_url FROM dlikeposts WHERE ext_url = '$url' and created_at > now() - INTERVAL 300 HOUR"); if ($sql_unique_url->num_rows > 0) {die(json_encode(['error' => true, 'message' => 'URL already shared. Can not be shared again!']));}
	$redirect_url = 'https://dlike.io/post/' . $author .'/'. $permlink;
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