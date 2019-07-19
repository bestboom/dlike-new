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
                <div class="col-lg-5  col-md-6">
                    <div class="working-process">
                        <h3>
                            MANAGE YOUR GADGETS ACCOUNT
                        </h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege
                        </p>
                    </div>
                </div>
                <div class="offset-lg-2 col-lg-5 col-md-6">
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
    </div><!-- working-process-section -->
<?php include('template/footer3.php'); ?>