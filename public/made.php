<?php include('template/header5.php'); ?>

<?php include('template/footer.php'); ?>
<script type="text/javascript">
	console.log(username);
	voter = username;
	author = 'myinns';
	permlink = 'what-are-the-challenges-of-battling-coronavirus-in-india-india-al-jazeera';
	weight = 1000;

	api.vote(voter, author, permlink, weight, function (err, res) {
  		console.log(err, res)
	});
</script>