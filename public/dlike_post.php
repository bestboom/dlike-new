<?php include('template/header7.php');
$link = $_GET['link'];$user = $_GET['user'];

$sql_P = $conn->query("SELECT * FROM dlikeposts where username='$user' and  permlink='$link'");
if ($sql_P && $sql_P->num_rows > 0){
    $row_P = $sql_P->fetch_assoc();
    $imgUrl = $row_P["img_url"];
    $post_time = strtotime($row_P["created_at"]);
    $permlink = $row_P["permlink"];
    $author = $row_P["username"];
    $title = $row_P["title"];
    $description = $row_P["description"];
    $post_category = $row_P["ctegory"];
    $post_tags = $row_P["tags"];
    $post_hash_tags = preg_replace('/(\w+)/', '#$1', $post_tags);
    $ext_url = $row_P["ext_url"];
    $post_id = $row_P["id"];
}

$sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$user'");
    $row_W = $sql_W->fetch_assoc(); $profile_pic = $row_W["profile_pic"];

$checkLikes = $conn->query("SELECT * FROM postslikes WHERE author = '$user' and permlink = '$link'");
    $row_L = $checkLikes->fetch_assoc();
    if ($checkLikes->num_rows > 0){$postLikes = $row_L['likes'];}else{$postLikes = '0';}
    $post_income = $postLikes * $post_reward;

$urlData = parse_url($ext_url );
$host = preg_replace('/^www\./', '', $urlData['host']);
?>
<style type="text/css">
    .hov_vote{cursor:pointer;width: 21px;height: 21px;margin-top:-3px;}
    .post-tags{padding-bottom: 5px !important;margin-bottom: 5px !important;}
    .post-style-two.post-full-width .post-contnet-wrap {padding: 30px 40px 31px 40px;}
    #post_likes{padding-right: 3px;font-weight: bold;padding-left: 3px;}
</style>
</div>
    <div class="latest-post-section">
        <div class="container">
            <article class="post-style-two post-full-width">
                <div class="post-thumb"><?php echo '<img src="'.$imgUrl.'" alt="'.$permlink.'" class="img-responsive">'; ?></div>
                <div class="post-contnet-wrap">
                    <div class="post-footer" style="margin-bottom: 20px;">
                        <div class="post-author-block">
                            <div class="author-thumb"><?php echo '<a href="/profile/'.$author.'"><img src="'.$profile_pic.'" alt="'.$author.'" class="img-responsive"></a>'; ?></div>
                            <div class="author-info">
                                <h5 style="margin:1px;"><?php echo '<a href="/profile/'.$author.'">'.$author.'</a>'; ?></h5>
                                <span style="font-size: 13px;padding-left: 3px;"><?php echo time_ago($post_time); ?></span>
                            </div>
                        </div>
                        <div class="post-comments" style="color: #1652f0;"><a href="#"><?php echo ucfirst($post_category); ?></a></div>
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
            </article>
<center><div style="font-size: 18px;font-weight: 700;padding-bottom: 15px;">More Like This</div></center>
<div class="row"><?php
$sql_T = $conn->query("SELECT * FROM dlikeposts where ctegory='$post_category' and id != '$post_id' ORDER BY created_at DESC LIMIT 9");
if ($sql_T && $sql_T->num_rows > 0)
{   while ($row_T = $sql_T->fetch_assoc())
    {
        $imgUrl = $row_T["img_url"];
        $author = $row_T["username"];
        $post_time = strtotime($row_T["created_at"]);
        $title = $row_T["title"];
        $post_tags = $row_T["tags"];
        $permlink = $row_T["permlink"];
        $post_hash_tags = preg_replace('/(\w+)/', '#$1', $post_tags);
        $sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$author'");
        if ($sql_W && $sql_W->num_rows > 0)
        {   $row_W = $sql_W->fetch_assoc();
            $profile_pic = $row_W["profile_pic"];
            if (!empty($profile_pic)) { $user_profile_pic = $profile_pic; } else { $user_profile_pic = 'https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';}
        }
        $checkLikes = $conn->query("SELECT * FROM postslikes WHERE author = '$author' and permlink = '$permlink'");
        $row_L = $checkLikes->fetch_assoc();
        if ($checkLikes->num_rows > 0){$postLikes = $row_L['likes'];}else{$postLikes = '0';}
        $post_income = $postLikes * $post_reward; ?>
    <div class="col-lg-4 col-md-6 postsMainDiv"><article class="post-style-two">
    <div class="post-contnet-wrap-top"><div class="post-footer"><div class="post-author-block">
    <div class="author-thumb"><?php echo '<a href="/profile/'. $author.'"><img src="'.$user_profile_pic.'" alt="'.$row_T['username'].'" class="img-responsive"></a>'; ?></div>
    <div class="author-info"><h5><?php echo '<a href="/profile/'. $author.'">'. $author.'</a>'; ?><div class="time"><?php echo time_ago($post_time); ?></div></h5> </div></div>
    <div class="post-catg"><a href="/category/"><span class="post-meta"><?php echo ucfirst($row_T["ctegory"]); ?></span></a></div>
    </div></div>
    <div class="post-thumb img-fluid"><?php echo '<a href="/post/'.$author.'/'.$permlink.'"><img src=' . $imgUrl . ' class="card-img-top" /></a>'; ?></a></div>
    <div class="post-contnet-wrap post_bottom">
    <h4 class="post-title"><?php echo '<a href="/post/'.$author.'/'.$permlink.'">'.$title.'</a>'; ?></h4>
    <p class="post-entry post-tags"><?php echo $post_hash_tags; ?></p>
    <div class="post-comments bottom_block">
        <div><img src="/images/post/dlike-hover.png" class="hov_vote" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>"> | <span id="post_likes" class="post_likes<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $postLikes; ?></span>LIKES</div>
        <div><span class="dlike_tokens<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $post_income; ?></span> <b>DLIKE</b></div>
    </div>
    </article></div>
<?php } } ?> 
</div>
</div></div>
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