<?php include('template/header.php'); ?>
        <div class="container explorer-top">
            <div class="col-md-12">
                <div class="banner-content explorer-form">
                    <form action="#" method="get" class="subs-form">
                        <div class="input-box expl">
                            <input type="text" value="" required="" name="s" class="form-control" placeholder="Search by steem username for token / transactions">
                            <button type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- banner-block -->
<div class="explorer-section">
    <div class="support-category-section">
        <div class="container">
            <div class="row">
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
                    <div class="support-category-block">
                        <h4>Total Distributed</h4>
                        <h5>230,456,23</h5>
                        <hr>
                        <h4>Total Token holders</h4>
                        <h5>230,456,23</h5>
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
            </div>
        </div>
    </div>


    
    <div class="activity-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title"><h4>Top Token Holders</h4></div>
                        </div>
                        <div class="activity-block">
                            <div class="row my-entry">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div><img src="./images/post/authors/2.png" alt="img" class="img-responsive"></div>
                                        <div class="exp-user">freedom</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="exp-amt"><span id="tk-amt">2342342123</span> Dlikes</div>
                                </div>
                            </div>
                            <div class="row my-entry">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div><img src="./images/post/authors/2.png" alt="img" class="img-responsive"></div>
                                        <div class="exp-user">freedom</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="exp-amt"><span id="tk-amt">2342342123</span> Dlikes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title"><h4>Latest Transactions</h4></div>
                        </div>
                        <?php
                        $sqlt = "SELECT username, amount, reason FROM transactions";
                        $result = $conn->query($sqlt);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) { ?>
                        <div class="activity-block">
                            <div class="row my-entry">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div><span class="btn btn-icon btn-exp"><span class="text-dark">Tx</span></span></div>
                                        <div class="exp-user"><?php echo $row["username"]; ?></div>
                                        <div class="exp-user">For <span><?php echo $row["reason"]; ?></span></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="exp-amt"><span id="tk-amt"><?php echo $row["amount"]php; ?></span> Dlikes</div>
                                </div>
                            </div>
                        </div>
                        <? }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- activity-section -->

                            
</div><!-- explorer-section -->
<?php include('template/footer.php'); ?>