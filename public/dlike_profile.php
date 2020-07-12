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
        $user_pro_img= $row_U['profile_pic'];
        $account_created = strtotime($row_U['created_time']);
    	$dlike_user = $dlikeuser;
    } else {$dlike_user = 'none';}
    $login_user = $_COOKIE['dlike_username'];
?>
</div><!-- sub-header -->
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
		<div id="p_cover" class="img-fluid">
		</div>
		<div style="background: #ededed;">
			<div class="container p-data">
				<div class="row p_data_inner">
					<div>
						<span><?php echo '<img src="'.$user_pro_img.'" id="p_img" class="img-fluid rounded-circle">'; ?>
						</span>
						<span class="p_data_names"><span class="name"></span>
							<br>
							<span class="p_name">@<?php echo $dlikeuser; ?></span>
						</span>
					</div>
					<div><?php if($login_user == $prof_user){echo '<button class="btn btn-danger btn_edit btn-follow">Edit Profile</button>';}else{} ?></div>
				</div>
				<?php if(!empty($account_about)){ echo '<div class="row p_data_top"><span class="p_about"></span></div>'; } ?>
				<div class="row p_data_mid">
					<span class="p_joined"><i class="fas fa-calendar-alt" style="line-height:0.1;font-weight: 00;"></i> Joined: <?php echo date('F Y', $account_created); ?></span>
					<span class="p_location"></span>
					<span class="web_site p_data_pad"></span>
				</div>
			</div>
			<div class="new-ticker-block new-ticker-block-section" style="min-height:50vh;">
		        <div class="container">
		            <div class="new-ticker-block-wrap">
		                <div class="ticker-head">
		                    <ul class="nav nav-tabs ticker-nav prof-nav" role="tablist">
		                        <li class="nav-item">
		                            <a class="nav-link active show" href="#user_posts" role="tab" data-toggle="tab"
		                               aria-selected="true">
		                               <h5>Posts</h5>
		                            </a>
		                        </li>
		                        <li class="nav-item">
		                            <a class="nav-link" href="#user_comments" role="tab" data-toggle="tab">Likes</a>
		                        </li>
		                        <li class="nav-item nav-item-last">
		                        </li>
		                    </ul>
		                </div>
		                <div class="market-ticker-block">
		                    <!-- Tab panes -->
		                    <div class="tab-content">
		                        <div role="tabpanel" class="tab-pane fade in active show" id="user_posts">
									<div class="container">
							            <div id="loadings"><img src="/images/loader.svg" width="100" style="padding-top:40px;"></div>
								    	<div class="row" id="profposts"></div>
									</div>
		                        </div>
		                        <div role="tabpanel" class="tab-pane fade p_tab_pad" id="user_comments">
		                        	<div id="cmt_content"></div>
		                        </div>
		                        <div role="tabpanel" class="tab-pane fade p_tab_pad" id="user_replies">
		                            <div id="replies_content"></div>
		                        </div><!-- market-ticker-block -->
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
			<div class="modal fade" id="profile_edit" tabindex="-1" role="dialog" aria-hidden="true">
			    <div class="modal-dialog" role="document">
			        <div class="modal-content modal-custom">
			            <!--<?php //include('template/modals/profile_update.php'); ?>-->
			            <div class="modal-body ">
							<div class="transfer-respond">
								<h4>Update Profile</h4>
								<?php echo $user_pro_img; ?>
								<div id="prof-msg"></div>
								<form action="" id="p_edit" method="POST">
									<div class="row line">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<div class="input-group-text mb-deck"> Name</div>
													</div>
													<input type="text" class="form-control" name="profile_name" id="profile_name" value="" />
												</div>
											</div>
										</div>
									</div>
									<div class="row line">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<div class="input-group-text mb-deck"> Profile picture url</div>
													</div>
													<input type="text" class="form-control" name="profile_img" id="profile_img" placeholder="Enter url of image" value="<?php echo $user_pro_img; ?>" />
												</div>
											</div>
										</div>
									</div>
									<div class="row line">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<div class="input-group-text mb-deck"> Cover image url</div>
													</div>
													<input type="text" class="form-control" key="cover_image" name="cover_img" id="cover_img" value="" placeholder="Enter url for image">
												</div>
											</div>
										</div>
									</div>
									<div class="row line">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<div class="input-group-text mb-deck"> Location</div>
													</div>
													<input type="text" class="form-control" key="location" name="profile_location" id="profile_location" value="" />
												</div>
											</div>
										</div>
									</div>									
									<div class="row line">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<div class="input-group-text mb-deck"> Website</div>
													</div>
													<input type="text" class="form-control" key="website" name="profile_website" id="profile_website" value="" />
												</div>
											</div>
										</div>
									</div>
									<div class="row line">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<div class="input-group-text mb-deck"> About</div>
													</div>
													<input type="text" class="form-control" key="about" name="profile_about" id="profile_about" value="" />
												</div>
											</div>
										</div>
									</div>			
									<center><button type="button" class="btn btn-default prof_edit_btn">UPDATE</button></center>
								</form>
							</div>
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
$(document).ready(function(){
	$('#loadings').delay(6000).fadeOut('slow');
	let profname = '<?php echo $_GET['user'];?>';


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
    var datap = { action : 'profile',name_profile: profname, acc_about:p_about, acc_website:p_website, acc_location:p_location, acc_cover_img:p_cover_img, acc_img:p_img, acc_name:p_name };
    $.ajax({
        url: '/helper/profile_update.php',
        type: 'post',
        data: datap,
        success: function(data) {
                try { var response = JSON.parse(data)
            	console.log(response)
                if (response.error == true) {
                    toastr['error'](response.message);$(".prof_edit_btn").attr("disabled", false);return false;
                } else {toastr['success'](response.message);}
            } catch (err) {toastr.error('Sorry. Server response is malformed');console.log(err);}
        }
    });
});
	$('.btn_edit').click(function(e) {	
	    e.preventDefault();
	    $("#profile_edit").modal("show");
	});

</script>