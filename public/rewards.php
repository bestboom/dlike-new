<?php  include('template/header5.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$total_reward = 7000;
$user_status = "You Must Login";
        $my_points = "0";
        $my_share = "0%";
        $my_earnings = "0 DLIKE";

// <! --------- ONLY FOR TESTING PURPOSES -------->
$_COOKIE['username'] = "certseek";
$total_points = 1000;
$permlinks_list = array();
// <! --------- ONLY FOR TESTING PURPOSES -------->

$sql1 = "SELECT SUM(total_points) FROM prousers";
$result1 = $conn->query($sql1);
$total_points = $result1->fetch_assoc();

if (isset($_COOKIE['username']) || $_COOKIE['username'])
{
    $user_name = $_COOKIE['username'];
    $sql_T = "SELECT * FROM prousers where username='$user_name'";
    $result_T = $conn->query($sql_T);

    if ($result_T && $result_T->num_rows > 0) {
        $row_T  = $result_T->fetch_assoc();

        $sql2 = "SELECT total_points FROM prousers where username='$user_name'";
        $result2 = $conn->query($sql2);
        $my_points = $result2->fetch_assoc();

        var_dump($total_points);
        var_dump($my_points);

    } else {
        $user_status = "You Are not a PRO user";
        $my_points = "0";
        $my_share = "0%";
        $my_earnings = "0 DLIKE";
    }
}
?>
</div><!-- sub-header -->
<div class="working-process-section" style="padding-top: 80px;">
    <div class="container">
        <div class="row">
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
                        <span class="inp_text"><?php echo($total_points); ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | My Points" readonly>
                        <span class="fas fa-bolt inp_icon"></span>
                        <span class="inp_text"><?php echo($my_points); ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | My Share" readonly>
                        <span class="fas fa-flask inp_icon"></span>
                        <span class="inp_text" id="myShare"><?php echo(($my_points/$total_points * 100) . "%"); ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Estimated Reward" readonly>
                        <span class="fas fa-database inp_icon"></span>
                        <span class="inp_text" id="myEarnings"><?php echo($my_points/$total_points * $total_reward); ?></span>
                    </div>
                    <p>Time Remaining for Next Reward Pool</p>
                    <button type="button" class="btn btn-default reward_btn" disabled><span class="far fa-clock" style="font-size: 1.3rem;padding-right: 1rem;"></span><span class="dividendCountDown" style="font-size: 1.7rem;"></span></button>
                    <p class="DlikeComments">By staking you agree to the Terms</p>
                    <div id="output"></div>
                </div><!-- create-account-block -->
            </div>
        </div>
        <div class="features-section" style="padding-top: 40px;">
            <div class="container pool_box">
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <div class="features-block-icons">
                            <span class="fab fa-gratipay reward_icon"></span>
                            <p>Likes <br>
                                <span style="font-size: 0.7rem;">Each like on your posts</span>
                                <br><span class="head_color">20+</span>
                            </p>
                        </div><!-- features-block -->
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <div class="features-block-icons">
                            <span class="fas fa-eye reward_icon"></span>
                            <p>Views <br><span style="font-size: 0.7rem;">For 100 views on your posts</span><br>
                                <span class="head_color">20+</span></p>
                            </div><!-- features-block -->
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="features-block-icons">
                                <span class="fas fa-comment-alt reward_icon"></span>
                                <p>comments <br><span style="font-size: 0.7rem;">Each one on your posts</span>
                                    <br><span class="head_color">10+</span>
                                </p>
                            </div><!-- features-block -->
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="features-block-icons">
                                <span class="fas fa-chevron-circle-up reward_icon"></span>
                                <p>upvotes <br><span style="font-size: 0.7rem;">$1 steem upvote</span>
                                    <br><span class="head_color">100+</span>
                                </p>
                            </div><!-- features-block -->
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="features-block-icons">
                                <span class="fas fa-users reward_icon"></span>
                                <p>Referralss <br><span style="font-size: 0.7rem;">Each New Referral </span>
                                    <br><span class="head_color">50+</span>
                                </p>
                            </div><!-- features-block -->
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="features-block-icons">
                                <span class="fas fa-user-plus reward_icon"></span>
                                <p>Referral Income <br><span style="font-size: 0.7rem;">Each Post By Your Referrals</span><br/><span class="head_color">5+</span></p>
                            </div><!-- features-block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- working-process-section-->
    <?php $conn->close(); include('template/footer3.php'); ?>
