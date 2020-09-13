<?php include('includes/config.php'); include('template/header.php');?> </div>
<?php if(isset($_COOKIE['dlike_username']) && !empty($_COOKIE['dlike_username'])) { $dlike_user =  $_COOKIE['dlike_username']; } else {$dlike_user='';}
if($dlike_user == '') { ?>
<div id="profile_miss"> <div class="container"> <div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;"> <div class="modal-content miss_content"> <div class="modal-body"> <div class="share-block"><p style="font-size: 3rem;">ooops!</p></div> <div class="user-connected-form-block" style="background: #1b1e63;"> <center><i class="fas fa-frown miss_frown"></i></center> <div class="share-block"><p>You must login with your DLIKE username<br><b><a href="/welcome">Login</a></b></p></div> </div> </div> </div> </div> </div></div>
<? } else {
$sql_C=$conn->query("SELECT count(*) as total_stakers, SUM(amount) as total_staked_amount FROM dlike_staking");
if ($sql_C->num_rows > 0){$row_C = $sql_C->fetch_assoc();
$total_stakers = $row_C["total_stakers"]; $total_staked_amount = $row_C["total_staked_amount"];
} else {$total_stakers = '0'; $total_staked_amount = '0';}

$sql_Y=$conn->query("SELECT * FROM dlike_rewards_history order by update_time desc limit 1");
if ($sql_Y->num_rows > 0){$row_Y = $sql_Y->fetch_assoc();$yesterday_distribution = $row_Y["dlike_staking"];} else {$yesterday_distribution = '0';}

$sql_M = $conn->query("SELECT * FROM dlike_staking where username='$dlike_user'");
if ($sql_M->num_rows > 0){$row_M = $sql_M->fetch_assoc();$my_staking=$row_M["amount"];$my_staking_wallet=$row_M["tron_address"];} else{$my_staking='0';$my_staking_wallet='';}

$sql_Q = $conn->query("SELECT * FROM dlike_staking_rewards where username='$dlike_user'");
if ($sql_Q->num_rows > 0){$row_Q = $sql_Q->fetch_assoc();$my_rewards=$row_Q["reward"];} else{$my_rewards='0';}
?>
<div class="working-process-section stk_section">
    <div class="container">
        <div class="row row-cards" style="margin-top:40px;">
            <div class="col-sm-6 col-lg-3"><div class="queue-stats card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3"><i class="fa fa-check"></i></span>
                    <div class="stk100"><h4 class="m-0"><small>My Staking</small></h4><div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $my_staking; ?> DLIKE</strong></div></div>
                    </div>
                </div>
            </div></div>
            <div class="col-sm-6 col-lg-3"><div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-orange mr-3"><i class="fa fa-list"></i></span>
                    <div class="stk100"><h4 class="m-0"><small>Total Stakers</small></h4><div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $total_stakers; ?></strong></div></div>
                    </div>
                </div>
            </div></div>
            <div class="col-sm-6 col-lg-3"><div class="bot-power card p-3">
                <div id="voting-power" class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3"><i class="fa fa-cubes"></i></span>
                    <div class="stk100"><h4 class="m-0"><small>Staked Amount</small></h4><div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $total_staked_amount; ?> DLIKE</strong></div></div>
                    </div>
                </div>
            </div></div>
            <div class="col-sm-6 col-lg-3"><div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3"><i class="fas fa-exchange-alt"></i></span>
                    <div class="stk100"><h4 class="m-0"><small>Yesterday Distributed</small></h4><div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $yesterday_distribution; ?> DLIKE</strong></div></div>
                    </div>
                </div>
            </div></div>
        </div>
        <div class="row" style="margin-top: 70px;">
            <div class="col-lg-6  col-md-6"><div class="working-process">
                <ul class="working-process-list">
                    <li><div class="working-process-step">
                        <h4><span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>  DLIKE Staking</h4>
                        <div class="process-details"><p>20% reward out of every DLIKE token generated through likes on shared links is reserved for staking. This reward is distributed among top 200 staking accounts by volume. This number will gradually grow to 1000.</p></div>
                    </div></li>
                    <li><div class="working-process-step">
                        <h4><span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>  How to Stake?</h4>
                        <div class="process-details"><p>Simply login with Tronlink and stake the number of tokens you want. Rewards on these staked tokens is distributed daily. Once you want to unstake tokens power down period is 7 days.</p></div>
                    </div></li>
                </ul>
            </div></div>
            <div class="col-lg-5 col-md-6">
                <div class="ticker-head">
                    <ul class="nav nav-tabs ticker-nav prof-nav" role="tablist">
                        <li class="nav-item"><a class="nav-link active show" href="#stake_dlike" role="tab" data-toggle="tab" aria-selected="true"><h5>Stake</h5></a></li>
                        <li class="nav-item"><a class="nav-link" href="#unstake_dlike" role="tab" data-toggle="tab">Unstake</a></li>
                        <li class="nav-item"><a class="nav-link" href="#claim_dlike" role="tab" data-toggle="tab">Claim</a></li>
                        <li class="nav-item nav-item-last"></li>
                    </ul>
                </div>
                <div class="market-ticker-block stk_box">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active show" id="stake_dlike">
                            <div class="container"><div class="row stk_row">
                                <div class="stake_sub stk90"> 
                                    <div class="form-group"><input type="number" class="form-control" name="stakeamount" id="stakeamount" placeholder="Amount to Stake"></div>
                                    <center><button type="button" class="btn btn-primary stk30" id="stake_me">Stake</button></center>
                                </div>
                        </div></div></div>
                        <div role="tabpanel" class="tab-pane fade" id="unstake_dlike">
                             <div class="container">
                                <div id="unskae_row" class="row stk_row">
                                    <div class="stake_sub stk90"><p>Loading...</p></div>
                                </div>
                                <div id="unstake_row" class="row stk_row" style="display:none;">
                                    <div class="stake_sub stk90">
                                        <div class="form-group"><input type="number" class="form-control" name="unstakeamount" id="unstakeamount" placeholder="Amount to UnStake"></div>
                                        <center><button type="button" class="btn btn-primary stk30" id="unstake_me">Unstake</button></center>
                                    </div>
                                </div>
                                <div id="unstake_timer_row" class="row stk_row" style="display:none;">
                                    <div class="stake_sub stk90">
                                        <div class="form-group"><b>Pending Unstake Tokens: </b><span id="unstakingAmount">0</span> DLIKE</div>
                                        <div class="form-group"><b>Availble to claim after: </b><span id="unstakingTimer">00 : 00 : 00</span></div>
                                        <div class="site_col"><b>You can initiate new unstake once old one is matured!</b></div>
                                    </div>
                                </div>
                                <div id="unstake_claim_row" class="row stk_row" style="display:none;">
                                    <div class="stake_sub stk90">
                                        <center><button type="button" class="btn btn-primary" id="claimback_tokens"><span class="claimback_tk">Claim Unstaked Tokens</span></button></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="claim_dlike">
                            <div class="container"><div class="row stk_row">
                                <div class="stake_sub stk90">
                                    <div class="form-group"><input type="number" class="form-control" name="claimamount" id="claimeamount" placeholder="Claim" readonly="readonly" value="<?php echo $my_rewards; ?>"></div>
                                    <center><button type="button" class="btn btn-primary stk30" id="claim_stk_reward">Claim</button></center>
                                </div>
                        </div></div></div>
                </div></div>
            </div>
        </div>
    </div>
</div>
<div class="latest-tranjections-area"><div class="latest-tranjections-block"><div class="container">
    <div class="latest-tranjections-block-inner">
        <div class="panel-heading-block"><h5>Transaction History</h5></div>
        <table class="table coin-list latest-tranjections-table">
            <thead><tr><th scope="col">Amount</th><th scope="col">Type</th><th scope="col">Trx ID</th><th scope="col">Time</th></tr></thead>
            <tbody>
            <?php $sql_st = $conn->query("SELECT * FROM dlike_staking_transactions where username = '$dlike_user' ORDER BY trx_time DESC Limit 30");
                if ($sql_st->num_rows > 0) { while($row_t = $sql_st->fetch_assoc()) {?> 
                    <tr><td><?php echo $row_t["amount"]; ?></td><td><?php echo $row_t["type"]; ?></td><td><?php echo '<a href="https://tronscan.org/#/transaction/'.$row_t["tron_trx"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>';?></td><td><?php echo date('Y-m-d', strtotime($row_t["trx_time"])); ?></td> </tr>
            <? } }?>
            </tbody>
        </table>
    </div>
</div></div></div>  
<? } ?>  
<div class="modal fade" id="stakingStatus" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom">
<div class="modal-body "><div class="mdStatusTitle sttError iconTitle"><i class="fa fa-spinner fa-pulse"></i></div><div class="mdStatusContent"><h3 id="alert-title-error"><span class="st_status_message">Waiting For Confirmation</span></h3><div id="alert-content-error"><b><span class="st_trx_link"></span></b></div><div class="actBtn"><button type="button" class="btn btn-danger st_btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button></div></div></div>
</div></div></div>
<script>let stk_wallet = '<?php echo $my_staking_wallet; ?>';</script>
<?php include('template/footer.php'); ?>