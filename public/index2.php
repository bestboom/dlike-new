<?php include ('template/header7.php'); ?>
<style>
    .latest-post-section{min-height:80vh;padding: 70px 0px 60px 0px;}
    .hov_vote{cursor:pointer;width: 21px;height: 21px;margin-top:-3px;}
    #post_likes{padding-right: 3px;font-weight: bold;padding-left: 3px;}
    .bottom_block{width:100%}
    .post-style-two .post-contnet-wrap-top{padding: 5px 10px 5px 10px;}
    .post-style-two .author-info h5{padding-top: 6px;line-height: 1em;}
    .post_bottom{padding: 15px 15px 10px !important;}
    .col-lg-4.col-md-6.postsMainDiv > .post-style-two{margin-bottom: 40px !important;}
    .post-tags{padding-bottom: 5px !important;margin-bottom: 5px !important;}
</style>
</div>
<div class="latest-post-section"><div class="container"><div class="row">
<?php
$sql_T = $conn->query("SELECT * FROM dlikeposts ORDER BY created_at DESC");

if ($sql_T && $sql_T->num_rows > 0)
{
    while ($row_T = $sql_T->fetch_assoc())
    {
        $imgUrl = $row_T["img_url"];
        $author = $row_T["username"];
        $post_time = strtotime($row_T["created_at"]);
        $title = $row_T["title"];
        $post_tags = $row_T["tags"];
        $permlink = $row_T["permlink"];
        $post_hash_tags = preg_replace('/(\w+)/', '#$1', $post_tags);
        $sql_W = "SELECT * FROM dlikeaccounts where username = '$author'";
        $result_W = $conn->query($sql_W);
        if ($result_W && $result_W->num_rows > 0)
        {
            $profile_pic = $row_W["profile_pic"];
            if (!empty($profile_pic))
            { $user_profile_pic = $profile_pic; } else { $user_profile_pic = 'https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';}
        }
        $checkLikes = "SELECT * FROM postslikes WHERE author = '$author' and permlink = '$permlink'";
        $resultLikes = mysqli_query($conn, $checkLikes);
        $row_L = $resultLikes->fetch_assoc();
        if ($resultLikes->num_rows > 0){$postLikes = $row_L['likes'];}else{$postLikes = '0';}
        $post_income = $postLikes * $post_reward;
?>
<div class="col-lg-4 col-md-6 postsMainDiv"><article class="post-style-two">
    <div class="post-contnet-wrap-top"><div class="post-footer"><div class="post-author-block">
    <div class="author-thumb"><?php echo '<a href="/profile/'. $author.'"><img src="'.$user_profile_pic.'" alt="'.$row_T['username'].'" class="img-responsive"></a>'; ?></div>
    <div class="author-info"><h5><?php echo '<a href="/profile/'. $author.'">'. $author.'</a>'; ?><div class="time"><?php echo time_ago($post_time); ?></div></h5> </div></div>
    <div class="post-catg"><a href="/category/"><span class="post-meta"><?php echo ucfirst($row_T["ctegory"]); ?></span></a></div>
    </div></div>
    <div class="post-thumb img-fluid"><a href="/post/"><?php echo '<img src=' . $imgUrl . ' class="card-img-top" />'; ?></a></div>
    <div class="post-contnet-wrap post_bottom">
    <h4 class="post-title"><?php echo '<a href="/post/'.$author.'/'.$permlink.'">'.$title.'</a>'; ?></h4>
    <p class="post-entry post-tags"><?php echo $post_hash_tags; ?></p>
    <div class="post-comments bottom_block">
        <div><img src="./images/post/dlike-hover.png" class="hov_vote" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>"> | <span id="post_likes" class="post_likes<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $postLikes; ?></span>LIKES</div>
        <div><span class="dlike_tokens<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $post_income; ?></span> <b>DLIKE</b></div>
    </div>
</article></div>
<?php } } ?> 
</div></div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/dlike_footer.php'); ?>
<script type="text/javascript">
    $('.hov_vote').click(function() {
        if (dlike_username != null) {
            var mypermlink = $(this).attr("data-permlink");
            var authorname = $(this).attr("data-author");
            $(this).addClass('fas fa-spinner fa-spin like_loader');
            var update = '1';
            var datat = {ath: authorname, plink: mypermlink};
            $.ajax({
                type: "POST",
                url: "/helper/solve.php",
                data: datat,
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