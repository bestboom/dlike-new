<?php  include('template/header5.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
                        <div class="features-section">
        <div class="container" style="box-shadow: 0px 0px 10px 1px #cccccc;">
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
                        <h4>High Exchange Limits</h4>
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
                        <h4>Secure storage</h4>
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
                            <button type="submit" class="btn btn-default" id="stake_me">STAKE NOW</button>
                        </form>
                        <p>By staking you agree to the Terms</a></p>
                    </div><!-- create-account-block -->
                </div>
            </div>
        </div>
    </div><!-- working-process-section  https://demo.w3layouts.com/demos_new/template_demo/18-05-2019/gadget_signup_form-demo_Free/1576182126/web/index.html-->
<?php include('template/footer3.php'); ?>