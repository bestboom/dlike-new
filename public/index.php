<?php include('template/header.php'); require ('lib/solvemedialib.php'); ?>
        <div class="container">
            <div class="offset-md-2 col-md-8">
                <div class="banner-content">
                    <h2>Welcome To Dlike</h2>
                    <p>Share What you like with community <br>Get rewarded if community likes your shares</p>
                </div>
            </div>
        </div>
    </div><!-- sub-header -->
    <div class="latest-post-section">
        <div class="container">
            <article class="post-style-two post-full-width">
                <?php include('helper/top_post.php'); ?>
            </article><!-- post-style-two -->
            <div class="row" id="content">
            </div>
        </div>
    </div>
<?php include('template/modals/modal.php'); ?>    
<?php include('template/footer.php'); ?>