<?php  include('template/header5.php');

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
                            <button type="submit" class="btn btn-default">STAKE NOW</button>
                        </form>
                        <p>By staking you agree to the Terms</a></p>
                    </div><!-- create-account-block -->
                </div>
            </div>
        </div>
    </div><!-- working-process-section -->

    <div class="app-download-section">
        <div class="container">
            <div class="section-title-three">
                <h3>Download Our Apps</h3>
            </div>
            <?php
                        $sqlt = "SELECT username, amount, period FROM staking ORDER BY arttrx_time DESC";
                        $result_t = $conn->query($sqlt);

                        if ($result_t->num_rows > 0) {
                            while($row = $result->fetch_assoc()) { ?>
                        <div class="activity-block">
                            <div class="row my-entry">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div><span class="btn btn-icon btn-exp"><span class="text-dark">Tx</span></span></div>
                                        <div class="exp-user"><?php echo $row["username"]; ?></div>
                                        <div class="exp-user">For <span><?php echo $row["period"]; ?></span></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="exp-amt"><span id="tk-amt"><?php echo $row["amount"]); ?></span> Dlikes</div>
                                </div>
                            </div>
                        </div>
                        <? }
                        }?>
        </div>
    </div><!-- app-download-section -->
<?php include('template/footer3.php'); ?>
<script type="text/javascript">
    var optionstak = {
        target: '#stak-msg',
        url: 'helper/addstake.php',
        success: function() {},
    }
    $('#stake_sub').submit(function() {
        if(username != null) {
            let stake_amt = $("#stakemaount").val();
            let stake_period = $("#stakemaount").val();
        if(stake_amt == '') { $("#stakemaount").css("border-color", "RED"); toastr.error('phew... Enter Tokens Amount to Stake');return false;} 
        else if ($('.period').val() == "0"){ toastr.error('phew... Select a staking period'); return false;
        } else {
            $(this).ajaxSubmit(optionstak)
            return !1
        }    
        } else {toastr.error('hmm... You must be login!');  return false;} 
    });
</script>