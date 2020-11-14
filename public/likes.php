<?php $dlike_user = $_COOKIE['dlike_username'];
include('includes/config.php'); include('template/header.php'); ?>
</div><?php
$sql_B = $conn->query("SELECT amount FROM dlike_wallet where username='$dlike_user'");
$row_B = $sql_B->fetch_assoc();$my_bal = $row_B["amount"];

$sql_A = $conn->query("SELECT count( DISTINCT(username) ) as rferrals FROM dlikeaccounts where refer_by='$dlike_user'");
$row_A = $sql_A->fetch_assoc(); $my_affiliates = $row_A["rferrals"];

$sql_I = $conn->query("SELECT sum(amount) as total_income FROM dlike_transactions where username='$dlike_user' and  DATE(trx_time) = CURDATE()");
$row_I = $sql_I->fetch_assoc(); $today_income = $row_I["total_income"];
if($today_income > 0) {$today_income = $today_income;}else{$today_income='0';}

$sql_J = $conn->query("SELECT * FROM dlikeaccounts where username='$dlike_user'");
$row_J = $sql_J->fetch_assoc();$offchain_address = $row_J["offchain_address"];
?>
<div class="working-process-section" style="padding-top: 130px;">
    <div class="container"><div class="row">
        <div class="offset-lg-1 col-lg-5 col-md-6">
            <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                <h3 style="text-align: center;"><div style="font-size: 1.1rem;">DLIKE Wallet</div></h3>
                <form class="user-connected-from create-account-form reward_form" />
                <div class="form-group reward_fileds">
                    <input type="text" class="form-control reward_input" value=" | My Balance" readonly>
                    <span class="fas fa-database inp_icon"></span>
                    <span class="inp_text"><?php echo $my_bal; ?><br/><span class="inp_text unclaimed_tokens_sec" style="display: none;">Unclaimed Tokens:<span class="unclaimed_bal"></span></span></span>
                </div>
                <div class="form-group reward_fileds">
                    <input type="text" class="form-control reward_input" value=" | Income Today" readonly>
                    <span class="fas fa-bolt inp_icon"></span>
                    <span class="inp_text"><?php echo $today_income; ?></span>
                </div>
                <div class="form-group reward_fileds">
                    <input type="text" class="form-control reward_input" value=" | My Affiliates" readonly>
                    <span class="fas fa-flask inp_icon"></span>
                    <span class="inp_text"><?php echo $my_affiliates; ?></span>
                </div><br>
                <p>One Withdrawal per 24 hours!</p>
                <button type="button" class="btn btn-default withd_btn">Withdraw</button>
                <p class="DlikeComments">Max Daily withdrawal limit 5000 DLIKE</p>
                </form>
            </div>
        </div>
        <div class="col-lg-6  col-md-6">
            <div class="working-process">
                <h4 class="pool_head">Tools</h4>
                <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                    <div class="queue-stats card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-orange mr-3"><i class="fas fa-money-bill-alt"></i></span>
                            <div>
                                <h4 class="m-0"><small>Tron Wallet Address</small></h4>
                                <small class="row queue-stats-display text-muted wallet_address" style="margin: 0px !important;">
                                    <?php if(!empty($offchain_address)){ echo $offchain_address; } else { ?>
                                    <span><a href="https://dlike.zendesk.com/hc/en-us/articles/900002726623-Which-Tron-Wallet-is-recomended-"><i class="far fa-question-circle" style="color: #c51d24;" target="_blank"></i></a><input type="text" class="form-control" style="border:none;border-bottom: 1px solid #ccc;" id="offchain_add" value="" /></span><span class="stamp stamp-md bg-green mr-3" style="margin-left: 10px;"><i class="fa fa-plus add_address" style="cursor: pointer;"></i></span> <? } ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                    <div class="queue-stats card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-blue mr-3"><i class="fa fa-list"></i></span>
                            <div>
                                <h4 class="m-0"><small>My Affiliate Link</small></h4>
                                <small class="queue-stats-display text-muted"><b><?php echo '<a href="https://dlike.io/welcome/'.$dlike_user.'" style="color: #467fcf;">https://dlike.io/welcome/'.$dlike_user.'</a>'; ?></b></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                    <div class="queue-stats card p-3"><div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-green mr-3"><i class="fa fa-battery-full"></i></span>
                            <div>
                                <h4 class="m-0"><small>Boost Posts</small></h4>
                                <small class="queue-stats-display text-muted">Post boost feature will be available soon</small>
                            </div>
                    </div></div>
                </div>
            </div>
        </div>
    </div></div>
</div>
<div class="container"><div class="row">
<div class="col-md-6"><div class="latest-tranjections-area"><div class="latest-tranjections-block"><div class="container">
    <div class="latest-tranjections-block-inner">
        <div class="panel-heading-block"><h5>Transactions</h5></div>
        <table class="table coin-list latest-tranjections-table">
            <thead><tr>
                <th scope="col">Amount</th><th scope="col">Type</th><th scope="col">For</th><th scope="col" style="float:right;">Time</th>
            </tr></thead>
            <tbody>
                <?php $sql_T = $conn->query("SELECT * FROM dlike_transactions where username ='$dlike_user' ORDER BY trx_time DESC LIMIT 30");
                    if ($sql_T->num_rows > 0) { while($row_T = $sql_T->fetch_assoc()) { 
                        $entry_date = strtotime($row_T["trx_time"]);$tx_type = $row_T["type"];
                        if($tx_type == 'a'){$trx_type = 'author';}elseif($tx_type == 'b'){$trx_type = 'curation';}elseif($tx_type == 'c'){$trx_type = 'affiliate';}?> 
                <tr><td><?php echo $row_T["amount"]; ?></td><td><?php echo $trx_type ?></td><td><?php echo '<a href="https://dlike.io/post/'.$row_T["post_author"].'/'.$row_T["reason"].'"><i class="fas fa-globe"></i></a>'; ?></td><td style="float:right;"><?php echo time_ago($entry_date); ?></td></tr><? } }?>
            </tbody>
        </table>
    </div>
</div></div></div></div>
<div class="col-md-6"><div class="latest-tranjections-area"><div class="latest-tranjections-block"><div class="container">
    <div class="latest-tranjections-block-inner">
        <div class="panel-heading-block"><h5>Withdrawals</h5></div>
        <table class="table coin-list latest-tranjections-table">
            <thead><tr> <th scope="col">Amount</th><th scope="col">Status</th><th scope="col" style="float:right;">Time</th></tr></thead>
            <tbody>
                <?php $sql_P = $conn->query("SELECT * FROM dlike_withdrawals where username ='$dlike_user' ORDER BY req_on DESC LIMIT 30");
                    if ($sql_P->num_rows > 0) { while($row_P = $sql_P->fetch_assoc()) {$entry_date = strtotime($row_P["req_on"]); ?> 
                <tr><td><?php echo $row_P["amount"]; ?></td><td><?php echo '<a href="https://shasta.tronscan.org/#/transaction/'.$row_P["status"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>'; ?></td><td style="float:right;"><?php echo time_ago($entry_date); ?></td></tr><? } }?>
            </tbody>
        </table>
    </div>
</div></div></div></div>
</div></div>
<div class="modal fade" id="dlike_tok_with" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document"><div class="modal-content modal-custom"><div class="modal-body ">
        <div class="transfer-respond">
            <h4>Withdraw DLIKE Tokens</h4>
            <label><b>Balance: </b><span class="user_bal"><?php echo $my_bal;; ?></span> DLIKE</label>
            <div class="row line"><div class="col-md-12"><div class="form-group"><div class="input-group mb-3">
                <div class="input-group-prepend"><div class="input-group-text mb-deck"> Amount</div></div><input type="text" class="form-control" name="amt" id="withdraw_amount" placeholder="Enter Amount to Withdraw">
            </div> </div></div></div>
            <p>Please make sure to have minimum 35K energy in your tron wallet to complete this transaction.</p>
            <center><button type="submit" class="btn btn-default tok_out_btn">Withdraw</button></center>
        </div>
     </div></div></div>
</div>
<div class="modal fade" id="withdrawStatus" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom">
<div class="modal-body "><div class="mdStatusTitle sttError iconTitle"><i class="fa fa-spinner fa-pulse"></i></div><div class="mdStatusContent"><h3 id="alert-title-error"><span class="wd_status_message">Waiting For Confirmation</span></h3><div id="alert-content-error"><b><span class="wd_trx_link"></span></b></div><div class="actBtn"><button type="button" class="btn btn-danger wd_btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button></div></div></div>
</div></div></div>
<script type="text/javascript">let my_wallet = '<?php echo $offchain_address;?>';</script>
<?php include('template/footer.php'); ?>
<script type="text/javascript">
async function getUnclaimedTokens() {var user_address =false;
    if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
        if(user_address!=false){
            var myContract = await tronWeb.contract().at(mainContractAddress);
            var loguser_wallet_address = $('.wallet_address').html();
            console.log(loguser_wallet_address);
            //if(user_address != loguser_wallet_address){
                //await new Promise((resolve, reject) => setTimeout(resolve, 600));
                var unClaimed = await myContract.tokenBalances(user_address).call();
                unClaimed = window.tronWeb.toDecimal(unClaimed) / 1e6;
                console.log(unClaimed);
                    if(unClaimed>5){
                        $('.unclaimed_tokens_sec').show();
                        $('.unclaimed_bal').html(unClaimed);
                    }
        }
    }
}
setTimeout(getUnclaimedTokens,300);
</script>