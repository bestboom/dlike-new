<?php  include('../template/header.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])) { $staker =  $_COOKIE['username']; }

?>
</div><!-- sub-header -->
<div class="container" style="background: #191d5d;max-width: 100% !important;">
    <div class="row" style="padding: 50px;">
        <div class="col" style="text-align:center;color: #fff;">
            <h3>DLIKE TOKENS STAKING</h3>
        </div>
    </div>
</div>
    <div class="working-process-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5  col-md-6">
                    <div class="working-process">
                        <ul class="working-process-list">
                            <li>
                                <div class="working-process-step">
                                    <h4><span>#01.</span>  What is Staking?</h4>
                                    <div class="process-details">
                                        <p>
                                            Staking means to "lock up" your DLIKE tokens for a certain period of time.For locking your tokens, you earn bonus rewards.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="working-process-step">
                                    <h4><span>#02.</span>  Staking Rewards</h4>
                                    <div class="process-details">
                                        <p>
                                            We have 2 staking options.<br>
                                            1. Stake for <b>90 days</b> to earn <b>9% bonus</b> tokens<br>
                                            2. Stake for <b>180 days</b> to earn <b>25% bonus</b> tokens
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="working-process-step">
                                    <h4><span>#03.</span>  Staking Terms</h4>
                                    <div class="process-details">
                                        <p>
                                            Tokens staked for bonus will not be withdrawable for set period. You can continue staking after the maturity or can withdraw once staking period is over.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="offset-lg-2 col-lg-5 col-md-6">
                    <div class="user-connected-form-block">
                        <h3>
                            Stake DLIKE Tokens
                        </h3>
                        <div id="stak-msg"></div>
                        <form action="" class="user-connected-from create-account-form" method="POST" id="stake_sub">   
                        <input type="hidden" name="staker" id="staking_user" value="<? echo $staker; ?>" />   
                            <div class="form-group">
                                <input type="number" class="form-control" name="stakemaount" id="stakemaount" placeholder="Amount to Stake">
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg period" name="stake_option" id="stake">
                                    <option value="0">Staking Time</option>
                                    <option value="1">90 Days</option>
                                    <option value="2">180 Days</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default" id="stake_me" disabled>STAKE NOW</button>
                        </form>
                        <p style="color: red;">New staking not available till next update</a></p>
                    </div><!-- create-account-block -->
                </div>
            </div>
        </div>
    </div><!-- working-process-section -->
<? if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])) { $staker =  $_COOKIE['username']; ?>
    <div class="latest-tranjections-area">
        <div class="latest-tranjections-block">
            <div class="container">
                <div class="latest-tranjections-block-inner">
                    <div class="panel-heading-block">
                        <h5>My Stakings</h5>
                    </div>
                    <table class="table coin-list latest-tranjections-table">
                        <thead>
                            <tr>
                                <th scope="col">Date Staked</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Period</th>
                                <th scope="col">Bonus</th>
                                <th scope="col">Maturity Date</th>
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
<?php include('../template/footer.php'); ?>
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