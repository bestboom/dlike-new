<?php include('template/header.php'); ?>
<div style="padding-top: 60px;background: #220f58;">
    <div class="col-md-12">
        <div class="container banner-content explorer-form" style="padding: 15px;">
            <form action="/wallets.php" class="subs-form">
                <div class="input-box expl">
                    <input type="text" value="" name="user" class="form-control" id="exp_search" placeholder="Search by dlike username" required />
                    <button type="button" class="wallet-search">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div><!-- banner-block -->
<div class="explorer-section">
    <div class="support-category-section"><div class="container"><div class="row">
        <div class="col-md-4">
            <div class="support-category-block">
                <h4>Max Tokens Supply</h4>
                <h5>800M</h5>
                <hr>
                <h4>Available Tokens Supply</h4>
                <h5>400M</h5>
            </div>
        </div>
        <div class="col-md-4">
            <?php
            $sql = "SELECT sum(amount) as total FROM wallet";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) { ?>
                <div class="support-category-block">
                    <h4>Total Distributed</h4>
                    <h5><?php echo (number_format($row['total'])); ?></h5>
                <? }?>
                <hr>
                <?php
                $sqlu = "SELECT COUNT(username) as users FROM wallet";
                $resultIt = $conn->query($sqlu);
                while($row = $resultIt->fetch_assoc()) { ?>
                    <h4>Total Token holders</h4>
                    <h5><?php echo (number_format($row['users'])); ?></h5>
                <? } ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="support-category-block">
                <h4>Looking For Free Tokens</h4>
                <h5>Promote Dlike</h5>
                <h5></h5>
                <h5>Contact With Support</h5>
                <a class="sup-icon" href="https://discord.gg/JYSkBFk"><i class="fab fa-discord"></i></a>
            </div>
        </div>
    </div></div></div>
    <div class="activity-section"><div class="container"><div class="row">
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-header-title"><h4>Latest Transactions</h4></div>
                </div>
                <table class="table coin-list table-hover" style="border: 1px solid #eee;">
                <tbody>
                    <?php 
                    $sql_T = $conn->query("SELECT * FROM dlike_transactions ORDER BY trx_time DESC LIMIT 30");
                    if ($sql_T && $sql_T->num_rows > 0) {
                        while ($row_T = $sql_T->fetch_assoc()) {
                            $start_time = strtotime($row_T["trx_time"]); 
                            $dlike_user = $row_T["username"];
                            $tx_type = $row_T["type"];
                            if($tx_type == 'a'){$trx_type = '<i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;author';}elseif($tx_type == 'b'){$trx_type = '<i class="fas fa-coffee"></i>&nbsp;&nbsp;curation';}elseif($tx_type == 'c'){$trx_type = '<i class="fas fa-user"></i>&nbsp;&nbsp;affiliate';}

                            $sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$dlike_user'");
                            if ($sql_W && $sql_W->num_rows > 0) { $row_W=$sql_W->fetch_assoc();
                                $profile_pic = $row_W["profile_pic"];} ?>
                            <tr>
                                <td class="exp-user wid_2 ex_pad"><span style="justify-content: left;"><?php echo '<img src="'.$profile_pic.'" class="img-fluid ex_img"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span></td>
                                <td class="exp-amt wid_2 ex_pad"><span><?php echo $trx_type; ?></span></td>
                                <td class="exp-amt wid_2 ex_pad"><span><?php echo $row_T["amount"]; ?></span></td>
                                <td class="exp-amt wid_2 ex_pad"><span><?php echo '<a href="https://dlike.io/post/'.$row_T["reason"].'"><i class="fas fa-globe"></i></a>'; ?></span></td>
                                <td class="exp-amt wid_2 ex_pad"><?php echo time_ago($start_time); ?></td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div></div></div>
    <div class="activity-section"><div class="container"><div class="row"><div class="col-md-12">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-header-title"><h4>Staking Transactions</h4></div>
            </div>
            <table class="table coin-list table-hover" style="border: 1px solid #eee;">
            <tbody>
                <?php 
                $sql_T = $conn->query("SELECT * FROM dlike_staking_transactions ORDER BY trx_time DESC LIMIT 30");
                if ($sql_T && $sql_T->num_rows > 0) {
                    while ($row_T = $sql_T->fetch_assoc()) {
                        $start_time = strtotime($row_T["trx_time"]);$dlike_user = $row_T["username"];$tx_type = $row_T["type"];

                        $sql_F=$conn->query("SELECT * FROM dlikeaccounts where username='$dlike_user'");
                        if ($sql_F && $sql_F->num_rows > 0){$row_F=$sql_F->fetch_assoc();$profile_pic=$row_F["profile_pic"];} ?>
                        <tr>
                            <td class="exp-user wid_2 ex_pad"><span style="justify-content: left;"><?php echo '<img src="'.$profile_pic.'" class="img-fluid ex_img"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span></td>
                            <td class="exp-amt wid_2 ex_pad"><span><?php echo $tx_type; ?></span></td>
                            <td class="exp-amt wid_2 ex_pad"><span><?php echo $row_T["amount"]; ?></span></td>
                            <td class="exp-amt wid_2 ex_pad"><span><?php echo '<a href="https://tronscan.org/#/transaction/'.$row_T["tron_trx"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>'; ?></span></td>
                            <td class="exp-amt wid_2 ex_pad"><?php echo time_ago($start_time); ?></td>
                        </tr>
                    <?php } 
                } ?>
            </tbody>
            </table>
        </div>
    </div></div></div></div>
    <div class="activity-section"><div class="container"><div class="row"><div class="col-md-12">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-header-title"><h4>Withdrawals</h4></div>
            </div>
            <table class="table coin-list table-hover" style="border: 1px solid #eee;">
            <tbody>
                <?php 
                $sql_T = $conn->query("SELECT * FROM dlike_withdrawals ORDER BY req_on DESC LIMIT 30");
                if ($sql_T && $sql_T->num_rows > 0) {
                    while ($row_T = $sql_T->fetch_assoc()) {
                        $start_time = strtotime($row_T["req_on"]);$dlike_user = $row_T["username"];
                        $sql_F=$conn->query("SELECT * FROM dlikeaccounts where username='$dlike_user'");
                        if ($sql_F && $sql_F->num_rows > 0){$row_F=$sql_F->fetch_assoc();$profile_pic=$row_F["profile_pic"];} ?>
                        <tr>
                            <td class="exp-user wid_2 ex_pad"><span style="justify-content: left;"><?php echo '<img src="'.$profile_pic.'" class="img-fluid ex_img"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span></td>
                            <td class="exp-amt wid_2 ex_pad"><span><?php echo $row_T["amount"]; ?></span></td>
                            <td class="exp-amt wid_2 ex_pad"><span><?php echo '<a href="https://tronscan.org/#/transaction/'.$row_T["status"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>'; ?></span></td>
                            <td class="exp-amt wid_2 ex_pad">
                                <?php echo time_ago($start_time); ?></td>
                        </tr>
                    <?php } 
                } ?>
            </tbody>
            </table>
        </div>
    </div></div></div></div>
    <div class="activity-section"><div class="container"><div class="row"><div class="col-md-12">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-header-title"><h4>Top Staking Accounts</h4></div>
            </div>
            <table class="table coin-list table-hover" style="border: 1px solid #eee;">
            <tbody>
                <?php 
                $sql_T = $conn->query("SELECT * FROM dlike_staking ORDER BY amount DESC LIMIT 200");
                if ($sql_T && $sql_T->num_rows > 0) {
                    while ($row_T = $sql_T->fetch_assoc()) {$dlike_user = $row_T["username"];
                        $sql_F=$conn->query("SELECT * FROM dlikeaccounts where username='$dlike_user'");
                        if ($sql_F && $sql_F->num_rows > 0){$row_F=$sql_F->fetch_assoc();$profile_pic=$row_F["profile_pic"];} ?>
                        <tr>
                            <td class="exp-user wid_2 ex_pad"><span style="justify-content: left;"><?php echo '<img src="'.$profile_pic.'" class="img-fluid ex_img"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span></td>
                            <td class="exp-amt wid_2 ex_pad"><span><?php echo $row_T["amount"]; ?></span></td>
                        </tr>
                    <?php } 
                } ?>
            </tbody>
            </table>
        </div>
    </div></div></div></div>



    <div class="new-ticker-block new-ticker-block-section">
        <div class="container">
            <div class="new-ticker-block-wrap">
                <div class="ticker-head">
                    <ul class="nav nav-tabs ticker-nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#favorite_ticker" role="tab" data-toggle="tab">
                                <h5>Favorites</h5>
                                <i class="fa fa-stroopwafel"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#BNB_markets" role="tab" data-toggle="tab">BNB Markets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#BTC_markets" role="tab" data-toggle="tab">BTC Markets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ETH_markets" role="tab" data-toggle="tab">ETH Markets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#USDT_markets" role="tab" data-toggle="tab">USDT Markets</a>
                        </li>
                        <li class="nav-item nav-item-last">
                            <form action="#" method="get" class="search-form">
                                <div class="input-box">
                                    <input type="text" value="" required="" name="s" class="form-control" placeholder="Search...">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="market-ticker-block">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active show" id="favorite_ticker">
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
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ETH/BTC</td>
                                        <td><span class="color-buy">0.05722 </span>/ $399.8</td>
                                        <td><span class="color-buy">+2.76%</span></td>
                                        <td>0.05723</td>
                                        <td>0.05550</td>
                                        <td>5,523.15018959</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>IOST/BTC</td>
                                        <td><span class="color-sell">0.00000490  </span>/ $399.8/td&gt;
                                        </td><td><span class="color-sell">-2.73%</span></td>
                                        <td>0.0000051</td>
                                        <td>0.0000046</td>
                                        <td>5,300.71861161</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>POA / BTC</td>
                                        <td><span class="color-sell">0.0000054 </span>/ $0.0</td>
                                        <td><span class="color-buy">+2.70%</span></td>
                                        <td>0.0000055</td>
                                        <td>0.0000052</td>
                                        <td>4,683.61663443</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                </tbody>
                            </table><!-- coin-list table -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="BNB_markets">
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
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ETH/BTC</td>
                                        <td><span class="color-buy">0.05722 </span>/ $399.8</td>
                                        <td><span class="color-buy">+2.76%</span></td>
                                        <td>0.05723</td>
                                        <td>0.05550</td>
                                        <td>5,523.15018959</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>IOST/BTC</td>
                                        <td><span class="color-sell">0.00000490  </span>/ $399.8/td&gt;
                                        </td><td><span class="color-sell">-2.73%</span></td>
                                        <td>0.0000051</td>
                                        <td>0.0000046</td>
                                        <td>5,300.71861161</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>POA / BTC</td>
                                        <td><span class="color-sell">0.0000054 </span>/ $0.0</td>
                                        <td><span class="color-buy">+2.70%</span></td>
                                        <td>0.0000055</td>
                                        <td>0.0000052</td>
                                        <td>4,683.61663443</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                </tbody>
                            </table><!-- coin-list table -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="BTC_markets">
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
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ETH/BTC</td>
                                        <td><span class="color-buy">0.05722 </span>/ $399.8</td>
                                        <td><span class="color-buy">+2.76%</span></td>
                                        <td>0.05723</td>
                                        <td>0.05550</td>
                                        <td>5,523.15018959</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>IOST/BTC</td>
                                        <td><span class="color-sell">0.00000490  </span>/ $399.8/td&gt;
                                        </td><td><span class="color-sell">-2.73%</span></td>
                                        <td>0.0000051</td>
                                        <td>0.0000046</td>
                                        <td>5,300.71861161</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>POA / BTC</td>
                                        <td><span class="color-sell">0.0000054 </span>/ $0.0</td>
                                        <td><span class="color-buy">+2.70%</span></td>
                                        <td>0.0000055</td>
                                        <td>0.0000052</td>
                                        <td>4,683.61663443</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                </tbody>
                            </table><!-- coin-list table -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="ETH_markets">
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
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ETH/BTC</td>
                                        <td><span class="color-buy">0.05722 </span>/ $399.8</td>
                                        <td><span class="color-buy">+2.76%</span></td>
                                        <td>0.05723</td>
                                        <td>0.05550</td>
                                        <td>5,523.15018959</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>IOST/BTC</td>
                                        <td><span class="color-sell">0.00000490  </span>/ $399.8/td&gt;
                                        </td><td><span class="color-sell">-2.73%</span></td>
                                        <td>0.0000051</td>
                                        <td>0.0000046</td>
                                        <td>5,300.71861161</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>POA / BTC</td>
                                        <td><span class="color-sell">0.0000054 </span>/ $0.0</td>
                                        <td><span class="color-buy">+2.70%</span></td>
                                        <td>0.0000055</td>
                                        <td>0.0000052</td>
                                        <td>4,683.61663443</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                </tbody>
                            </table><!-- coin-list table -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="USDT_markets">
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
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ETH/BTC</td>
                                        <td><span class="color-buy">0.05722 </span>/ $399.8</td>
                                        <td><span class="color-buy">+2.76%</span></td>
                                        <td>0.05723</td>
                                        <td>0.05550</td>
                                        <td>5,523.15018959</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>IOST/BTC</td>
                                        <td><span class="color-sell">0.00000490  </span>/ $399.8/td&gt;
                                        </td><td><span class="color-sell">-2.73%</span></td>
                                        <td>0.0000051</td>
                                        <td>0.0000046</td>
                                        <td>5,300.71861161</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>POA / BTC</td>
                                        <td><span class="color-sell">0.0000054 </span>/ $0.0</td>
                                        <td><span class="color-buy">+2.70%</span></td>
                                        <td>0.0000055</td>
                                        <td>0.0000052</td>
                                        <td>4,683.61663443</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>NCASH/BTC</td>
                                        <td>0.00050900 / $3.55</td>
                                        <td><span class="color-sell">-8.70%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>BNB/BTC</td>
                                        <td><span class="color-sell">0.001741</span> / $12.1</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.0005700</td>
                                        <td>0.0004910</td>
                                        <td>5,774.97192430</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ICX/BTC</td>
                                        <td>0.0000093 / $12.1</td>
                                        <td><span class="color-sell">+7.59%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>XVG/BTC</td>
                                        <td><span class="color-buy">0.0000041</span> / $0.03</td>
                                        <td><span class="color-buy">-2.44%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td>ADA/BTC</td>
                                        <td><span class="color-buy">0.0014589</span> / $18.29</td>
                                        <td><span class="color-sell">+5.74%</span></td>
                                        <td>0.00551478</td>
                                        <td>0.00478963</td>
                                        <td>92.76872852</td>
                                    </tr>
                                </tbody>
                            </table><!-- coin-list table -->
                        </div><!-- market-ticker-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- explorer-section -->
<?php include('template/footer.php'); ?>