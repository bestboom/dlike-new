<?php include('template/header5.php'); ?>

<?php include('template/footer.php'); ?>
<script type="text/javascript">
	console.log(username);
	voter = username;
	author = 'indegassi';
	permlink = 'spain-sheds-nearly-900000-jobs-since-coronavirus-lockdown--reuters';
	weight = 1000;

	api.vote(voter, author, permlink, weight, function (err, res) {
  		console.log(err, res)
	});
</script>