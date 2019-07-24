<?php  include('template/header5.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_status = "";
$points_per_view = '0.2';
$points_per_like = '20';

if (isset($_COOKIE['username']) || $_COOKIE['username']) {
    $user_name = $_COOKIE['username'];
    $sql_T = "SELECT * FROM prousers where username='$user_name'";
    $result_T = $conn->query($sql_T);

    if ($result_T && $result_T->num_rows > 0) {
        $row_T  = $result_T->fetch_assoc();

        $sql1 = "SELECT * FROM steemposts where username = '$user_name' and created_at > CURRENT_TIMESTAMP - INTERVAL 48 HOUR";
        $result1 = $conn->query($sql1);
    
        if ($result1->num_rows > 0) {
            $mydata = array();
            while($row1 = $result1->fetch_assoc()) {
                $mydata[] = $row1['permlink'];
            }
            $permlinks_list = implode("','", $mydata);

// views call

            $sql2 = "SELECT SUM(totalviews) AS views FROM TotalPostViews where author = '$user_name' and permlink  IN ('$permlinks_list')";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $my_views = $row2['views'];

// likes check

            $sql3 = "SELECT SUM(likes) AS total_likes FROM PostsLikes where author = '$user_name' and permlink  IN ('$permlinks_list')";
            $result3 = $conn->query($sql3);
            $row3 = $result3->fetch_assoc();
            $my_likes = $row3['total_likes'];

// calculate points

            $my_views_points = $my_views * $points_per_view;
            $my_likes_points = $my_likes * $points_per_like;

            $my_points = $my_views_points + $my_likes_points;



        } else {$my_permlinks = '';}

        $user_status = "";
        $my_share = "";
        $my_earnings = "";

    } else {
        $user_status = "You Are not a PRO user";
        $my_points = "0";
        $my_share = "0%";
        $my_earnings = "0 DLIKE";
        $my_permlinks = '';
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
                        <input type="text" class="form-control reward_input" value=" | Total Points" readonly><span class="fas fa-star inp_icon"></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | My Points" readonly>
                        <span class="fas fa-bolt inp_icon"></span>
                        <span class="inp_text"><?php echo $my_points; ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | My Share" readonly>
                        <span class="fas fa-flask inp_icon"></span>
                        <span class="inp_text"><?php echo $my_share; ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Estimated Reward" readonly>
                        <span class="fas fa-database inp_icon"></span>
                        <span class="inp_text"><?php echo $my_earnings; ?></span>
                    </div>
                    <p>Time Remaining for Next Reward Pool</p>
                    <button type="button" class="btn btn-default reward_btn" disabled><span class="far fa-clock" style="font-size: 1.3rem;padding-right: 1rem;"></span><span class="dividendCountDown" style="font-size: 1.7rem;"></span></button>
                    <p>By staking you agree to the Terms</p>
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
    <script type="text/javascript">
        $( document ).ready(function() {
            var countDownDate = 0;
            function counter() {
                setInterval(() => {
                    var date = new Date().toLocaleString("en-US", { timeZone: "Europe/London"});
                    var countDownDate = new Date(date);
                    var i = 60;
                    var h = 24 - countDownDate.getHours();
                    if (h < 10) {
                        h = "0" + h;
                    }
                    var m = 59 - countDownDate.getMinutes();
                    if (m < 10) {
                        m = "0" + m;
                    }
                    var s = countDownDate.getSeconds();
                    s = i - s;
                    if (s < 10) {
                        s = "0" + s;
                    }
                    str = h + ":" + m + ":" + s;
                    i++;
                    $(".dividendCountDown").html(str);
                }, 1000);
            };
            counter(); 
        });
    </script>