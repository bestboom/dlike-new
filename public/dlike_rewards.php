<?php  include('template/header.php'); ?></div>
<style type="text/css">
    .rewards_fileds{padding: 10px 0px;justify-content: space-between;margin: 1px;border-bottom: 1px solid #eee!important;}
    .rewards_user_icon{font-size: 9px;color: #c51d24;}
    .rewards_type{font-size: 1rem;color:#495057;opacity: 1;}
    #highContainer{height: 370px; width: 100%;margin-top: 30px;}
    .dividendCountDown{font-size: 1.7rem;}.rewards_clock{font-size: 1.3rem;padding-right: 1rem;}
    .stk_rewards_ann{color:#c51d24;font-weight:600;}.stk_ann_icon{padding-right:10px;}
</style>
<?php $sql1 =  $conn->query("SELECT * FROM dlike_daily_rewards where DATE(update_time) = CURDATE() order by update_time DESC Limit 1");
if ($sql1 && $sql1->num_rows > 0) 
{   $row1 = $sql1->fetch_assoc();$today_likes = $row1["today_upvotes"];$staking = $row1["dlike_staking"];$dao = $row1["dlike_dao"];$team = $row1["dlike_team"];$charity = $row1["dlike_charity"];$foundation = $row1["dlike_foundation"];
} else {$today_likes = 0;}

$sqlQuery = $conn->query("SELECT yesterday_upvotes,update_time FROM dlike_rewards_history ORDER BY update_time DESC LIMIT 14");
    if ($sqlQuery->num_rows > 0) {  $data = array();
        while($row = $sqlQuery->fetch_assoc()) { $votes = $row['yesterday_upvotes']; $update = strtotime($row['update_time']) *1000; $data[] = [(int)$update, (int)$votes];}
    }
$author_today_rewards = $today_likes * $author_reward;
$curators_today_reward = $today_likes * $curator_reward;

$sql_T = $conn->query("SELECT count(*) as today_aff_rewards FROM dlike_transactions WHERE type='c' and DATE(trx_time) = CURDATE()");
    if ($sql_T->num_rows>0){$row_T=$sql_T->fetch_assoc();$total_aff_gen = $row_T["today_aff_rewards"];}else{$total_aff_gen = '0';}

$affiliate_today_rewards = $total_aff_gen * $affiliate_reward;
$airdrop_today_rewards = ($today_likes - $total_aff_gen) * $airdrop_reward;
?>
<div class="working-process-section"><div class="container">
    <div class="row">
        <div class="col-lg-6  col-md-6">
            <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                <h3 style="text-align: center;">
                    <div style="font-size: 1.1rem;">Reward Pool Today</div>
                    <div class="reward_amount">Likes Till Now: <?php echo $today_likes; ?></div>
                </h3>
                <form class="user-connected-from create-account-form reward_form" />
                <div class="row rewards_fileds">
                    <div><span class="fas fa-database"></span><span class="rewards_type"> | Authors </span></div><div><span><?php echo $author_today_rewards; ?></span></div>
                </div>
                <div class="row rewards_fileds">
                    <div><span class="fas fa-database"></span><span class="rewards_type"> | Curators </span></div><div><span><?php echo $curators_today_reward; ?></span></div>
                </div>
                <div class="row rewards_fileds">
                    <div><span class="fas fa-database"></span><span class="rewards_type"> | Affiliates </span></div><div><span><?php echo $affiliate_today_rewards; ?></span></div>
                </div>
                <div class="row rewards_fileds">
                    <div><span class="fas fa-database"></span><span class="rewards_type"> | Staking </span></div><div><span><?php echo $staking; ?></span></div>
                </div>
                <div class="row rewards_fileds">
                    <div><span class="fas fa-database"></span><span class="rewards_type"> | DAO </span><a href="https://tronscan.org/#/address/TGGnB81bATA6he2ZEVeFzXU2yzmi5YZ49m" target="_blank"><i class="fas fa-user-circle rewards_user_icon"></i></a></div>
                    <div><span><?php echo $dao; ?></span></div>
                </div>
                <div class="row rewards_fileds">
                    <div><span class="fas fa-database"></span><span class="rewards_type"> | Charity </span><a href="https://tronscan.org/#/address/TGGnB81bATA6he2ZEVeFzXU2yzmi5YZ49m" target="_blank"><i class="fas fa-user-circle rewards_user_icon"></i></a></div>
                    <div><span><?php echo $charity; ?></span></div>
                </div>
                <div class="row rewards_fileds">
                    <div><span class="fas fa-database"></span><span class="rewards_type"> | Team </span><a href="https://tronscan.org/#/address/TGGnB81bATA6he2ZEVeFzXU2yzmi5YZ49m" target="_blank"><i class="fas fa-user-circle rewards_user_icon"></i></a></div>
                    <div><span><?php echo $team; ?></span></div>
                </div>
                <div class="row rewards_fileds">
                    <div><span class="fas fa-database"></span><span class="rewards_type"> | Foundation </span><a href="https://tronscan.org/#/address/TGGnB81bATA6he2ZEVeFzXU2yzmi5YZ49m" target="_blank"><i class="fas fa-user-circle rewards_user_icon"></i></a></div>
                    <div><span><?php echo $foundation; ?></span></div>
                </div>
                <p>Time Remaining for Next Reward Pool</p>
                <button type="button" class="btn btn-default reward_btn" disabled><span class="far fa-clock rewards_clock"></span><span class="dividendCountDown"></span></button>
                <!--<p class="DlikeComments">Rewards are updated at certain intervals.</p>-->
                </form>
            </div>
        </div>
        <div class="offset-lg-1 col-lg-5 col-md-6"><div class="working-process">
            <h4 class="pool_head">DLIKE Daily Reward Pool Distribution</h4>
            <p>You can earn DLIKE tokens for your contributions to the DLIKE community. The more interactions you have, more will be the earnings. <br>DLIKE is simple proof of likes network where every like generates 1 DLIKE token. This generated token gets distributed into all sectors of DLIKE community as per following share.</p>
            <p class="stk_rewards_ann"><span class="fas fa-hand-point-right stk_ann_icon"></span>DLIKE has a daily staking reward pool for top stakers.</p>
            <div><img src="/images/dlike_pool.jpg" class="img-fluid" alt=""></div>
        </div></div>
    </div>
    <div id="highContainer"></div>
</div></div>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var countDownDate = 0;
    function counter() {
        setInterval(() => {
            var date = new Date().toLocaleString("en-US", { timeZone: "Europe/London"});
            var countDownDate = new Date(date);
            var i = 60; var h = 24 - countDownDate.getHours();
            if (h < 10) {h = "0" + h;}
            var m = 59 - countDownDate.getMinutes();
            if (m < 10) {m = "0" + m;}
            var s = countDownDate.getSeconds();
            s = i - s;
            if (s < 10) {s = "0" + s;}
            str = h + ":" + m + ":" + s;
            i++;
            $(".dividendCountDown").html(str);
        }, 1000);
    };
    counter();

var chart = new Highcharts.Chart({
    chart: {renderTo: 'highContainer',type: 'areaspline'},
    title: {text: ''},
    yAxis: {title: { text: 'Number of Likes'}},
    xAxis: {type: 'datetime',labels: {format: '{value:%e. %b}'},title: {text: 'Date'}},
    tooltip: {xDateFormat: '%e. %b %Y'},
    series: [{name: 'Likes',data: <?php echo json_encode($data); ?>}]
});
</script>
<?php include('template/footer.php'); ?>