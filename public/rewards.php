<?php  include('template/header5.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
</div><!-- sub-header -->
<div class="working-process-section" style="padding-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6  col-md-6">
                <div class="working-process">
                    <h4 style="text-align: center;font-weight: 800;font-size: 1.3rem;margin: 30px;">
                        DLIKE REWARD POOL
                    </h4>
                    <p>
                        You can earn tokens for your contributions to the DLIKE network. The more interactions on your content, the greater your share of the daily token reward pool to your OffChain wallet.
                    </p>
                    <p style="color:#c51d24;font-weight: 600;">
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
                        <div style="font-size: 1.4rem;color: #1652f0;">7,000 DLIKE</div>
                    </h3>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" style="border: none;border-bottom: 1px solid #eee;background-color: #fff;" value=" | Total Points" readonly><span class="fas fa-star inp_icon"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" style="border: none;border-bottom: 1px solid #eee;background-color: #fff;" value=" | My Points" readonly><span class="fas fa-bolt inp_icon"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" style="border: none;border-bottom: 1px solid #eee;background-color: #fff;" value=" | My Share" readonly><span class="fas fa-flask inp_icon"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" style="border: none;border-bottom: 1px solid #eee;background-color: #fff;" value=" | Estimated Reward" readonly><span class="fas fa-database inp_icon"></span>
                    </div>
                    <p>Time Remaining for Next Reward Pool</p>
                    <button class="btn btn-default" style="border-radius: 4px;"><span class="far fa-clock" style="font-size: 1.4rem;padding-right: 1rem;" disabled></span><span class="dividendCountDown" style="font-size: 1.7rem;"></span></button>
                </form>
                <p>By staking you agree to the Terms</p>
            </div><!-- create-account-block -->
        </div>
    </div>
                    <div class="features-section" style="padding-top: 40px;">
                        <div class="container" style="box-shadow: 0px 0px 10px 1px #cccccc;padding: 40px;">
                            <div class="row">
                                <div class="col-md-2 col-sm-3">
                                    <div class="features-block-icons">
                                        <span class="fab fa-gratipay reward_icon"></span>
                                        <p>Likes <br>
                                            <span style="font-size: 0.7rem;">Each like on your posts</span>
                                            <br><span style="color:#c51d24;">20+</span>
                                        </p>
                                    </div><!-- features-block -->
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="features-block-icons">
                                        <span class="fas fa-eye reward_icon"></span>
                                        <p>Views <br><span style="font-size: 0.7rem;">For 100 views on your posts</span><br>
                                            <span style="color:#c51d24;">10+</span></p>
                                    </div><!-- features-block -->
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="features-block-icons">
                                        <span class="fas fa-comment-alt reward_icon"></span>
                                        <p>comments <br><span style="font-size: 0.7rem;">Each comment on your posts</span>
                                            <br><span style="color:#c51d24;">10+</span>
                                        </p>
                                    </div><!-- features-block -->
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="features-block-icons">
                                        <span class="fas fa-chevron-circle-up reward_icon"></span>
                                        <p>upvotes <br><span style="font-size: 0.7rem;">$1 steem upvote</span> 
                                            <br><span style="color:#c51d24;">100+</span>
                                        </p>
                                    </div><!-- features-block -->
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="features-block-icons">
                                        <span class="fas fa-users reward_icon"></span>
                                        <p>Referralss <br><span style="font-size: 0.7rem;">Each New Referral </span>
                                            <br><span style="color:#c51d24;">50+</span>
                                        </p>
                                    </div><!-- features-block -->
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="features-block-icons">
                                        <span class="fas fa-user-plus reward_icon"></span>
                                        <p>Referral Income <br><span style="font-size: 0.7rem;">Each Post By Your Referrals</span><br/><span style="color:#c51d24;">5+</span></p>
                                    </div><!-- features-block -->
                                </div>
                            </div>
                        </div>
                    </div>
</div>
</div><!-- working-process-section  https://demo.w3layouts.com/demos_new/template_demo/18-05-2019/gadget_signup_form-demo_Free/1576182126/web/index.html-->
<?php include('template/footer3.php'); ?>
<script type="text/javascript">
    $( document ).ready(function() { 
    //var date = new Date();
    //console.log(date.toLocaleString('en-GB')); 
    var countDownDate = 0;
    function counter() {
        setInterval(() => {
            var date = new Date().toLocaleString("en-US", { timeZone: "Europe/London"});
            var countDownDate = new Date(date);
            //console.log(date);
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
            //$("div.time").html(str);
            $(".dividendCountDown").html(str);
        }, 1000);
    };
    counter(); 
});
</script>