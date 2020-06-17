<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
	

	$redirect_url = 'https://dlike.io/post/@' . $author .'/'. $permlink;

	if ($title !='') {

		$addposts = "INSERT INTO dlikeposts (`username`,`title`, `permlink`, `ext_url`, `img_url`, `ctegory`, `description`, `tags`, `created_at`) VALUES ('".$author."','".$title."', '".$permlink."', '".$url."', '".$urlImage."', '".$category."', '".$body."', '".$tags."','".date("Y-m-d H:i:s")."')";
		$addpostsquery = $conn->query($addposts);


			//send success message
		die(json_encode([
	    	'error' => false,
    		'redirect' => $redirect_url, 
    		'message' => 'Post Published!'
		]));
		} else {
			die(json_encode([
		    	'error' => true,
	    		'message' => 'Error while Publishing Post!'	
			]));
		}
} else { echo 'some issue'; }
?>