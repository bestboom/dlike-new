<?php include('template/header5.php');
$urlImage = 'https://i.postimg.cc/d0Vf2w92/hummingbird.jpg';
$description = 'This is a test on steem posting';
$body = "<center><img src='" . $urlImage . "' alt='New Share' /></center>  \n\n#####\n\n '" . $description . "'  \n\n#####\n\n <center><br><a href='https://steemit.com/'>Posting Test</a><hr><br>";

include('template/footer.php'); ?>
<script type="text/javascript">
	console.log(username);
	parentAuthor = '';
	parentPermlink = 'test';
	author = username;
	permlink = 'a-new-steem-test-4';
	title = 'posting test';
	body = "<?php echo $body ?>";
	jsonMetadata = {
	    "tags": [
	        "test, steem"
	    ],
	    "app": "steemit\/0.1",
	    "community": "steem"
	}
	console.log(body)


	api.comment(parentAuthor, parentPermlink, author, permlink, title, body, jsonMetadata, function (err, res) {
  		console.log(err, res)
	});
</script>