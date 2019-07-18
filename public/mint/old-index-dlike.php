<?php include('template/header.php');?>
    <?php if($_COOKIE['username'] == ''){ ?>
        <div class="container">
            <div class="row home-banner">
                <div class="col-md-3 main main_offer">
                    <div class="daily">
                        <div class="daily_box"><p class="daily_start">10</p><p class="daily_mid">STEEM</p><p class="daily_end">Daily</p></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-content">
                        <h2>Dlike - Where You Get Liked</h2>
                        <p>Share What you like with community <br>Get rewarded if community likes your shares</p>
                        <h5>Daily Top Recommended Post (most dlikes) is Rewarded By Dlike</h5>
                        <h5>Anyone can recommend a post for which steem account is not compulsory</h5>
                        <!-- <h2 class="annc">Starting 11th March</h2> -->
                    </div>
                </div>
                <div class="col-md-3 main_offer">
                    <div class="daily">
                        <div class="daily_box"><p class="daily_start">2500</p><p class="daily_mid">DLike Tokens</p><p class="daily_end">Daily</p></div>
                    </div>
                </div>
             </div>
         </div>
            <? } else { ?>
                <div class="banner-content home-connect">
                    <div class="news-headline-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-1 col-md-2">
                                <i class="fas fa-volume-up vol"></i>
                            </div>
                            <div class="col-lg-11 col-md-10">
                                <div class="news-headlines-block">
                                    <div class="news-headlines-slider ticker">
                                        <ul>
                                            <li>DLIKE user ranks added, Share only updated and informative links to get rewarded.</li>
                                        </ul>
                                    </div><!-- news-headlines-slider -->
                                </div>
                            </div>
                        </div>
                    </div>
            <? } ?>
            </div>
        </div>
    </div><!-- sub-header -->
    <!-- <div class="row d-flex justify-content-center" style="background: #eeeeee94;width: 100%;"><a href="https://www.idcmkorea.io/coinsale/home" target="_blank"><img src="images/dlike-coin-sale-ban.png" style="margin-top: 10px;padding-bottom: 3px;margin-bottom:-95px;" class="img-responsive"></a></div> -->
    <div class="latest-post-section">
        <div class="container">
            <!-- <div style="border: 1px dashed;border-radius: 7px;padding: 15px;margin-bottom: 25px;"><h4 style="font-weight: 600;line-height: 1.5;">Write an article about Dlike IEO promotion on (steemit, busy, medium, steempeak) to earn 1000 -3000 DLIKE tokens. Articles must include promotional banners and IDCM KOREA official ANN.</h4></div>
             <article class="post-style-two post-full-width">
                <?php //include('helper/top_post.php'); ?>
            </article> --><!-- post-style-two -->
            <div class="row  align-items-center h-100 post_select">
                <div class="row col-md-3 justify-content-center">
                        <h4 class="lab_post orderByLatest activeOrderBy">Latest</h4>
                        <h4 class="lab_post orderByTopRated">Top Rated</h4>
                </div>
                <div class="col-md-9 lay">&nbsp;</div>
            </div>
            <div class="row" id="content">
            </div>
        </div>
    </div>
<?php include('template/modals/modal.php'); ?>    
<?php include('template/footer.php'); ?>