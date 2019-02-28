<?php include('template/header.php'); require ('lib/solvemedialib.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 main main_offer">
                    <div class="daily">
                        <div class="daily_box"><p class="daily_start">10</p><p class="daily_mid">STEEM</p><p class="daily_end">Daily</p></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-content">
                        <h2>Dlike - Where You Get Liked</h2>
                        <p>Share What you like with community <br>Get rewarded if community likes your shares</p>
                        <h3>Daily Top Recommended Post (most dlikes) is Rewarded By Dlike</h3>
                        <h3>Anyone can recommend a post for which steem account is not compulsory</h3>
                    </div>
                </div>
                <div class="col-md-3 main_offer">
                    <div class="daily">
                        <div class="daily_box"><p class="daily_start">2500</p><p class="daily_mid">DLike Tokens</p><p class="daily_end">Daily</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sub-header -->
    <style>
            .activeOrderBy {
                    text-decoration: underline;
            }
    </style>
    <div class="latest-post-section">
        <div class="container">
            <article class="post-style-two post-full-width">
                <?php include('helper/top_post.php'); ?>
            </article><!-- post-style-two -->
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
