<?php include('template/header7.php');
$link = $_GET['link'];
$user = $_GET['user'];

$sql_P = $conn->query("SELECT * FROM dlikeposts where username='$user' and  permlink='$link'");
if ($sql_P && $sql_P->num_rows > 0){
    $row_P = $sql_P->fetch_assoc();
    $imgUrl = $row_P["img_url"];
    $post_time = strtotime($row_P["created_at"]);
    $permlink = $row_P["permlink"];
    $title = $row_P["title"];
    $description = $row_P["description"];
}

$sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$user'");
    $row_W = $sql_W->fetch_assoc();
    $profile_pic = $row_W["profile_pic"];
?>
</div>
    <div class="latest-post-section">
        <div class="container">
            <article class="post-style-two post-full-width">
                <div class="post-thumb">
                    <?php echo '<a href="#"><img src="'.$imgUrl.'" alt="'.$permlink.'" class="img-responsive"></a>'; ?>
                </div>
                <div class="post-contnet-wrap">
                    <div class="author-info">
                        <h5><a href="#">@<?php echo $user; ?></a></h5>
                        <span class="post-meta"><?php echo time_ago($post_time); ?></span>
                    </div>
                    <h4 class="post-title" style="line-height: 1.8rem;white-space: normal;">
                        <a href="#"><?php echo $title; ?></a>
                    </h4>
                    <p class="post-entry"><?php echo $description; ?></p>
                    <div class="post-footer">
                        <div class="post-author-block">
                            <div class="author-thumb">
                                <?php echo '<a href="#"><img src="'.$profile_pic.'" alt="'.$user.'" class="img-responsive"></a>'; ?>
                            </div>
                            <div class="author-info">
                                <h5><a href="#">@<?php echo $user; ?></a></h5>
                                <a href="#">@<?php echo $user; ?></a>
                            </div>
                        </div>
                        <div class="post-comments">
                            <img src="./images/post/cmnt-icon.png" alt="img" class="img-responsive">
                            <a href="#">03 Comments</a>
                        </div>
                    </div>
                </div>
            </article><!-- post-style-two -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <article class="post-style-two">
                        <div class="post-thumb">
                            <a href="#">
                                <img src="./images/post/2.jpg" alt="img" class="img-responsive">
                            </a>
                        </div>
                        <div class="post-contnet-wrap">
                            <span class="post-meta">30 NOV, 2019</span>
                            <h4 class="post-title">
                                <a href="#">
                                    Publish what you think
                                </a>
                            </h4>
                            <p class="post-entry">
                                No third party can freeze or lose your funds! With enterprise-level security 
                                superior to most other t is a long established....
                            </p>
                            <div class="post-footer">
                                <div class="post-author-block">
                                    <div class="author-thumb">
                                        <a href="#">
                                            <img src="./images/post/authors/2.png" alt="img" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="author-info">
                                        <h5>
                                            <a href="#">
                                                Nayn e Castro
                                            </a>
                                        </h5>
                                        <a href="#">@excoin</a>
                                    </div>
                                </div>
                                <div class="post-comments">
                                    <img src="./images/post/cmnt-icon.png" alt="img" class="img-responsive">
                                    <a href="#">08</a>
                                </div>
                            </div>
                        </div>
                    </article><!-- post-style-two -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="post-style-two ">
                        <div class="post-thumb">
                            <a href="#">
                                <img src="./images/post/3.jpg" alt="img" class="img-responsive">
                            </a>
                        </div>
                        <div class="post-contnet-wrap">
                            <span class="post-meta">30 NOV, 2019</span>
                            <h4 class="post-title">
                                <a href="#">
                                    Publish what you think
                                </a>
                            </h4>
                            <p class="post-entry">
                                No third party can freeze or lose your funds! With enterprise-level security 
                                superior to most other t is a long established....
                            </p>
                            <div class="post-footer">
                                <div class="post-author-block">
                                    <div class="author-thumb">
                                        <a href="#">
                                            <img src="./images/post/authors/3.png" alt="img" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="author-info">
                                        <h5>
                                            <a href="#">
                                                Nayn e Castro
                                            </a>
                                        </h5>
                                        <a href="#">@excoin</a>
                                    </div>
                                </div>
                                <div class="post-comments">
                                    <img src="./images/post/cmnt-icon.png" alt="img" class="img-responsive">
                                    <a href="#">15</a>
                                </div>
                            </div>
                        </div>
                    </article><!-- post-style-two -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="post-style-two">
                        <div class="post-thumb">
                            <a href="#">
                                <img src="./images/post/4.jpg" alt="img" class="img-responsive">
                            </a>
                        </div>
                        <div class="post-contnet-wrap">
                            <span class="post-meta">30 NOV, 2019</span>
                            <h4 class="post-title">
                                <a href="#">
                                    Publish what you think
                                </a>
                            </h4>
                            <p class="post-entry">
                                No third party can freeze or lose your funds! With enterprise-level security 
                                superior to most other t is a long established....
                            </p>
                            <div class="post-footer">
                                <div class="post-author-block">
                                    <div class="author-thumb">
                                        <a href="#">
                                            <img src="./images/post/authors/4.png" alt="img" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="author-info">
                                        <h5>
                                            <a href="#">
                                                Nayn e Castro
                                            </a>
                                        </h5>
                                        <a href="#">@excoin</a>
                                    </div>
                                </div>
                                <div class="post-comments">
                                    <img src="./images/post/cmnt-icon.png" alt="img" class="img-responsive">
                                    <a href="#">05</a>
                                </div>
                            </div>
                        </div>
                    </article><!-- post-style-two -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="post-style-two">
                        <div class="post-thumb">
                            <a href="#">
                                <img src="./images/post/5.jpg" alt="img" class="img-responsive">
                            </a>
                        </div>
                        <div class="post-contnet-wrap">
                            <span class="post-meta">30 NOV, 2019</span>
                            <h4 class="post-title">
                                <a href="#">
                                    Publish what you think
                                </a>
                            </h4>
                            <p class="post-entry">
                                No third party can freeze or lose your funds! With enterprise-level security 
                                superior to most other t is a long established....
                            </p>
                            <div class="post-footer">
                                <div class="post-author-block">
                                    <div class="author-thumb">
                                        <a href="#">
                                            <img src="./images/post/authors/5.png" alt="img" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="author-info">
                                        <h5>
                                            <a href="#">
                                                Nayn e Castro
                                            </a>
                                        </h5>
                                        <a href="#">@excoin</a>
                                    </div>
                                </div>
                                <div class="post-comments">
                                    <img src="./images/post/cmnt-icon.png" alt="img" class="img-responsive">
                                    <a href="#">16</a>
                                </div>
                            </div>
                        </div>
                    </article><!-- post-style-two -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="post-style-two">
                        <div class="post-thumb">
                            <a href="#">
                                <img src="./images/post/6.jpg" alt="img" class="img-responsive">
                            </a>
                        </div>
                        <div class="post-contnet-wrap">
                            <span class="post-meta">30 NOV, 2019</span>
                            <h4 class="post-title">
                                <a href="#">
                                    Publish what you think
                                </a>
                            </h4>
                            <p class="post-entry">
                                No third party can freeze or lose your funds! With enterprise-level security 
                                superior to most other t is a long established....
                            </p>
                            <div class="post-footer">
                                <div class="post-author-block">
                                    <div class="author-thumb">
                                        <a href="#">
                                            <img src="./images/post/authors/6.png" alt="img" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="author-info">
                                        <h5>
                                            <a href="#">
                                                Nayn e Castro
                                            </a>
                                        </h5>
                                        <a href="#">@excoin</a>
                                    </div>
                                </div>
                                <div class="post-comments">
                                    <img src="./images/post/cmnt-icon.png" alt="img" class="img-responsive">
                                    <a href="#">25</a>
                                </div>
                            </div>
                        </div>
                    </article><!-- post-style-two -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="post-style-two">
                        <div class="post-thumb">
                            <a href="#">
                                <img src="./images/post/7.jpg" alt="img" class="img-responsive">
                            </a>
                        </div>
                        <div class="post-contnet-wrap">
                            <span class="post-meta">30 NOV, 2019</span>
                            <h4 class="post-title">
                                <a href="#">
                                    Publish what you think
                                </a>
                            </h4>
                            <p class="post-entry">
                                No third party can freeze or lose your funds! With enterprise-level security 
                                superior to most other t is a long established....
                            </p>
                            <div class="post-footer">
                                <div class="post-author-block">
                                    <div class="author-thumb">
                                        <a href="#">
                                            <img src="./images/post/authors/7.png" alt="img" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="author-info">
                                        <h5>
                                            <a href="#">
                                                Nayn e Castro
                                            </a>
                                        </h5>
                                        <a href="#">@excoin</a>
                                    </div>
                                </div>
                                <div class="post-comments">
                                    <img src="./images/post/cmnt-icon.png" alt="img" class="img-responsive">
                                    <a href="#">35</a>
                                </div>
                            </div>
                        </div>
                    </article><!-- post-style-two -->
                </div>
            </div>
        </div>
    </div>
<?php include ('template/dlike_footer.php'); ?>