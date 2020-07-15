<?php include('template/header7.php'); 
if (!isset($_COOKIE['dlike_username']) || !$_COOKIE['dlike_username']) {
    die('<script>window.location.replace("https://dlike.io/","_self")</script>');
} else {
    $dlike_user = $_COOKIE['dlike_username'];
}
?>
</div>
<?php
$sql_B = $conn->query("SELECT amount FROM dlike_wallet where username='$dlike_user'");
$row_B = $sql_B->fetch_assoc();
$my_bal = $row_B["amount"];

$sql_A = $conn->query("SELECT count( DISTINCT(username) ) as rferrals FROM dlikeaccounts where refer_by='$dlike_user'");
$row_A = $sql_A->fetch_assoc();
$my_affiliates = $row_A["rferrals"];

$sql_I = $conn->query("SELECT sum(amount) as total_income FROM dlike_transactions where username='$dlike_user' and  DATE(trx_time) = CURDATE()");
$row_I = $sql_I->fetch_assoc();
$today_income = $row_I["total_income"];
if($today_income > 0) {$today_income = $today_income;}else{$today_income='0';}
?>
<div class="working-process-section" style="padding-top: 80px;">
    <div class="container"><div class="row">
        <div class="offset-lg-1 col-lg-5 col-md-6">
            <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                <h3 style="text-align: center;"><div style="font-size: 1.1rem;">DLIKE Wallet</div></h3>
                <form class="user-connected-from create-account-form reward_form" />
                <div class="form-group reward_fileds">
                    <input type="text" class="form-control reward_input" value=" | My Balance" readonly>
                    <span class="fas fa-database inp_icon"></span>
                    <span class="inp_text"><?php echo $my_bal; ?></span>
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
                            <span class="stamp stamp-md bg-blue mr-3"><i class="fas fa-money-bill-alt"></i></span>
                            <div>
                                <h4 class="m-0"><small>Off-Chain Wallet Address</small></h4>
                                <small class="queue-stats-display text-muted"><input type="text" class="form-control" name="offchain_add" id="offchain_add" value="" /></small>
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
                                <small class="queue-stats-display text-muted"><b><?php echo '<a href="https://dlike.io/welcome.php?ref='.$dlike_user.'">https://dlike.io/welcome.php?ref='.$dlike_user.'</a>'; ?></b></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                    <div class="queue-stats card p-3"><div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-blue mr-3"><i class="fa fa-battery-full"></i></span>
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
<div class="latest-tranjections-area"><div class="latest-tranjections-block"><div class="container">
    <div class="latest-tranjections-block-inner">
        <div class="panel-heading-block"><h5>My Transactions</h5></div>
        <table class="table coin-list latest-tranjections-table">
            <thead><tr>
                    <th scope="col">From</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Of</th>
                    <th scope="col">For</th>
                    <th scope="col">Time</th>
            </tr></thead>
            <tbody>
                <?php $sql_T = $conn->query("SELECT * FROM dlike_transactions where username ='$dlike_user' ORDER BY trx_time DESC LIMIT 30");
                    if ($sql_T->num_rows > 0) { while($row_T = $sql_T->fetch_assoc()) { 
                        $entry_date = strtotime($row_T["trx_time"]); ?> 
                <tr>   
                    <td><?php echo $row_T["username"]; ?></td>
                    <td><?php echo $row_T["amount"]; ?></td>
                    <td><?php echo $row_T["type"]; ?></td>
                    <td><?php echo $row_T["reason"]; ?></td>
                    <td><?php echo time_ago($entry_date); ?></td> 
                </tr><? } }?>
            </tbody>
        </table>
    </div>
</div></div></div>
<div class="modal fade" id="tk_transfer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
            <?php include('template/modals/tktransfer.php'); ?>
        </div>
    </div>
</div>
<?php include('template/dlike_footer.php'); ?>
<script type="text/javascript">
    $('.withd_btn').click(function(e) {  e.preventDefault();$("#tk_transfer").modal("show");});
</script>
