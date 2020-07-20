<?php  include('template/header7.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_COOKIE['dlike_username']) && !empty($_COOKIE['dlike_username'])) { $staker =  $_COOKIE['dlike_username']; }

?>
</div>

    <div class="working-process-section" style="padding: 40px 0 60px;">
        <div class="container">
            <div class="row row-cards" style="margin-top:40px;">
                <div class="col-sm-6 col-lg-3">
                    <div class="queue-stats card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-blue mr-3">
                              <i class="fa fa-check"></i>
                            </span>
                            <div>
                                <h4 class="m-0"><small>My Staking</small></h4>
                                <small class="queue-stats-display text-muted">No posts in the Queue</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-orange mr-3">
                              <i class="fa fa-list"></i>
                            </span>
                            <div>
                                <h4 class="m-0"><small>Total Stakers</small></h4>
                                <small class="text-muted"><span class="run-bot-voteWorth">1.063 SBD</span></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="bot-power card p-3">
                        <div id="voting-power" class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-green mr-3">
                              <i class="fa fa-battery-half"></i>
                            </span>
                            <div style="width: 100%">
                                <h4 class="m-0"><small>Staked Amount</small></h4>
                                <div>
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <strong class="voting-power-display">95.23%</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-green mr-3">
                              <i class="fa fa-star"></i>
                            </span>
                            <div>
                                <h4 class="m-0"><small>Yesterday Distributed</small></h4>
                                <small class="text-muted"><span class="run-bot-lastVote">7/20/2020 1:17:34 PM</span></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 70px;">
                <div class="col-lg-6  col-md-6">
                    <div class="working-process">
                        <ul class="working-process-list">
                            <li>
                                <div class="working-process-step">
                                    <h4><span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>  DLIKE Staking</h4>
                                    <div class="process-details">
                                        <p>
                                            20% reward out of every DLIKE token generated through likes on shared links is reserved for staking. This reward is distributed among tp 200 stakers by volume. This number will gradually grow to 1000.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="working-process-step">
                                    <h4><span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>  How to Stake?</h4>
                                    <div class="process-details">
                                        <p>
                                            Simply login with Tronlink and stake the amount of tokens you want. You agree to freeze these tokens for 7 days as rewards on these staked tokens are distributed on daily basis.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="ticker-head">
                        <ul class="nav nav-tabs ticker-nav prof-nav" role="tablist">
                            <li class="nav-item"><a class="nav-link active show" href="#stake_dlike" role="tab" data-toggle="tab" aria-selected="true"><h5>Stake</h5></a></li>
                            <li class="nav-item"><a class="nav-link" href="#unstake_dlike" role="tab" data-toggle="tab">Unstake</a></li>
                            <li class="nav-item"><a class="nav-link" href="#claim_dlike" role="tab" data-toggle="tab">Claim</a></li>
                            <li class="nav-item nav-item-last"></li>
                        </ul>
                    </div>
                    <div class="market-ticker-block">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active show" id="stake_dlike">
                                <div class="container">
                                    <div class="row" style="margin-top:45px;">
                                        <div id="stake_sub" style="width: 90%;">   
                                            <input type="hidden" name="staker" id="staking_user" value="<? echo $staker; ?>" />   
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="stakeamount" id="stakeamount" placeholder="Amount to Stake">
                                            </div>
                                            <center><button type="button" class="btn btn-primary" id="stake_me" style="width: 30%;">Stake</button></center>
                                        </div>
                            </div></div></div>
                            <div role="tabpanel" class="tab-pane fade" id="unstake_dlike">
                                <div class="container">
                                    <div class="row" style="margin-top: 45px;">
                                        <div id="stake_sub" style="width: 90%;">   
                                            <input type="hidden" name="staker" id="staking_user" value="<? echo $staker; ?>" />   
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="unstakeamount" id="unstakeamount" placeholder="Amount to UnStake">
                                            </div>
                                            <center><button type="button" class="btn btn-primary" id="unstake_me"style="width: 30%;">Unstake</button></center>
                                        </div>
                            </div></div></div>
                            <div role="tabpanel" class="tab-pane fade" id="claim_dlike">
                                <div class="container">
                                    <div class="row" style="margin-top: 45px;">
                                        <div id="stake_sub" style="width: 90%;">   
                                            <input type="hidden" name="staker" id="staking_user" value="<? echo $staker; ?>" />   
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="claimamount" id="claimeamount" placeholder="Claim">
                                            </div>
                                            <center><button type="button" class="btn btn-primary" id="unstake_me"style="width: 30%;">Claim</button></center>
                                        </div>
                            </div></div></div>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
<? if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])) { $staker =  $_COOKIE['username']; ?>
    <div class="latest-tranjections-area">
        <div class="latest-tranjections-block">
            <div class="container">
                <div class="latest-tranjections-block-inner">
                    <div class="panel-heading-block">
                        <h5>Top Stakings Accounts</h5>
                    </div>
                    <table class="table coin-list latest-tranjections-table">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Tron Address</th>
                                <th scope="col">Amount Staked</th>
                                <th scope="col">Time Staked</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sqlt = "SELECT * FROM staking where username ='$staker' ORDER BY start_time DESC";
                            $result_t = $conn->query($sqlt);
                                if ($result_t->num_rows > 0) {
                                    while($row_t = $result_t->fetch_assoc()) { 
                                    $period = $row_t["period"]; 
                                    if($period == "2") {$period = '180'; $bonus = '25%'; $mature = '181';}
                                    else if($period == "1") {$period = '90';$bonus = '9%'; $mature = '91';}
                                    $entry_date = date('Y-m-d', strtotime($row_t["start_time"]));
                            ?> 
                            <tr>   
                                <td><?php echo date('Y-m-d', strtotime($row_t["start_time"])); ?></td>
                                <td><?php echo $row_t["amount"]; ?></td>
                                <td><?php echo $period; ?> Days</td>
                                <td><?php echo $bonus; ?></td>
                                <td><?php echo date('Y-m-d', strtotime($entry_date. ' + '.$mature.' days')); ?></td>    
                            </tr>
                            <? } }?>
                        </tbody>
                    </table>
                </div><!-- order-history-block-inner -->
            </div>
        </div>
    </div>
<? } ?>     
<?php include('template/footer.php'); ?>
<script type="text/javascript">
    var optionstak = {
        target: '#stak-msg',
        url: 'helper/addstake.php',
        success: function() {},
    }
$('#stake_sub').submit(function() {
    if (username === null) {
        toastr.error('hmm... You must be login!');
        return false;
    }

    let stake_amt = parseInt($("#stakemaount").val());
    let stake_period = parseInt($('.period').val());

    if (!stake_amt) { 
        $("#stakemaount").css("border-color", "RED"); 
        toastr.error('phew... Enter Tokens Amount to Stake');
        return false;
    }

    if (stake_amt < 500) { 
        toastr.error('phew... Minimum Stake Amount is 500 DLIKE'); 
        return false;
    }

    if (!stake_period) { 
        toastr.error('phew... Select a staking period'); 
        return false;
    }

    $(this).ajaxSubmit(optionstak);
    return !1;
});
    
</script>