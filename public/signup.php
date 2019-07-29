<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


echo $key    = getenv('accountKey');

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Steem Account Claim &amp; Create</title>
</head>

<body>
	<div class="container pt-3">
		<h1 class="text-center mb-5">Steem Account Claim &amp; Create</h1>

		<h3>Claim Discounted Account</h3>
		<form id="claim-account" method="POST">

			<div id="claim-account-feedback" class="alert"></div>

			<div class="row">
				<div class="col-md-3 col-lg-4">
					<div class="form-group">
						<label for="username" class="sr-only">Username</label>
						<input type="text" name="username" id="username" autocomplete="off" class="form-control"
							placeholder="Username" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="active-key" class="sr-only">Active Key</label>
						<input type="password" name="active-key" id="active-key" autocomplete="off" class="form-control"
							placeholder="Active Key">
						<p class="text-muted small mt-1">Leave this field blank to use Steem Keychain.</p>
					</div>
				</div>
				<div class="col-md-3 col-lg-2">
					<button class="btn btn-success btn-block" type="submit">Claim Account</button>
				</div>
			</div>
			<p class="text-muted">Please check <a href="https://beempy.com/resource_costs">Beempy.com</a> to find out
				how much RC is required.</p>
		</form>

		<hr>

		<h3>Create Claimed Account</h3>
		<form id="create-account" method="POST">

			<div id="create-account-feedback" class="alert"></div>

			<div class="form-group">
				<label for="new-account" class="text-dark">Account Username</label>
				<input type="text" name="new-account" id="new-account" autocomplete="off" class="form-control" required>
				<p class="text-muted">Enter the username you want to create.</p>
			</div>
			<div class="form-group">
				<label for="password" class="text-dark">Password</label>
				<input type="text" name="password" id="password" autocomplete="off" class="form-control" required>
				<p class="text-muted">Password of the new account. Please save it somewhere safe before you create the
					account.</p>
			</div>
			<div class="form-group">
				<label for="creator" class="text-dark">Creator Account</label>
				<input type="text" name="creator" id="creator" autocomplete="off" class="form-control" required>
				<p class="text-muted">Enter the account who will be paying the fee in claimed account credit.</p>
			</div>
			<div class="form-group">
				<label for="delegation" class="text-dark">Delegation</label>
				<input type="text" name="delegation" id="delegation" autocomplete="off" class="form-control"
					value="0.000 SP">
				<p class="text-muted">If you want to delegate some SP to your newly created account, enter the amount in
					SP.</p>
			</div>
			<div class="form-group">
				<label for="creator-key" class="text-dark">Active Key</label>
				<input type="password" name="creator-key" id="creator-key" autocomplete="off" class="form-control">
				<p class="text-muted">Enter creator account's PRIVATE ACTIVE KEY. <span class="small">Leave this field
						blank to use Steem Keychain.</span></p>
			</div>
			<button class="btn btn-success btn-block" type="submit">Create Account</button>
		</form>

		<hr>
		<p class="text-center">
			Brought to you by <a href="https://steemit.com/@reazuliqbal">@reazuliqbal</a>.<br>
			Open source <a href="https://github.com/CodeBull/AccountCreate">on GitHub</a>.
		</p>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/dsteem@^0.10.1/dist/dsteem.js"></script>
	<script src="js/account.js"></script>
</body>

</html>
