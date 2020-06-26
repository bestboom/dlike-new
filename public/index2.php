<?php include ('template/header7.php'); ?>
<style>
    .latest-post-section{min-height:80vh;padding: 70px 0px 60px 0px;}
    .hov_vote{cursor:pointer;width: 21px;height: 21px;}
    .post_likes{padding-right: 3px;font-weight: bold;padding-left: 3px;}
    .bottom_block{width:100%}
</style>
</div>
<div class="latest-post-section"><div class="container"><div class="row">
<?php
$sql_T = "SELECT * FROM dlikeposts ORDER BY created_at DESC";
$result_T = $conn->query($sql_T);

if ($result_T && $result_T->num_rows > 0)
{
    while ($row_T = $result_T->fetch_assoc())
    {
        $imgUrl = $row_T["img_url"];
        $post_author = $row_T["username"];
        $author = $row_T["username"];
        $post_time = strtotime($row_T["created_at"]);

        $sql_W = "SELECT * FROM dlikeaccounts where username = '$post_author'";
        $result_W = $conn->query($sql_W);
        if ($result_T && $result_T->num_rows > 0)
        {
            $profile_pic = $row_T["profile_pic"];
            $permlink = $row_T["permlink"];
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
    <div class="author-thumb"><a href="/@pillsjee"><img src="<?php echo $user_profile_pic; ?>" alt="<?php echo $row_T['username']; ?>" class="img-responsive"></a></div>
    <div class="author-info"><h5><a href="/@"><?php echo $author; ?></a><div class="time"><?php echo time_ago($post_time); ?></div></h5> </div></div>
    <div class="post-comments post-catg"><a href="/category/"><span class="post-meta"><?php echo ucfirst($row_T["ctegory"]); ?></span></a></div>
    </div></div>
    <div class="post-thumb img-fluid"><a href="/post/@"><?php echo '<img src=' . $imgUrl . ' class="card-img-top" />'; ?></a></div>
    <div class="post-contnet-wrap">
    <h4 class="post-title"><a href="/post/@"><?php echo $row_T["title"]; ?></a></h4>
    <p class="post-entry post-tags"><?php echo $row_T["tags"]; ?></p>
    <div class="post-footer"><div class="post-author-block bottom_block">
    <div class="post-comments bottom_block" data-target="" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>">
        <div>
            <a class="hov_me"><img src="./images/post/dlike-hover.png" class="hov_vote"></a> | 
            <span class="likes_section"><span class="post_likes"><?php echo $postLikes; ?></span>LIKES</span>
        </div>
        <div>
            <span class="author-info tokens_section"><span class="dlike_tokens"><?php echo $post_income; ?></span> <b>DLIKE</b></span>
        </div>
    </div></div></div>
</article></div>
<?php } } ?> 
</div></div></div>
<div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-sm" role="document"><div class="modal-content mybody"><?php include('template/modals/recomend.php'); ?></div></div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/dlike_footer.php'); ?>
<script type="text/javascript">
    $('.latest-post-section').on("click", ".post-comments", function() {
        if (dlike_username != null) {
            var mypermlink = $(this).attr("data-permlink");
            var authorname = $(this).attr("data-author");
            var getlikespost = $(this).find(".post_likes").html();
            var likesval = $(this).find(".post_likes");
            var tokensval = $(this).find(".dlike_tokens");
            var tokensvals = $(this).find(".dlike_tokens").html();
            console.log(tokensvals);
            var update = 1;
            console.log(getlikespost);
            if(dlike_username == authorname) {
                toastr.error('You can not recommend your own post');
                return false;
            }
            var datat = {ath: authorname, plink: mypermlink};
            $.ajax({
                type: "POST",
                //url: "/helper/verify_post.php",
                url: "/helper/solve.php",
                data: datat,
                success: function(data) {
                    try { var response = JSON.parse(data)
                        if (response.done == true) {
                            $('#upvotefail').modal('show');
                            return false;
                        } else if (response.error == true)  { 
                            toastr.error(response.message);
                            return false;
                        } else {
                            toastr.success(response.message);
                            var newlikes = parseInt(getlikespost) + parseInt(update);
                            console.log(newlikes);
                            //$('.post_likes').html(update);
                            likesval.html(newlikes);
                            var post_income = response.post_income;
                            console.log(post_income);
                            var updatespostincome = newlikes * post_income;
                            console.log(updatespostincome);
                            tokensval.html(updatespostincome);
                        }
                    } catch (err) {toastr.error('Sorry. Server response is malformed.');}
                }
            });
            $("#r_author").val(authorname);
            $("#r_permlink").val(mypermlink);
        } else {toastr.error('You must be login with DLIKE username!');return false;}    
    });
    $('.likes_section').on('click', function() {
        return false;
    })
    $('.tokens_section').on('click', function() {
        return false;
    })
    //$('.latest-post-section').on("click", ".recomendme", function() {
    $('.recomendme').click(function() {
        if (dlike_username != null) {
            //var getpostlikes = $(this).find(".post_likes");
            //var likesofpost = $(".post_likes").html();
            //var likesofpost = parseInt(getpostlikes.html());
            var r_permlink = $("#r_permlink").val();
            var r_author = $("#r_author").val();
            var update = '1';
            console.log(likesofpost);
            var datavr = { rec_permlink: r_permlink,rec_author: r_author};
            $('#recomend-bar').hide();
            $('#recomend-status').show();
            $.ajax({
                type: "POST",
                url: "/helper/solve.php",
                data: datavr,
                success: function(data) {
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            toastr.error(response.message);
                            $('#recomendModal').modal('hide');
                            $('#recomend-status').hide();
                            $('#recomend-bar').show();
                            return false;
                        } else {
                            //$('#up_vote').removeAttr('data-target');
                            //$('#vote_icon').addClass("not-active");
                            toastr.success(response.message);
                            
                            $('#recomendModal').modal('hide');
                            $('#recomend-status').hide();
                            $('#recomend-bar').show();
                        }
                    } catch (err) {
                        toastr.error('Sorry. Server response is malformed.');
                        $('#recomendModal').modal('hide');
                        $('#recomend-status').hide();
                        $('#recomend-bar').show();
                    }
                }
            });
        } else {toastr.error('You must be login with DLIKE username!');return false;}
    });
</script>