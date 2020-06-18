<?php include('template/header7.php');?>
</div><!-- sub-header -->
<div class="latest-post-section" style="min-height:80vh;padding: 70px 0px 60px 0px;">
    <div class="container">
        <div class="row">
        <?php
        $sql_T = "SELECT * FROM dlikeposts ORDER BY created_at DESC";
            $result_T = $conn->query($sql_T);

        if ($result_T && $result_T->num_rows > 0) { 
            while ($row_T = $result_T->fetch_assoc()) { 
                $imgUrl = $row_T["img_url"];
        ?>
            <div class="col-lg-4 col-md-6">
                <article class="post-style-two">
                    <div class="post-contnet-wrap-top">
                    <div class="post-footer">
                    <div class="post-author-block">
                    <div class="author-thumb"><a href="/@pillsjee"><img src="https://steemitimages.com/u/avatar" alt="img" class="img-responsive"></a></div>
                    <div class="author-info">
                    <h5><a href="/@"><?php echo $row_T["username"]; ?></a><div class="time"></div></h5> 
                    </div>
                    </div>
                    <div class="post-comments post-catg"><a href="/category/"><span class="post-meta"><?php echo $row_T["ctegory"]; ?></span></a></div>
                    </div>
                    </div>
                    <div class="post-thumb img-fluid" style="width: 100%"><a href="/post/@"><?php echo '<img src='.$imgUrl.'>'; ?></a></div>
                    <div class="post-contnet-wrap">
                    <div class="row d-flex justify-content-center hov-it"><div class="hov-item"><img src="./images/post/dlike-hover.png" alt="img" class="img-responsive"><span class="hov_me" data-toggle="modal" data-target="" data-likes="" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><div class="hov-txt"><h5><span id="hov-num" class="commentsDiv' + currentLikesDivElement + '"></span></h5></div></span></div></div>
                    <h4 class="post-title"><a href="/post/@' + $post.author + '/' + $post.permlink + '"><?php echo $row_T["title"]; ?></a></h4>
                    <p class="post-entry post-tags"><?php echo $row_T["tags"]; ?></p>
                    <div class="post-footer">
                    <div class="post-author-block">
                    
                    <div class="post-comments"><a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+newValue+'"></i></a><span>0 votes</span></div>

                    <div class="author-info"><span id="se_token'+newValue +'" data-popover="true" data-html="true" data-content="">0</span> <b>DLIKE</b></div>
                    </div>
                    </div>
                    </div>
                </article>
            </div>
        <?php
            }
            }
        ?> 
        </div>
    </div>  
</div>
<?php include('template/dlike_footer.php'); ?>