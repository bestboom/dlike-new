<?php include('template/header5.php'); 
if (!isset($_COOKIE['username']) || !$_COOKIE['username']) {
    die('<script>window.location.replace("https://dlike.io","_self")</script>');
} else {
    $user_wallet = $_COOKIE['username'];
}

if (isset($_GET['tok'])) {
     $eth = '1';
} else {$eth = '0';}

$curDate = date("Y-m-d H:i:s");

$sqls         = "SELECT amount FROM wallet where username='$user_wallet'";
$resultAmount = $conn->query($sqls);
$rowIt        = $resultAmount->fetch_assoc();
$dlike_bal    = $rowIt['amount'];

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
                    <?php 
                    	if (empty($errors)) {
                    	if ($eth == '0') {  ?>
                        <form class="user-connected-from">
                        	<input type="hidden" id="user_token_bal" value="<?php echo $dlike_bal; ?>" />
                        	<div style="font-weight:500;text-align: center;padding-top:5px;padding-bottom: 5px;color:#fff;" class="eth_tokens">Balance: <?php echo $dlike_bal; ?> DLIKE</div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fas fa-money-bill-alt"></span></div>
                                </div>
                                <input type="number" step="0.0001" min="0" max="10" name="dlike_convert_amount" id="dlike_convert_amount" placeholder="Confirm Amount to Convert" class="form-control" style="padding: 8px;" />
                            </div>
                            <div style="font-weight:700;text-align: right;padding-top:5px;padding-bottom: 5px;cursor: pointer;color:#fff;" class="eth_tokens">Convert ETH based DLIKE token?</div>
                            <center>
                                <button type="button" class="btn btn-default" style="width: 40%;margin-top: 15px;" id="with_tok">Submit</button>
                            </center>
                        </form>
                    <? } else { ?>
                    	<form class="user-connected-from">
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;"> ETH Address</div>
                                </div>
                                <input type="number" step="0.0001" min="0" max="10" name="dlike_convert_amount" id="dlike_convert_amount" placeholder="Enter ETH which has DLIKE Balance" class="form-control" style="padding: 8px;" />
                            </div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;">Convert Amount</div>
                                </div>
                                <input type="number" step="0.0001" min="0" max="10" name="dlike_convert_amount" id="dlike_convert_amount" placeholder="Amount to conver" class="form-control" style="padding: 8px;" />
                            </div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;">Steem Username</div>
                                </div>
                                <input type="number" step="0.0001" min="0" max="10" name="dlike_convert_amount" id="dlike_convert_amount" placeholder="Enter steem address" class="form-control" style="padding: 8px;" />
                            </div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;">Earned By</div>
                                </div>
                                <input type="number" step="0.0001" min="0" max="10" name="dlike_convert_amount" id="dlike_convert_amount" placeholder="How you earned these tokens (IEO, Bounty)" class="form-control" style="padding: 8px;" />
                            </div>
                            <center>
                                <button type="button" class="btn btn-default" style="width: 40%;margin-top: 15px;" id="with_tok">Submit</button>
                            </center>
                        </form>
                    <? } 
                	} else { echo '<h3 style="color: #e1ec31;">'.$errors.'</h3>'; }
                	?>
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
	    if (dlk_amount == "") {
	        toastr.error('phew... Please enter valid amount to withdraw');
	        return false;
	    }
	    if (parseFloat(dlk_amount) > parseFloat(dlk_bal)) {
	        toastr.error('phew... Not enough balance');
	        return false;
	    }

    	let convert_url = 'helper/converter.php';
	    var data_amt = {
	    	dlk_amount: dlk_amount
	    };
	    $.ajax({
	        type: "POST",
	        url: convert_url,
	        data: data_amt,
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

	$('.eth_tokens').click(function() {
		window.location.href = "https://dlike.io/convertdlike.php?tok=eth";
	});
</script>