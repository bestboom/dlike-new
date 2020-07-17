<?php include('template/header7.php');
$link = $_GET['link'];
$user = $_GET['user'];

$sql_P = $conn->query("SELECT * FROM dlikeposts where username='$user' and  permlink='$link'");
if ($sql_P && $sql_P->num_rows > 0){
    $row_P = $sql_P->fetch_assoc();
    $imgUrl = $row_P["img_url"];
    $post_time = strtotime($row_P["created_at"]);
    $permlink = $row_P["permlink"];
    $author = $row_P["username"];
    $title = $row_P["title"];
    $description = $row_P["description"];
    $category = $row_P["ctegory"];
    $post_tags = $row_P["tags"];
    $post_hash_tags = preg_replace('/(\w+)/', '#$1', $post_tags);
    $ext_url = $row_P["ext_url"];
}

$sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$user'");
    $row_W = $sql_W->fetch_assoc(); $profile_pic = $row_W["profile_pic"];

$checkLikes = $conn->query("SELECT * FROM postslikes WHERE author = '$user' and permlink = '$link'");
    $row_L = $checkLikes->fetch_assoc();
    if ($checkLikes->num_rows > 0){$postLikes = $row_L['likes'];}else{$postLikes = '0';}
    $post_income = $postLikes * $post_reward;

$urlData = parse_url($ext_url );
$host = $urlData['host'];
?>
<style type="text/css">
    .hov_vote{cursor:pointer;width: 21px;height: 21px;margin-top:-3px;}
    .post-tags{padding-bottom: 5px !important;margin-bottom: 5px !important;}
    .post-style-two.post-full-width .post-contnet-wrap {padding: 30px 40px 31px 40px;}
</style>
</div>
    <div class="latest-post-section">
        <div class="container">
            <article class="post-style-two post-full-width">
                <div class="post-thumb">
                    <?php echo '<a href="#"><img src="'.$imgUrl.'" alt="'.$permlink.'" class="img-responsive"></a>'; ?>
                </div>
                <div class="post-contnet-wrap">
                    <div class="post-footer" style="margin-bottom: 20px;">
                        <div class="post-author-block">
                            <div class="author-thumb"><?php echo '<a href="#"><img src="'.$profile_pic.'" alt="'.$user.'" class="img-responsive"></a>'; ?>
                            </div>
                            <div class="author-info">
                                <h5 style="margin:1px;"><a href="#">@<?php echo $user; ?></a></h5>
                                <span style="font-size: 13px;padding-left: 3px;"><?php echo time_ago($post_time); ?></span>
                            </div>
                        </div>
                        <div class="post-comments" style="color: #1652f0;"><a href="#"><?php echo ucfirst($category); ?></a></div>
                    </div>
                    <h4 class="post-title" style="line-height: 1.8rem;white-space: normal;font-size: 20px;margin-bottom: 18px;font-weight: 700;"><?php echo $title; ?></h4>
                    <p class="post-entry"><?php echo $description; ?><br><span style="float: right;color: #1652f0;font-size: 12px;">Read more on: <?php echo '<a href="'.$ext_url .'" target="_blank">'.$host.'</a>'; ?></span></p>
                    <p class="post-entry post-tags"><?php echo $post_hash_tags; ?></p>
                    <div class="post-footer">
                        <div class="post-author-block">
                            <div><img src="/images/post/dlike-hover.png" class="hov_vote" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>"> | <span id="post_likes" class="post_likes<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $postLikes; ?></span>LIKES</div>
                        </div>
                        <div class="post-comments">
                            <div><span class="dlike_tokens<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $post_income; ?></span> <b>DLIKE</b></div>
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
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/dlike_footer.php'); ?>
<script type="text/javascript">
    $('.hov_vote').click(function() {
        if (dlike_username != null) {
            var mypermlink = $(this).attr("data-permlink");
            var authorname = $(this).attr("data-author");
            $(this).addClass('fas fa-spinner fa-spin like_loader');
            var update = '1';
            $.ajax({ type: "POST",url: "/helper/solve.php", data: {ath: authorname, plink: mypermlink},
                success: function(data) {
                    try { var response = JSON.parse(data)
                        if (response.done == true) {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');$('#upvotefail').modal('show');return false;
                        } else if (response.error == true) {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');toastr.error(response.message);return false;
                        } else {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');
                            toastr.success(response.message);
                            var getpostlikes = $(".post_likes" + mypermlink + authorname).html();
                            var post_income = response.post_income;
                            var newlikes = parseInt(getpostlikes) + parseInt(update);
                            var updatespostincome = newlikes * post_income;
                            $('.post_likes' + mypermlink + authorname).html(newlikes);
                            $('.dlike_tokens' + mypermlink + authorname).html(updatespostincome);
                        }
                    } catch (err) {toastr.error('Sorry. Server response is malformed.');}
                }
            });
        } else {toastr.error('You must be login with DLIKE username!');return false;}
    });
</script>