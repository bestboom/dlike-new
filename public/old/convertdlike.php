<?php include('../template/header.php'); 
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
                                <input type="text" placeholder="Enter ETH which has DLIKE Balance" class="form-control" id="eth_addr" style="padding: 8px;" />
                            </div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;">Convert Amount</div>
                                </div>
                                <input type="number" step="0.0001" min="0" max="10" name="eth_convert_amount" id="eth_convert_amount" placeholder="Amount to convert" class="form-control" style="padding: 8px;" />
                            </div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;">Steem Username</div>
                                </div>
                                <input type="text" placeholder="Enter steem address" class="form-control" id="steem_addr" style="padding: 8px;" />
                            </div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;">Earned By</div>
                                </div>
                                <input type="text" placeholder="How you earned tokens (IEO, Bounty)" class="form-control" id="earn_method" style="padding: 8px;" />
                            </div>
                            <div style="font-weight:500;text-align: left;padding-top:5px;padding-bottom: 5px;cursor: pointer;color:#fff;" class="eth_send_addr">Send DLIKE tokens to <b>0x16ACe8800effB3E4C867144Afa658A579a445b06</b> to proceed conversion!</div>
                            <center>
                                <button type="button" class="btn btn-default" style="width: 40%;margin-top: 15px;" id="with_eth_tok">Submit</button>
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
<?php include('../template/footer.php'); ?>
<script type="text/javascript">
	var dlike_val = document.getElementById('dlike_convert_amount');

	// Listen for input event on numInput.
	dlike_val.onkeydown = function(e) {
	    if(!((e.keyCode > 95 && e.keyCode < 106)
	      || (e.keyCode > 47 && e.keyCode < 58) 
	      || e.keyCode == 8)) {
	        return false;
	    }
	}
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
	    if (parseFloat(dlk_amount) <= 0) {
	        toastr.error('phew... Not enough balance');
	        return false;
	    }

    	let convert_url = 'helper/converter.php';
	    var data_amt = {action : 'dlike_con',dlk_amount: dlk_amount};
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
	                        window.location.href = "https://dlike.io/";
	                    }, 500);
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

	$('#with_eth_tok').click(function() {
		let eth_amount = $('#eth_convert_amount').val();
		let eth_addr = $('#eth_addr').val();
		let steem_addr = $('#steem_addr').val();
		let earn_method = $('#earn_method').val();
	    if (eth_amount == "") {
	        toastr.error('phew... Please enter valid amount to withdraw');
	        return false;
	    }
	    if (eth_addr == "") {
	        toastr.error('phew... Please enter eth address where you hold DLIKE tokens');
	        return false;
	    }
	    if (steem_addr == "") {
	        toastr.error('phew... Please enter steem address where you want converted tokens');
	        return false;
	    }
	    if (earn_method == "") {
	        toastr.error('phew... Please enter methid of earning these tokens');
	        return false;
	    }
	    console.log(eth_amount);
    	let convert_url = '/helper/converter.php';
	    var data_eth = {action : 'eth_con',eth_amount: eth_amount,eth_addr: eth_addr,earn_method:earn_method,steem_addr:steem_addr};
	    $.ajax({
	        type: "POST",
	        url: convert_url,
	        data: data_eth,
	        success: function(data) {
	            try {
	                var response = JSON.parse(data)
	                if (response.error == true) {
	                    toastr['error'](response.message);
	                } else {
	                    toastr['success'](response.message);
	                    setTimeout(function(){
	                        window.location.href = "https://dlike.io/";
	                    }, 500);
	                }
	            } catch (err) {
	                toastr.error('Sorry. Server response is malformed');
	            }
	        }
	    });
	});
</script>