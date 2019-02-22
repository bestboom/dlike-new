<?php
include ('functions/main.php');
	echo $url = $_POST['exturl'];
	echo $urlImage = $_POST["image"];
	echo $title = $_POST['title'];

	$title = validationData($title);
	$permlink = validationData(clean($_POST['title']));
	$_POST['benefactor'] = "dlike:9,dlike.fund:1";

	echo $post = "<center><img src='" . $urlImage . "' alt='share-with-dlike' /></center>  \n\n#####\n\n " . $_POST['post'] . "  \n\n#####\n\n <center><br><a href='" . $url . "'>Source of shared Link</a><hr><br><a href='https://dlike.io/'><img src='https://dlike.io/special/dlike-logo.jpg'></a></center>";
	

?>
