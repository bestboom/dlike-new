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
                $post_author = $row_T["username"];
                $author = $row_T["username"];
                $post_time = strtotime($row_T["created_at"]); 

        $sql_W = "SELECT * FROM dlikeaccounts where username = '$post_author'"; 
        $result_W = $conn->query($sql_W);
        if ($result_T && $result_T->num_rows > 0) { 
            $profile_pic = $row_T["profile_pic"];
            $permlink = $row_T["permlink"];
            if(!empty($profile_pic)) {$user_profile_pic = $profile_pic;} else {$user_profile_pic = 'https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';}
        }  
        $checkLikes = "SELECT * FROM postslikes WHERE author = '$author' and permlink = '$permlink'";
            $resultLikes = mysqli_query($conn, $checkLikes);
            $row_L = $resultLikes->fetch_assoc();
            if ($resultLikes->num_rows > 0) { $postLikes = $row_L['likes'];} else {$postLikes = '0';}
        ?>
            <div class="col-lg-4 col-md-6 postsMainDiv">
                <article class="post-style-two">
                    <div class="post-contnet-wrap-top">
                    <div class="post-footer">
                    <div class="post-author-block">
                    <div class="author-thumb"><a href="/@pillsjee"><img src="<?php echo $user_profile_pic; ?>" alt="<?php echo $row_T['username']; ?>" class="img-responsive"></a></div>
                    <div class="author-info">
                    <h5><a href="/@"><?php echo $author; ?></a><div class="time"><?php echo time_ago($post_time); ?></div></h5> 
                    </div>
                    </div>
                    <div class="post-comments post-catg"><a href="/category/"><span class="post-meta"><?php echo ucfirst($row_T["ctegory"]); ?></span></a></div>
                    </div>
                    </div>
                    <div class="post-thumb img-fluid"><a href="/post/@"><?php echo '<img src='.$imgUrl.' class="card-img-top" />'; ?></a></div>
                    <div class="post-contnet-wrap">
                    <!--<div class="row d-flex justify-content-center hov-it">
                    <div class="hov-item">
                    <img src="./images/post/dlike-hover.png" alt="img" class="img-responsive">
                    <span class="hov_me" data-toggle="modal" data-target="" data-likes="" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '">
                    <div class="hov-txt">
                    <h5>
                        <span id="hov-num" class="commentsDiv' + currentLikesDivElement + '"></span></h5></div></span></div></div>-->
                    <h4 class="post-title"><a href="/post/@' + $post.author + '/' + $post.permlink + '"><?php echo $row_T["title"]; ?></a></h4>
                    <p class="post-entry post-tags"><?php echo $row_T["tags"]; ?></p>
                    <div class="post-footer">
                    <div class="post-author-block" style="width:100%">
                    
                    <div class="post-comments"><a  class="hov_me" data-toggle="modal" data-target="" data-likes="" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>"><img src="./images/post/dlike-hover.png" style="cursor:pointer;width: 21px;height: 21px;"></a><span>| &nbsp;<?php echo $postLikes; ?> LIKES</span></div>

                    <div class="author-info"><span id="dlike_tokens" data-popover="true" data-html="true" data-content="">0</span> <b>DLIKE</b></div>
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
<?php include('template/modals/modal.php'); ?> 
<?php include('template/dlike_footer.php'); ?>
<script type="text/javascript">
    $('.latest-post-section').on("click", ".hov_me", function() {
        if (dlike_username != null) {
            var mypermlink = $(this).attr("data-permlink");
            var authorname = $(this).attr("data-author");
            var postsrec = $(this).attr("data-likes");
            //console.log(postsrec);
            var datat = {
                ath: authorname,
                plink: mypermlink
            };
            $.ajax({
                type: "POST",
                url: "/helper/verify_post.php",
                data: datat,
                success: function(data) {
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            $('#upvotefail').modal('show');
                        } else {
                            $('#recomendModal').modal('show');
                        }
                    } catch (err) {
                        alert('Sorry. Server response is malformed.')
                    }
                }
            });

            $("#r_author").val(authorname);
            $("#r_permlink").val(mypermlink);
            $("#r_likes").val(postsrec);
        } else{
            toastr.error('You must be login with DLIKE username!');
            return false;
        }    
    });

    $('.recomendme').click(function() {
        if (dlike_username != null) {
            var r_permlink = $("#r_permlink").val();
            var r_author = $("#r_author").val();
            var r_likes = $("#r_likes").val();
            var newlikes = parseInt(r_likes) + 1;
            var datavr = {
                rec_permlink: r_permlink,
                rec_author: r_author
            };
            $('#recomend-bar').hide();
            $('#recomend-status').show();

            $.ajax({
                type: "POST",
                url: "/helper/solve.php",
                data: datavr,
                success: function(data) {
                    //console.log(success);
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            toastr.error('There is some issue!');
                            $('#recomendModal').modal('hide');
                            $('#recomend-status').hide();
                            $('#recomend-bar').show();
                            return false;
                        } else {
                            $('#up_vote').removeAttr('data-target');
                            $('#vote_icon').addClass("not-active");
                            toastr.success('Thanks for Recomendation!');
                            $('#total_likes').html(newlikes);
                            $('#recomendModal').modal('hide');
                            $('#recomend-status').hide();
                            $('#recomend-bar').show();
                        }
                    } catch (err) {
                        //console.log(err);
                        toastr.error('Sorry. Server response is malformed.');
                        $('#recomendModal').modal('hide');
                        $('#recomend-status').hide();
                        $('#recomend-bar').show();
                    }
                },
            });
        } else {
            toastr.error('You must be login with DLIKE username!');
            return false;
        }
    });
</script>