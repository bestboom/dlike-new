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
        $account_created = strtotime($row_U['created_time']);
    	$dlike_user = $dlikeuser;
    } else {$dlike_user = 'none';}
    echo $dlike_user;
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
			                <div class="share-block"><p>It seems thsi dlike user does not exist!</p></div>
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
						<span>
							<img src="/images/post/authors/9.png" id="p_img" class="img-fluid rounded-circle">
							<span class="repu rounded-circle"></span>
						</span>
						<span class="p_data_names">
							<span class="name"></span>
							<br>
							<span class="p_name"><?php echo $dlikeuser; ?></span>
						</span>
					</div>
					<div>
						<button class="btn btn-danger btn-follow">
							<span class="foll"></span>
						</button>
					</div>
				</div>
				<div class="row p_data_top">
					<span class="p_about"></span>
				</div>
				<div class="row p_data_mid">
					<span class="p_joined"><?php echo date('m/d/Y', $account_created); ?></span>
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
		                            <a class="nav-link" href="#user_comments" role="tab" data-toggle="tab">Comments</a>
		                        </li>
		                        <li class="nav-item">
		                            <a class="nav-link" href="#user_replies" role="tab" data-toggle="tab">Replies</a>
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
			            <?php include('template/modals/profile_update.php'); ?>
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


//profile details
	//$('#p_img').attr("src","https://steemitimages.com/u/"+profname+"/avatar");

// check if user following
	if(dlike_username == profname) {
		$('.foll').html('Edit Profile');
	} else {$('.foll').html();
	};

});

	//document.querySelector(".signup-signup-phone .next.btn").addEventListener('click',function(e){
	$('.btn-follow').click(function(e) {	
	    e.preventDefault();
	    	let profname = '<?php echo $_GET['user'];?>';
	        let follower_status = $(".foll").html();
	        console.log(follower_status);
	        var datav = {profname:profname};
	        if(follower_status == 'Follow'){
	        	$('.foll').html('following...');
	            $.ajax({
	                url: '/helper/follow.php',
	                type: 'post',
	                cache : false,
	                dataType: 'json',
	                data: datav,
	                success:function(response){
	                	console.log(response);
	                    if(response.status===true)
	                    {
	                        toastr['success'](response.message);
	                        $('.foll').html('Following');
	                        $('.btn-follow').prop("disabled",true);
	                        $(".btn-follow").unbind('mouseenter mouseleave');
	                    }
	                    else{
	                        toastr['error'](response.message);
	                        return false;
	                    }
	                }
	            });
	        }

	        if(follower_status == 'unfollow' || follower_status == 'Following'){
	        	$('.foll').html('unfollowing...');
	            $.ajax({
	                url: '/helper/unfollow.php',
	                type: 'post',
	                cache : false,
	                dataType: 'json',
	                data: datav,
	                success:function(response){
	                	console.log(response);
	                    if(response.status===true)
	                    {
	                        toastr['success'](response.message);
	                        $('.foll').html('Follow');
	                        $('.btn-follow').prop("disabled",true);
	                        $(".btn-follow").unbind('mouseenter mouseleave');
	                    }
	                    else{
	                        toastr['error'](response.message);
	                        return false;
	                    }
	                }
	            });
	        }

	    if(follower_status == 'Edit'){
	    	$("#profile_edit").modal("show");
	    	$('.p_edit_btn').prop("disabled",true);


			let url = "https://beta.steemconnect.com/sign/profile-update?";
			let parts=[];
			let originalparts = [];

			function output(){
				let out = [];
				for(let i = 0; i<Object.entries(parts).length; i++)
  				{
  					let entry = Object.entries(parts)[i];
    				out.push(entry[0]+"="+entry[1]);
  				}
  			return out.join("&");
			}

			function validate() {
  				$('.p_edit_btn').prop("disabled", Object.entries(parts).length <= 0);
			}

			function input(key, val, original=false)
			{
				if(!original)
  				{
    				if(val.length<=0 || originalparts[key] == val)
    				{
      					delete(parts[key]);
    				}
    				else
    				{
      					parts[key] = val;
    				}
  				}
  				else
  				{	
  					if(val.length>0)
    				{
      					originalparts[key] = val;
    				}
  				}
  
  				validate();
  				//$('#out').html("Output: " + url + output());
			}

  			$('.p_edit_btn').click(function(){
    			window.open(url + output());
    			$("#profile_edit").modal("hide");
			});
  
  			$('.form-control').each(function()
  			{ 
    			let inp = $(this).val();
    			input($(this).attr("key"), encodeURIComponent(inp), true);
    
    			$(this).on("change paste keyup", function(){ 
    				let inp = $(this).val();
	    			input($(this).attr("key"), encodeURIComponent(inp));
  				});
  			});

	    }
	// steem upvotes  
});
</script>