<?php 
if (isset($_GET['user'])) 
{
	$prof_user = $_GET['user'];
} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}
include('template/header7.php');
    $sql_U = $conn->query("SELECT * FROM dlikeaccounts where username='$prof_user'");
    if ($sql_U && $sql_U->num_rows > 0) 
    {
    	$row_U = $sql_U->fetch_assoc();
        $dlikeuser = $row_U['username'];
        $account_about= $row_U['about'];
        $account_web= $row_U['website'];
        $account_location= $row_U['location'];
        $user_pro_img= $row_U['profile_pic'];
        $account_created = strtotime($row_U['created_time']);
        $account_name= $row_U['full_name'];
        $profile_banner= $row_U['profile_banner'];
    	$dlike_user = $dlikeuser;
    } else {$dlike_user = 'none';}
    $login_user = $_COOKIE['dlike_username'];
?>
<style type="text/css">
    .hov_vote{cursor:pointer;width: 21px;height: 21px;margin-top:-3px;}
    .post-tags{padding-bottom: 5px !important;margin-bottom: 5px !important;}
    #post_likes{padding-right: 3px;font-weight: bold;padding-left: 3px;}
</style>
</div>
<?php if($dlike_user == 'none') { ?>
	<div id="profile_miss">
		<div class="container">
			<div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">	
			    <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
			        <div class="modal-body">
			            <div class="share-block"><p style="font-size: 3rem;">ooops!</p></div>
			            <div class="user-connected-form-block" style="background: #1b1e63;">
			            	<center><i class="fas fa-frown" style="color: #ffff008a;font-size: 4rem;"></i></center>
			                <div class="share-block"><p>It seems this dlike user does not exist!</p></div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div> 
<? } else {?>
<div id="profile_page">
		<div id="p_cover" class="img-fluid"><?php if(!empty($profile_banner)){ echo '<img src="'.$profile_banner.'" style="width:100%;height:100%;">'; } ?></div>
		<div style="background: #ededed;">
			<div class="container p-data">
				<div class="row p_data_inner">
					<div>
						<span><?php echo '<img src="'.$user_pro_img.'" id="p_img" class="img-fluid rounded-circle">'; ?></span>
						<span class="p_data_names"><span class="name"><?php echo $account_name; ?></span><br>
							<span class="p_name">@<?php echo $dlikeuser; ?></span></span>
					</div>
					<div><?php if($login_user == $prof_user){echo '<button class="btn btn-danger btn_edit btn-follow">Edit Profile</button>';}else{} ?></div>
				</div>
				<?php if(!empty($account_about)){ echo '<div class="row p_data_top"><span class="p_about">'.$account_about.'</span></div>'; } ?>
				<div class="row p_data_mid">
					<span class="p_joined"><i class="fas fa-calendar-alt" style="line-height:0.1;color: #191d5d;"></i> Joined <?php echo date('F Y', $account_created); ?></span>
					<?php if(!empty($account_location)){ echo '<span class="p_location" style="margin-left:10px;"><i class="fas fa-map-marker-alt" style="color: #191d5d;padding-right:3px;"></i>'.$account_location.'</span>'; } ?>
					<?php if(!empty($account_web)){ echo '<span class="web_site" style="margin-left:10px;"><i class="fas fa-link" style="color: #191d5d;padding-right:3px;"></i>'.$account_web.'</span>'; } ?>
				</div>
			</div>
			<div class="new-ticker-block new-ticker-block-section" style="min-height:50vh;">
		        <div class="container">
		            <div class="new-ticker-block-wrap">
		                <div class="ticker-head">
		                    <ul class="nav nav-tabs ticker-nav prof-nav" role="tablist">
		                        <li class="nav-item"><a class="nav-link active show" href="#user_posts" role="tab" data-toggle="tab" aria-selected="true"><h5>Posts</h5></a></li>
		                        <li class="nav-item"><a class="nav-link" href="#user_likes" role="tab" data-toggle="tab">Likes</a></li>
		                        <li class="nav-item nav-item-last"></li>
		                    </ul>
		                </div>
		                <div class="market-ticker-block">
		                    <div class="tab-content">
		                        <div role="tabpanel" class="tab-pane fade in active show" id="user_posts">
									<div class="container">
								    	<div class="row" style="margin-top: 30px;"><?php
										$sql_T = $conn->query("SELECT * FROM dlikeposts where username='$prof_user' ORDER BY created_at DESC LIMIT 60");
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
										    $post_income = $postLikes * $post_reward; ?><div class="col-lg-4 col-md-6 postsMainDiv"><article class="post-style-two">
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
									</div>
		                        </div>
		                        <div role="tabpanel" class="tab-pane fade p_tab_pad" id="user_likes">
		                        	<div id="cmt_content">
		                        	
<?php
$sql_M = $conn->query("SELECT * FROM dlike_upvotes where curator = '$prof_user' ORDER BY curation_time DESC");
if ($sql_M && $sql_M->num_rows > 0)
{   while ($row_M = $sql_M->fetch_assoc())
    {
    	$likes_author = $row_M["author"];
        $likes_permlink = $row_M["permlink"];

        $sql_T = $conn->query("SELECT * FROM dlikeposts ORDER BY created_at DESC LIMIT 60");
		if ($sql_T && $sql_T->num_rows > 0)
		{
			$imgUrl = $row_T["img_url"];
	        $author = $row_T["username"];
	        $post_time = strtotime($row_T["created_at"]);
	        $title = $row_T["title"];
	        $post_tags = $row_T["tags"];
	        $permlink = $row_T["permlink"];
	        $post_hash_tags = preg_replace('/(\w+)/', '#$1', $post_tags);
		}

        $sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$likes_author'");
        if ($sql_W && $sql_W->num_rows > 0)
        {   $row_W = $sql_W->fetch_assoc();
            $profile_pic = $row_W["profile_pic"];
            if (!empty($profile_pic)) { $user_profile_pic = $profile_pic; } else { $user_profile_pic = 'https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';}
        }

        $checkLikes = $conn->query("SELECT * FROM postslikes WHERE author = '$likes_author' and permlink = '$likes_permlink'");
        $row_L = $checkLikes->fetch_assoc();
        if ($checkLikes->num_rows > 0){$postLikes = $row_L['likes'];}else{$postLikes = '0';}
        $post_income = $postLikes * $post_reward;
?>
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
        <div><img src="./images/post/dlike-hover.png" class="hov_vote" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>"> | <span id="post_likes" class="post_likes<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $postLikes; ?></span>LIKES</div>
        <div><span class="dlike_tokens<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $post_income; ?></span> <b>DLIKE</b></div>
    </div>
</article></div>
<? } } ?>

		                        	</div>
		                        </div>
		                        <div role="tabpanel" class="tab-pane fade p_tab_pad" id="user_replies">
		                            <div id="replies_content"></div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
<div class="modal fade" id="profile_edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
        <?php include('template/modals/dlike_profile_update.php'); ?>
    	</div>
	</div>
</div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-custom modalStatus" role="document">
        <div class="modal-content modal-custom">
        	<?php include('template/modals/upvotefail.php'); ?>
        </div>
    </div>
</div>				        
</div>    
</div>
<? } ?>
<?php include('template/dlike_footer.php'); ?> 
<script>
$(document).ready(function(){let profname = '<?php echo $_GET['user'];?>';
});

$('.prof_edit_btn').click(function() {
    $(".prof_edit_btn").attr("disabled", true);
    let profname = '<?php echo $_GET['user'];?>';
    let p_about = $('#profile_about').val();
    let p_website = $('#profile_website').val();
    let p_location = $('#profile_location').val();
    let p_cover_img = $('#cover_img').val();
    let p_img = $('#profile_img').val();
    let p_name = $('#profile_name').val();
    $.ajax({url: '/helper/profile_update.php', type: 'post',
        data: { name_profile: profname, acc_about:p_about, acc_website:p_website, acc_location:p_location, acc_cover_img:p_cover_img, acc_img:p_img, acc_name:p_name },
        success: function(data) {
                try { var response = JSON.parse(data)
                if (response.error == true) {toastr['error'](response.message);$(".prof_edit_btn").attr("disabled", false);return false;
                } else {$("#profile_edit").modal("hide");toastr['success'](response.message);setTimeout(function(){window.location.reload();}, 400);}
            } catch (err) {toastr.error('Sorry. Server response is malformed');}
        }
    });
});
$('.btn_edit').click(function(e) {	e.preventDefault();$("#profile_edit").modal("show");});
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