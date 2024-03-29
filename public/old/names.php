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
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://unpkg.com/dsteem@^0.10.1/dist/dsteem.js"></script>
	<script type="text/javascript">
		const client = new dsteem.Client('https://api.steemit.com');

// Checking if the already exists
async function checkAccountName(username) {
  const ac = await client.database.call('lookup_account_names', [[username]]);

  return (ac[0] === null) ? true : false;
}

// Returns an account's Resource Credits data
async function getRC(username) {
  return client.call('rc_api', 'find_rc_accounts', { accounts: [username] });
}

// Generates Aall Private Keys from username and password
function getPrivateKeys(username, password, roles = ['owner', 'active', 'posting', 'memo']) {
  const privKeys = {};
  roles.forEach((role) => {
    privKeys[role] = dsteem.PrivateKey.fromLogin(username, password, role).toString();
    privKeys[`${role}Pubkey`] = dsteem.PrivateKey.from(privKeys[role]).createPublic().toString();
  });

  return privKeys;
};

// Creates a suggested password
function suggestPassword() {
  const array = new Uint32Array(10);
  window.crypto.getRandomValues(array);
  return 'P' + dsteem.PrivateKey.fromSeed(array).toString();
}

$(document).ready(async function () {

  // Checks and shows an account's RC
  $('#username').keyup(async function () {
    const parent = $(this).parent('.form-group');
    const ac = await getRC($(this).val());

    if (ac.rc_accounts.length > 0) {
      parent.find('.text-muted').remove();
      parent.append('<div class="text-muted">Current RC: ' + Number(ac.rc_accounts[0].rc_manabar.current_mana).toLocaleString() + '</div>');
    }
  });

  // Check if the name is available
  $('#new-account').keyup(async function () {
    const ac = await checkAccountName($(this).val());

    (ac) ? $(this).removeClass('is-invalid').addClass('is-valid') : $(this).removeClass('is-valid').addClass('is-invalid');
  });

  // Auto fills password field
  $('#password').val(suggestPassword());

  // Processisng claim account form
  $('#claim-account').submit(async function (e) {
    e.preventDefault();

    const username = $('#username').val();
    const activeKey = $('#active-key').val();
    const feedback = $('#claim-account-feedback');

    const op = ['claim_account', {
      creator: username,
      fee: dsteem.Asset.from('0.000 STEEM'),
      extensions: [],
    }];

    feedback.removeClass('alert-success').removeClass('alert-danger');

    if (window.steem_keychain && activeKey === '') {
      op[1].fee = op[1].fee.toString();
      steem_keychain.requestBroadcast(username, [op], 'active', function (response) {
        console.log(response);
        if (response.success) feedback.addClass('alert-success').text('You have successfully claimed a discounted account!');
      });

    } else {
      client.broadcast.sendOperations([op], dsteem.PrivateKey.from(activeKey))
        .then((r) => {
          console.log(r);
          feedback.addClass('alert-success').text('You have successfully claimed a discounted account!');
        })
        .catch(e => {
          console.log(e);
          feedback.addClass('alert-danger').text(e.message);
        });
    }
  });


  // Processing create account form
  $('#create-account').submit(async function (e) {
    e.preventDefault();

    const username = $('#new-account').val();
    const password = $('#password').val();
    const creator = $('#creator').val();
    const sp = parseFloat($('#delegation').val()).toFixed(3);
    const active = $('#creator-key').val();
    const feedback = $('#create-account-feedback');

    const ops = [];

    const keys = getPrivateKeys(username, password);

    const create_op = [
      'create_claimed_account',
      {
        active: dsteem.Authority.from(keys.activePubkey),
        creator,
        extensions: [],
        json_metadata: '',
        memo_key: keys.memoPubkey,
        new_account_name: username,
        owner: dsteem.Authority.from(keys.ownerPubkey),
        posting: dsteem.Authority.from(keys.postingPubkey),
      },
    ];

    ops.push(create_op);

    if (sp > 0) {
      // Converting SP to VESTS
      const delegation = (dsteem.getVestingSharePrice(await client.database.getDynamicGlobalProperties()))
        .convert({ amount: sp, symbol: 'STEEM' });

      const delegate_op = [
        'delegate_vesting_shares',
        {
          delegatee: username,
          delegator: creator,
          vesting_shares: delegation,
        }
      ];
      ops.push(delegate_op);
    }

    feedback.removeClass('alert-success').removeClass('alert-danger');

    if (window.steem_keychain && active === '') {
      steem_keychain.requestBroadcast(creator, ops, 'active', function (response) {
        console.log(response);
        if (response.success) feedback.addClass('alert-success').text('Account: ' + username + ' has been created successfully.');
      });

    } else {
      client.broadcast.sendOperations(ops, dsteem.PrivateKey.from(active))
        .then((r) => {
          console.log(r);
          feedback.addClass('alert-success').text('Account: ' + username + ' has been created successfully.');
        })
        .catch(e => {
          console.log(e);
          feedback.addClass('alert-danger').text(e.message);
        });
    }
  });
});
	</script>
</body>

</html>