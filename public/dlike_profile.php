<?php 
if (isset($_GET['user'])) {$prof_user = $_GET['user'];
} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}
include('template/header7.php');
$admin_users = array('dlike_airdrop','dlike_dao','dlike_foundation','dlike_team','dlike_charity');
if(in_array($prof_user, $admin_users)){die('<script>window.location.replace("https://dlike.io","_self")</script>');}

$sql_U = $conn->query("SELECT * FROM dlikeaccounts where username='$prof_user'");
if ($sql_U && $sql_U->num_rows > 0) 
{	$row_U = $sql_U->fetch_assoc();$dlikeuser = $row_U['username'];$account_about= $row_U['about'];
    $account_web= $row_U['website'];$account_location= $row_U['location'];
    $user_pro_img= $row_U['profile_pic'];$account_created = strtotime($row_U['created_time']);
    $account_name= $row_U['full_name'];$profile_banner= $row_U['profile_banner'];
	$dlike_user = $dlikeuser;$verified= $row_U['verified'];$email= $row_U['email'];
} else {$dlike_user = 'none';}
$login_user = $_COOKIE['dlike_username']; ?>
</div>
<?php if($dlike_user == 'none') { ?>
<div id="profile_miss"><div class="container"><div class="user-login-signup-form-wrap" style="padding:7rem 0"><div class="modal-content" style="background:#1b1e63;border-radius:14px"><div class="modal-body"><div class="share-block"><p style="font-size:3rem">ooops!</p></div><div class="user-connected-form-block" style="background:#1b1e63"><center><i class="fas fa-frown" style="color:#ff08a;font-size:4rem"></i></center><div class="share-block"><p>It seems this dlike user does not exist!</p></div></div></div></div></div></div></div>
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
					<div>
						<?php if($login_user == $prof_user){echo '<button class="btn btn-danger btn_edit btn-follow">Edit Profile</button>';
							if($verified !='1'){echo '<button class="btn btn-danger btn_verify_email">Verify Email</button>';}
						}else{} ?></div>
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
										    $post_income = $postLikes * $post_reward; ?><div class="col-lg-4 col-md-6 postsMainDiv"><?php include('functions/post_data.php');?></div> <?php } } ?>
								    	</div>
									</div>
		                        </div>
<div role="tabpanel" class="tab-pane fade" id="user_likes"><div class="container"><div class="row" style="margin-top: 30px;">
<?php $sql_M = $conn->query("SELECT * FROM dlike_upvotes where curator = '$prof_user' ORDER BY curation_time DESC");
if ($sql_M && $sql_M->num_rows > 0)
{   while ($row_M = $sql_M->fetch_assoc())
    {	$likes_author = $row_M["author"];$likes_permlink = $row_M["permlink"];

        $sql_T = $conn->query("SELECT * FROM dlikeposts where username='$likes_author' and permlink='$likes_permlink' ORDER BY created_at DESC LIMIT 60");
		if ($sql_T && $sql_T->num_rows > 0)
		{	$row_T = $sql_T->fetch_assoc();
			$imgUrl = $row_T["img_url"];$author = $row_T["username"];$post_time = strtotime($row_T["created_at"]);
	        $title = $row_T["title"];$post_tags = $row_T["tags"];$permlink = $row_T["permlink"];$post_hash_tags = preg_replace('/(\w+)/', '#$1', $post_tags);
		}
		$sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$likes_author'");
    	if ($sql_W && $sql_W->num_rows > 0){$row_W = $sql_W->fetch_assoc();$user_profile_pic=$row_W["profile_pic"];}

        $checkLikes=$conn->query("SELECT * FROM postslikes WHERE author='$likes_author' and permlink='$likes_permlink'");
        if ($checkLikes->num_rows > 0){$row_L = $checkLikes->fetch_assoc();$postLikes = $row_L['likes'];}else{$postLikes = '0';} $post_income = $postLikes * $post_reward;?>
<div class="col-lg-4 col-md-6 postsMainDiv"><?php include('functions/post_data.php');?></div> <?php } } ?>
</div></div></div>
</div>
		                        <div role="tabpanel" class="tab-pane fade p_tab_pad" id="user_replies">
		                            <div id="replies_content"></div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
<div class="modal fade" id="profile_edit" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content modal-custom"><?php include('template/modals/dlike_profile_update.php'); ?></div></div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>				        
</div></div>

<div class="modal fade" id="email_verify" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document"><div class="modal-content modal-custom"><div class="modal-body ">
        <div class="transfer-respond">
            <h4>Verify Email Address</h4>
            <label><center>Enter the confirmation code sent to Email <b><?php echo $email;?></b></center></label>
            <div class="row line"><div class="col-md-12"><div class="form-group"><div class="input-group mb-3">
                <div class="input-group-prepend"><div class="input-group-text mb-deck"><span class="fa fas fa-key"></span></div></div>
                <input type="number" name="email-pin" id="email_pinit_code" placeholder="confirmation code (6 digits)" class="form-control" />
            </div> </div></div></div>
            <center><span class="resend_pin" style="color: #c51d24;font-weight: 600;cursor: pointer;">Resend Verification Code</span><br><button type="submit" class="btn btn-default email_pin_btn" style="margin-top:10px;">Submit</button></center>
        </div>
     </div></div></div>
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
$('.btn_verify_email').click(function(e) {	e.preventDefault();$("#email_verify").modal("show");});

$('.email_pin_btn').click(function() {$(".email_pin_btn").attr("disabled", true);
    let pin_code = $('#email_pinit_code').val();let user_email_id = '<?php echo $email;?>';
    if (pin_code == "") {toastr.error('phew... PIN value should not be empty');$(".email_pin_btn").attr("disabled", false);return false;}
    $.ajax({type:"POST",url:'/helper/email_verify.php',data:{email_pin_code: pin_code, user_email: user_email_id},
        success: function(data) {
            try {var response = JSON.parse(data);
                if(response.error == true){toastr['error'](response.message);$(".email_pin_btn").attr("disabled", false);return false;
                }else{toastr['success'](response.message);$("#email_verify").modal("hide");setTimeout(function(){window.location.reload ();}, 400);}
            } catch (err) {toastr.error('Sorry. Server response is malformed');console.log(err)}
        }
    });
});


$('.resend_pin').click(function() {$('.resend_pin').html("Sending...");
    let user_email_id = '<?php echo $email;?>';
    $.ajax({type:"POST",url:'/helper/email_signup.php',data:{action :'resend_pin',user_email: user_email_id},
        success: function(data) {
            try {var response = JSON.parse(data);
                if(response.error == true){toastr['error'](response.message);$(".email_pin_btn").attr("disabled", false);return false;
                }else{toastr['success'](response.message);$("#email_verify").modal("hide");setTimeout(function(){window.location.reload ();}, 400);}
            } catch (err) {toastr.error('Sorry. Server response is malformed');console.log(err)}
        }
    });
});
</script>