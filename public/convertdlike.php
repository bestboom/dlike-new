<?php include('template/header5.php'); 
if (!isset($_COOKIE['username']) || !$_COOKIE['username']) {
    die('<script>window.location.replace("https://dlike.io","_self")</script>');
} else {
    $user_wallet = $_COOKIE['username'];
}

if (isset($_GET['eth'])) {
     $eth = $_GET['eth'];
} else {}

$curDate = date("Y-m-d H:i:s");

$sqls         = "SELECT amount FROM wallet where username='$user_wallet'";
$resultAmount = $conn->query($sqls);
$rowIt        = $resultAmount->fetch_assoc();
$dlike_bal    = $rowIt['amount'];

/*
	$check_link = "SELECT * FROM dlikepasswordreset where token = '$token' and email = '$email'";
	$result_link = $conn->query($check_link);
	if ($result_link->num_rows <= 0) {
		$errors = 'This is an invalid link for password reset';
	}
	$row = mysqli_fetch_assoc($result_link);
	$reset_date = $row['reset_time'];
  	if ($reset_date >= $curDate){
  		$errors = 'The link to reset password has expired';
  	}
*/
?>
</div>
    <div class="container">
        <div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">
            <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
                <div class="modal-body">
                    <div class="share-block">
                        <p>Convert DLIKE to DLIKER</p>
                    </div>
                    <div class="user-connected-form-block" style="background: #1b1e63;">
                    <?php if (empty($errors)) { ?>
                        <form class="user-connected-from password-reset-form">
                        	<input type="hidden" id="user_token_bal" value="<?php echo $dlike_bal; ?>" />
                        	<div style="font-weight:500;text-align: center;padding-top:5px;padding-bottom: 5px;color:#fff;" class="eth_tokens">Balance: <?php echo $dlike_bal; ?> DLIKE</div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-money"></span></div>
                                </div>
                                <input type="number" step="0.0001" min="0" max="10" name="dlike_convert_amount" id="dlike_convert_amount" placeholder="Confirm Amount to Convert" class="form-control" style="padding: 8px;" />
                            </div>
                            <div style="font-weight:700;text-align: right;padding-top:5px;padding-bottom: 5px;cursor: pointer;color:#fff;" class="eth_tokens">Convert ETH based DLIKE token?</div>
                            <center>
                                <button type="button" class="btn btn-default" style="width: 40%;margin-top: 15px;" id="with_tok">Submit</button>
                            </center>
                        </form>
                    <? } else { echo '<h3 style="color: #e1ec31;">'.$errors.'</h3>'; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php include('template/footer.php'); ?>
<script type="text/javascript">
	$('#with_tok').click(function() {
		let dlk_amount = $('#dlike_convert_amount').val();
		let dlk_bal = $('#user_token_bal').val();
    	let email_verify_url = 'helper/email_new_pa.php';

	    if (dlk_amount == "") {
	        toastr.error('phew... Please enter valid amount to withdraw');
	        return false;
	    }
	    if (dlk_amount > dlk_bal) {
	        toastr.error('phew... Not enough balance');
	        return false;
	    }
	    var data_new_pass = {
	    	dlk_amount: dlk_amount
	    };
	    $.ajax({
	        type: "POST",
	        url: email_verify_url,
	        data: data_new_pass,
	        success: function(data) {
	            try {
	                var response = JSON.parse(data)
	                if (response.error == true) {
	                    toastr['error'](response.message);
	                } else {
	                    toastr['success'](response.message);
	                    setTimeout(function(){
	                        window.location.href = response.redirect;
	                    }, 1000);
	                }
	            } catch (err) {
	                toastr.error('Sorry. Server response is malformed');
	            }
	        }
	    });
	});
</script>