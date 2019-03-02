<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	 $postauthor = $_POST['postath'];
	 $postpermlink = $_POST['postplink'];



	?>


	<script>
    let postauthor = <?php echo json_encode($postauthor); ?>;
    let postpermlink = <?php echo json_encode($postpermlink); ?>;


</script>