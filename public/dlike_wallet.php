<?php include('template/header7.php'); 
if (!isset($_COOKIE['dlike_username']) || !$_COOKIE['dlike_username']) {
    die('<script>window.location.replace("https://dlike.io/share","_self")</script>');
} else {
    $dlike_user = $_COOKIE['dlike_username'];
}
?>
</div>
<?php
$sql_B = $conn->query("SELECT amount FROM dlike_wallet where username='$dlike_user'");
$row_B = $sql_B->fetch_assoc();
$my_bal = $row_B["amount"];

$sql_I = $conn->query("SELECT sum(amount) as total_income FROM dlike_transactions where username='$dlike_user' and  DATE(trx_time) = CURDATE()");
$row_I = $sql_I->fetch_assoc();
$today_income = $row_I["total_income"];
?>
<div class="working-process-section" style="padding-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="offset-lg-1 col-lg-5 col-md-6">
                <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                    <h3 style="text-align: center;">
                        <div style="font-size: 1.1rem;">DLIKE Wallet</div>
                        <div class="reward_amount">7,000 DLIKE</div>
                    </h3>
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
                        <span class="inp_text"><?php echo '0'; ?></span>
                    </div>
                    <p>One Withdrawal per 24 hours!</p>
                    <button type="button" class="btn btn-default reward_btn" disabled><span class="far fa-clock" style="font-size: 1.3rem;padding-right: 1rem;"></span>Withdraw</button>
                    <p class="DlikeComments">Max Daily withdrawal limit 5000 DLIKE</p>
                    <div id="output"></div>
                </div><!-- create-account-block -->
            </div>
            <div class="col-lg-6  col-md-6">
                <div class="working-process">
                    <h4 class="pool_head">DLIKE REWARD POOL</h4>
                    <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                        <div class="queue-stats card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-blue mr-3">
                                  <i class="fas fa-money-bill-alt"></i>
                                </span>
                                <div>
                                    <h4 class="m-0">
                                        <small>Off-Chain Wallet Address</small>
                                    </h4>
                                    <small class="queue-stats-display text-muted">No posts in the Queue</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                        <div class="queue-stats card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-blue mr-3">
                                  <i class="fa fa-list"></i>
                                </span>
                                <div>
                                    <h4 class="m-0">
                                        <small>My Affiliate Link</small>
                                    </h4>
                                    <small class="queue-stats-display text-muted">No posts in the Queue</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                        <div class="queue-stats card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-blue mr-3">
                                  <i class="fa fa-battery-full"></i>
                                </span>
                                <div>
                                    <h4 class="m-0">
                                        <small>oost Posts</small>
                                    </h4>
                                    <small class="queue-stats-display text-muted">No posts in the Queue</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style="color:#c51d24;font-weight: 600;">
                        <span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>
                        DLIKE reward pool is only available to PRO users
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="latest-tranjections-area">
    <div class="latest-tranjections-block">
        <div class="container">
            <div class="latest-tranjections-block-inner">
                <div class="panel-heading-block">
                    <h5>Transactions</h5>
                </div>
                <table class="table coin-list latest-tranjections-table">
                    <thead>
                        <tr>
                            <th scope="col">From</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Of</th>
                            <th scope="col">For</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sql_T = $conn->query("SELECT * FROM dlike_transactions where username ='$dlike_user' ORDER BY trx_time DESC LIMIT 30");
                            if ($sql_T->num_rows > 0) {
                                while($row_T = $sql_T->fetch_assoc()) { 
                                $entry_date = strtotime($row_T["trx_time"]);
                        ?> 
                        <tr>   
                            <td><?php echo $row_T["username"]; ?></td>
                            <td><?php echo $row_T["amount"]; ?></td>
                            <td><?php echo $row_T["type"]; ?></td>
                            <td><?php echo $row_T["reason"]; ?></td>
                            <td><?php echo time_ago($entry_date); ?></td> 
                        </tr>
                        <? } }?>
                    </tbody>
                </table>
            </div><!-- order-history-block-inner -->
        </div>
    </div>
</div>