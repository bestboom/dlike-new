<?php  include('template/header5.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
</div><!-- sub-header -->
<div class="working-process-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6  col-md-7">
                <div class="working-process">
                    <h4 style="text-align: center;font-weight: 800;font-size: 1.3rem;margin: 30px;">
                        DLIKE REWARD POOL
                    </h4>
                    <p>
                        You can earn tokens for your contributions to the Minds network. The more interactions on your content, the greater your share of the daily token reward pool to your OffChain address.
                    </p>
                    <div>
                        <img src="/images/post/dlike-reward.png" class="img-fluid" alt="">
                    </div>
                    <div class="features-section" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="features-block">
                                        <img src="./images/others/9.png" alt="img" class="img-responsive">
                                        <h4>Votes</h4>
                                        <p>
                                            10+
                                        </p>
                                    </div><!-- features-block -->
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="features-block">
                                        <img src="./images/others/10.png" alt="img" class="img-responsive">
                                        <h4>Recomendations</h4>
                                        <p>
                                            10+
                                        </p>
                                    </div><!-- features-block -->
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="features-block">
                                        <img src="./images/others/11.png" alt="img" class="img-responsive">
                                        <h4>Fast and Reliable</h4>
                                        <p>
                                         10+
                                     </p>
                                 </div><!-- features-block -->
                             </div>
                             <div class="col-md-4 col-sm-6">
                                <div class="features-block">
                                    <img src="./images/others/12.png" alt="img" class="img-responsive">
                                    <h4>Margin Trading</h4>
                                    <p>
                                        10+
                                    </p>
                                </div><!-- features-block -->
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="features-block">
                                    <img src="./images/others/13.png" alt="img" class="img-responsive">
                                    <h4>24/7 Live Support</h4>
                                    <p>
                                        10+
                                    </p>
                                </div><!-- features-block -->
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="features-block">
                                    <img src="./images/others/14.png" alt="img" class="img-responsive">
                                    <h4>Referrals</h4>
                                    <p>
                                        10+
                                    </p>
                                </div><!-- features-block -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offset-lg-1 col-lg-5 col-md-5">
            <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                <h3 style="font-size: 1rem;">
                    Total Reward Pool<br>7,000 DLIKE
                </h3>
                <form action="" class="user-connected-from create-account-form" />   
                    <input type="hidden" name="staker" id="staking_user" value="<? echo $staker; ?>" />   
                    <div class="form-group">
                        <input type="text" class="form-control" style="border: none;border-bottom: 1px solid #eee;" value="Total Points">
                    </div>
                    <div class="form-group">
                        <span class="fas fa-flask inp_icon"></span><input type="text" class="form-control" style="border: none;border-bottom: 1px solid #eee;" value="My Points">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" style="border: none;border-bottom: 1px solid #eee;" value=" | My Share"><span class="fas fa-flask inp_icon"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" style="border: none;border-bottom: 1px solid #eee;" value="Estimated Reward">
                    </div>
                    <button type="submit" class="btn btn-default" id="stake_me">STAKE NOW</button>
                </form>
                <p>By staking you agree to the Terms</a></p>
            </div><!-- create-account-block -->
        </div>
    </div>
</div>
</div><!-- working-process-section  https://demo.w3layouts.com/demos_new/template_demo/18-05-2019/gadget_signup_form-demo_Free/1576182126/web/index.html-->
<?php include('template/footer3.php'); ?>