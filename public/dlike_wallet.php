<?php include('template/header7.php'); 
if (!isset($_COOKIE['dlike_username']) || !$_COOKIE['dlike_username']) {
    die('<script>window.location.replace("https://dlike.io/share","_self")</script>');
} else {
    $dlike_user = $_COOKIE['dlike_username'];
}
?>
</div>
<div class="working-process-section" style="padding-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="offset-lg-1 col-lg-5 col-md-6">
                <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                    <h3 style="text-align: center;">
                        <div style="font-size: 1.1rem;">Total Reward Pool</div>
                        <div class="reward_amount">7,000 DLIKE</div>
                    </h3>
                    <p style="margin-top: -20px;font-weight: 600;color: red;"><?php echo $user_status; ?></p>


                    <p><?php  ?></p>



                    <form class="user-connected-from create-account-form reward_form" />
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Total Points" readonly>
                        <span class="fas fa-star inp_icon"></span>
                        <span class="inp_text"><?php echo_formatted($total_points); ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | My Points" readonly>
                        <span class="fas fa-bolt inp_icon"></span>
                        <span class="inp_text"><?php echo_formatted($my_points); ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | My Share" readonly>
                        <span class="fas fa-flask inp_icon"></span>
                        <span class="inp_text"><?php echo_formatted($my_points/$total_points * 100); echo("%"); ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Estimated Reward" readonly>
                        <span class="fas fa-database inp_icon"></span>
                        <span class="inp_text"><?php echo_formatted($my_points/$total_points * $total_reward); echo(" DLIKE"); ?></span>
                    </div>
                    <p>Time Remaining for Next Reward Pool</p>
                    <button type="button" class="btn btn-default reward_btn" disabled><span class="far fa-clock" style="font-size: 1.3rem;padding-right: 1rem;"></span><span class="dividendCountDown" style="font-size: 1.7rem;"></span></button>
                    <p class="DlikeComments">Rewards are updated at certain intervals.</p>
                    <div id="output"></div>
                	</form>
                </div><!-- create-account-block -->
            </div>
            <div class="col-lg-6  col-md-6">
                <div class="working-process">
                    <h4 class="pool_head">DLIKE REWARD POOL</h4>
                    <p>
                        You can earn tokens for your contributions to the DLIKE network. The more interactions on your content, the greater your share of the daily token reward pool to your OffChain wallet.
                    </p>
                    <p style="color:#c51d24;font-weight: 600;">
                        <span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>
                        DLIKE reward pool is only available to PRO users
                    </p>
                    <div>
                        <img src="/images/post/dlike-reward.png" class="img-fluid" alt="">
                    </div>
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