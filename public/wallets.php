<?php include('template/header5.php'); 
//if (isset($_GET['user'])) {
//     $user_wallet = $_GET['user'];
//}
//$sqls = "SELECT amount FROM wallet where username='$user_wallet'"; 
//$resultAmount = $conn->query($sqls);
//$rowIt = $resultAmount->fetch_assoc();
?>
</div><!-- banner-block -->

<div class="catagori-section" style="margin-top: 100px;"">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="catagori-content-block">
                        <nav class="catagori-list" style="background: #eee;">
                            <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_wallet" role="tab" data-toggle="tab" aria-selected="false">
                                        <h4>DLIKE</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#nav_mycelium" role="tab" data-toggle="tab" aria-selected="true">
                                        <h4>STEEM/SBD</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_exodus" role="tab" data-toggle="tab" aria-selected="false">
                                        <h4>Tips</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_copay" role="tab" data-toggle="tab" aria-selected="false">
                                        <h4>Become PRO</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_nano" role="tab" data-toggle="tab" aria-selected="false">
                                        <h4>Buy Tokens</h4>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="tab-content catagoritab-content" id="nav-tabContent">
                            <div role="tabpanel" class="tab-pane fade" id="nav_wallet">
                                <div class="catagori-content">
                                	
                                    <p class="catagori-info"></p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">DLIKE: </h5><p><?php echo (number_format($rowIt['amount'])); ?> DLIKE</p>
                                        </div>
                                        <p style="font-size: 0.7rem;margin-top: -12px;display: flex;justify-content: space-between;">Native Token for DLIKE Platform<span style="color: #1652f0;font-weight: 700;">Transfer</span></p>
                                        <hr style="margin-top: 0.2rem;">
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">STAKING: </h5><p>312 DLIKE</p>
                                        </div>
                                        <p style="font-size: 0.7rem;margin-top: -12px;display: flex;justify-content: space-between;">Earn bonus token by staking<span style="color: #1652f0;font-weight: 700;">Stake Now</span></p>
                                        <hr style="margin-top: 0.2rem;">
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">DSC: </h5><p>0 DSC</p>
                                        </div>
                                        <p style="font-size: 0.7rem;margin-top: -12px;">DLIKE Stable Coin (coming soon)</p>
                                        <hr style="margin-top: 0.2rem;">
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade active show" id="nav_mycelium">
                                <div class="catagori-content">
                                	<div style="background: #f3faf0;padding: 12px;display: flex;justify-content: space-between;border-radius: 6px;border-color: 1px solid #eee;"><b>Pending Rewards:</b> 0.228 SBD and 1.798 SP<button class="btn btn-default" style="background: #333;color: #fff;font-weight: 600;">Claim Rewards</button></div>
                                    <p class="catagori-info"></p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">STEEM: </h5><p>165 STEEM</p>
                                        </div>
                                        <p style="font-size: 0.7rem;margin-top: -12px; display:flex;justify-content: space-between;">Native Token for STEEM Blockchain<span style="color: #1652f0;font-weight: 700;">Transfer</span></p>
                                        <hr style="margin-top: 0.2rem;">
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">STEM DOLLAR: </h5><p>312 SBD</p>
                                        </div>
                                        <p style="font-size: 0.7rem;margin-top: -12px; display:flex;justify-content: space-between;">Basic STEEM token valued at dollar<span style="color: #1652f0;font-weight: 700;">Transfer</span></p>
                                        <hr style="margin-top: 0.2rem;">
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">STEM POWER: </h5><p>4523 STEEM</p>
                                        </div>
                                        <p style="font-size: 0.7rem;margin-top: -12px;">STEEM Power is delegated STEEM amount</p>
                                        <hr style="margin-top: 0.2rem;">
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_exodus">
                                <div class="catagori-content">
                                    <h5>TIP Rewards - Withdrawable To ETH Address</h5>
                                    <p class="catagori-info">
                                        <div class="form-group">
                                        	<div class="input-group mb-3">
                                        		<div class="input-group-prepend">
                                            		<div class="input-group-text mb-deck"> ETH Addr</div>
                                        		</div>
                                            	<input type="text" class="form-control eth_field" name="title" value="" placeholder="Enter ETH Addr">&nbsp;
                                            <button type="submit" class="btn btn-primary">ADD</button>	
                                            </div>
                                        </div>

                                    </p>
                                    <div class="pros-cons-block">
                                    <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">DAI: </h5><p>0.008 DAI</p>
                                        </div>
                                        <p style="font-size: 0.7rem;margin-top: -12px;display:flex;justify-content: space-between;">A stable coin by MakerDAO<span style="color: #1652f0;font-weight: 700;">Withdraw</span></p>
                                        <hr style="margin-top: 0.2rem;">
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">Hydro: </h5><p>0.036 HYDRO</p>
                                        </div>
                                        <p style="font-size: 0.7rem;margin-top: -12px;display:flex;justify-content: space-between;">A token of project hydro<span style="color: #1652f0;font-weight: 700;">Withdraw</span></p>
                                        <hr style="margin-top: 0.2rem;">
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_copay">
                                <div class="catagori-content">
                                    <h4>Become PRO user - Enjoy Maximum Rewards</h4>
                                    <p class="catagori-info">
                                        <h4>What is Pro user?</h4>
                                        <p>PRO user is the apex user status on DLIKE platform which enjoys maximum available rewards</p>
                                        <h4>Advantages of PRO users</h4>
                                        <p>
                                        	<li>Allowed upto 3 post shares per day</li>
                                        	<li>3X upvotes on all your posts</li>
                                        	<li>Daily DLIKE token income through reward pool</li>
                                        	<li>TIP to any post and earn 40% reward share</li>
                                        </p>
                                        <h4>How to become PRO?</h4>
                                        <p>DLIKE PRO status is achieved by burning 10,000 DLIKE Tokens</p>
                                    </p>
                                    <div class="pros-cons-block">
                                        <button class="btn btn-primary">Become PRO</button>
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_nano">
                                <div class="catagori-content">
                                    <p class="catagori-info">
                                        DLIKE is the native token of DLIKE platform which is purely a utility token. PRO users cane arn DLIKE tokens on daily basis through reward pool. To become PRO, users are required to burn 10,000 DLIKE tokens.</p>
                                    <p>    
                                        DLIKE token is not yet listed on exchanges so it can be purchased here at a price of 0.025 USD.
                                    </p>
                                    <div class="pros-cons-block">
                                        <button class="btn btn-primary">BUY DLIKE Tokens</button>
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                        </div>
                    </div><!-- catagori-content-block -->
                </div>
                <div class="col-lg-3">
                    <div class="catagori-vintage">
                        <img src="./images/others/7.png" alt="img" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>




<div class="explorer-section">

    <div class="activity-section">
        <div class="container">
            <div class="row wallet-trx">

                <div class="offset-lg-1 col-lg-10 offset-md-1 col-md-10">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title"><h4>Latest Transactions</h4></div>
                        </div>
                        <?php
                        $sqlt = "SELECT username, amount, reason FROM transactions where username='$user_wallet' ORDER BY trx_time DESC";
                        $result = $conn->query($sqlt);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) { ?>
                        <div class="activity-block">
                            <div class="row my-entry">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div><span class="btn btn-icon btn-exp"><span class="text-dark">Tx</span></span></div>
                                        <div class="exp-user"></div>
                                        <div class="exp-user">For <span><?php echo $row["reason"]; ?></span></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="exp-amt"><span id="tk-amt"><?php echo (number_format($row["amount"])); ?></span> Dlikes</div>
                                </div>
                            </div>
                        </div>
                        <? }
                        }  ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- activity-section -->



<div class="new-ticker-block new-ticker-block-section">
        <div class="container">
            <div class="new-ticker-block-wrap">
                <div class="ticker-head">
                    <ul class="nav nav-tabs ticker-nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" href="#dlike_trx" role="tab" data-toggle="tab" aria-selected="true">
                                <h5>DLIKE</h5>
                                <i class="fa fa-stroopwafel"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#steem_trx" role="tab" data-toggle="tab">STEEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tips_trx" role="tab" data-toggle="tab">TIPS</a>
                        </li>
                        <li class="nav-item nav-item-last">
                        </li>
                    </ul>
                </div>
                <div class="market-ticker-block">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active show" id="dlike_trx">
                            <table class="table coin-list table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">TX</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user_wallet = 'pillsjee';
                        $sqlt = "SELECT username, amount, reason FROM transactions where username='$user_wallet' ORDER BY trx_time DESC";
                        $result = $conn->query($sqlt);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) { ?>
                            	<tr>
                                    <td><span class="btn btn-icon btn-exp"><span class="text-dark">Tx</span></span></td>
                                    <td class="exp-user">For <span><?php echo $row["reason"]; ?></span></td>
                                    <td class="exp-amt"><span id="tk-amt"><?php echo (number_format($row["amount"])); ?></span> Dlikes</td>
                                </tr>
                        <? 	} }  ?>
                                </tbody>
                            </table><!-- coin-list table -->
                        </div>
                       <div role="tabpanel" class="tab-pane fade" id="steem_trx">
                            <table class="table coin-list table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Pair</th>
                                        <th scope="col">Last Price</th>
                                        <th scope="col">24h Change <span class="ti-arrow-down"></span></th>
                                        <th scope="col">24h High</th>
                                        <th scope="col">24h Low</th>
                                        <th scope="col">24h Volume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td> POA / BTC</td>
                                        <td><span class="color-buy">0.00006822 </span>/$0.48</td>
                                        <td><span class="color-sell">-23.80%</span></td>
                                        <td>0.00007300</td>
                                        <td>0.00005510</td>
                                        <td>7,522.88586112</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ONT/BTC</td>
                                        <td><span class="color-buy">0.00050900 / $3.55</span></td>
                                        <td><span class="color-buy">+8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                </tbody>
                            </table><!-- coin-list table -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tips_trx">
                            <table class="table coin-list table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Pair</th>
                                        <th scope="col">Last Price</th>
                                        <th scope="col">24h Change <span class="ti-arrow-down"></span></th>
                                        <th scope="col">24h High</th>
                                        <th scope="col">24h Low</th>
                                        <th scope="col">24h Volume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td> POA / BTC</td>
                                        <td><span class="color-buy">0.00006822 </span>/$0.48</td>
                                        <td><span class="color-sell">-23.80%</span></td>
                                        <td>0.00007300</td>
                                        <td>0.00005510</td>
                                        <td>7,522.88586112</td>
                                    </tr>

                                </tbody>
                            </table><!-- coin-list table -->
                        </div><!-- market-ticker-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<br>


</div><!-- explorer-section -->
<?php include('template/footer3.php'); ?>