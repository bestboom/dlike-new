<?php 
if (isset($_GET['user'])) {
     $prof_user = $_GET['user'];
} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}
include('template/header5.php'); ?>
    </div><!-- sub-header --> 
<?php
    $sql_T = "SELECT * FROM prousers where username='$prof_user'";
    $result_T = $conn->query($sql_T);
    if ($result_T && $result_T->num_rows > 0) {
    	$profile_user = 'PRO';
    }
?>
	<div id="p_cover" class="img-fluid" style="background-color: #191d5d;height: 175px;background-repeat: no-repeat;background-size: cover;background-position: center;">
		
	</div>
	<div style="background: #ededed;">
	<div class="container p-data">
		<div class="row" style="justify-content: space-between;margin: 0px 25px;">
			<div>
				<span>
					<img src="/images/post/authors/9.png" id="p_img" class="img-fluid rounded-circle" style="background-color: #191d5d;border: 2px solid #191d5d;">
					<span class="repu rounded-circle" style="font-size: 12px;margin-left:-24px;border: 1px solid #c51d24;background: #c51d24;padding: 5px;color: #fff;font-weight: 600;font-family: sans-serif;"></span>
				</span>
				<span style="display: inline-table;padding-left: 15px;font-weight: 600;"><span style="font-size: 24px;" class="name"></span> <br><span class="p_name"></span><?php if($profile_user== "PRO"){ echo '<span><i class="fas fa-check-circle" title="PRO User" style="padding-left:7px;color:#c51d24;"></i></span>';} ?></span>
			</div>
			<div><button class="btn btn-danger" style="margin: 10px;background: #191d5d;border-radius: 14px;padding: 8px 16px;border-color: #191d5d;">Follow</button></div>
		</div>
		<div class="row" style="padding: 15px 40px 1px 40px;font-weight: bold;">
			<span class="p_about"></span>
		</div>
		<div class="row" style="padding: 5px 40px;font-weight: bold;">
			<span class="followers"></span>
			<span class="following"></span>
			<span class="p_joined" style="padding-left:14px;"></span>
		</div>
		<div class="row" style="padding: 5px 40px 15px;font-weight: bold;">
			<span class="p_location"></span>
			<span class="web_site" style="padding-left:10px;"></span>
		</div>
	</div>






<div class="new-ticker-block new-ticker-block-section" style="min-height:50vh;">
        <div class="container">
            <div class="new-ticker-block-wrap">
                <div class="ticker-head">
                    <ul class="nav nav-tabs ticker-nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" href="#user_posts" role="tab" data-toggle="tab"
                               aria-selected="true">
                                <h5>Posts</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#steem_trx" role="tab" data-toggle="tab">Comments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tips_trx" role="tab" data-toggle="tab">Replies</a>
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
					            <div id="loadings"><img src="/images/loader.svg" width="100"></div>
						    	<div class="row" id="profposts" style="padding-top:20px;"></div>
							</div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="steem_trx">

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tips_trx">
                            
                        </div><!-- market-ticker-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>










<!--
    <div class="latest-post-section" style="min-height:80vh;">
		<div class="container">
			<div class="row  align-items-center h-100">
                <div class="row col-md-3 justify-content-center">
                    <h4 class="lab_post"><?php echo $_GET['user'];?></h4>
                </div>
                <div class="col-md-9 lay">&nbsp;</div>
            </div>
            <div id="loadings"><img src="/images/loader.svg" width="100"></div>
	    	<div class="row" id="profposts"></div>
		</div>
    </div>
-->  
<?php include('template/footer3.php'); ?>
<script>
	$(document).ready(function(){
		$('#loadings').delay(6000).fadeOut('slow');

		let profname = '<?php echo $_GET['user'];?>';

//profile details
	$('#p_img').attr("src","https://steemitimages.com/u/"+profname+"/avatar");
	steem.api.getAccounts([profname], function(err, result) {
	  	console.log(result)
	  	let metadata;
	  	if (result["0"].json_metadata && result["0"].json_metadata.length > 0)
        {
          	metadata = JSON.parse(result["0"].json_metadata);
          	
	  		let cover = metadata.profile.cover_image;
	  		let cover_url = "https://steemitimages.com/0x0/"+cover;
	  		let about = metadata.profile.about;
	  		let location = metadata.profile.location;
	  		let website = metadata.profile.website;
	  		let name = metadata.profile.name;
	  		//console.log(metadata.profile.location);
	  		//console.log(cover_url)
	  		//$('#p_cover').attr("src","https://steemitimages.com/0x0/"+cover);
	  		$('#p_cover').css('background-image', 'url(' + cover_url + ')');
	  		$('.p_about').html(about);
	  		if (typeof location !== 'undefined')
	  		{
	  			$('.p_location').html('<i class="fas fa-map-marker-alt" style="line-height:0.1;font-weight: 600;padding-right:8px;"></i>' + location);
	  		}
	  		if (typeof website !== 'undefined')
	  		{
	  			$('.web_site').html('<i class="fas fa-link" style="line-height:0.1;font-weight: 600;padding-right:8px;padding-left:12px;"></i>' + website);
	  		}
	  		if (typeof name !== 'undefined')
	  		{
	  			$('.name').html(name);
	  		}
        }
        let profile_created = result["0"].created;
        let profile_name = result["0"].name;
        let acc_created = moment(profile_created).format('MM-YYYY');
        $('.p_joined').html('<i class="fas fa-calendar-alt" style="line-height:0.1;font-weight: 00;"></i> Joined ' + acc_created);
        $('.p_name').html('<span style="font-weight:normal;padding-right:1px;">&#64;</span>' + profile_name);
        let reputation = steem.formatter.reputation(result["0"].reputation);
        $('.repu').html(reputation);
	  		
  	});

// get followers and following

	steem.api.getFollowCount(profname, function(err, result) {
		 let p_followers = result.follower_count;
		 let p_following = result.following_count;

		 $('.followers').html('<span style="font-weight:700;font-size:16px;padding-right:2px;font-family: sans-serif;">' + p_followers + '</span> Followers |  ');
		 $('.following').html('<span style="font-weight:700;font-size:16px;padding-right:2px;padding-left:8px;font-family: sans-serif;">' + p_following + '</span> Following');

	});
// post details		
		let $tag, $limit, content = "#profposts";
		let query = {
			tag: profname,
			limit: 42,
		};

		steem.api.getDiscussionsByBlog(query, function (err, res) {
		//console.log(res);
		res.forEach(($post, i) => {
			let metadata;
			if ($post.json_metadata && $post.json_metadata.length > 0){
				metadata = JSON.parse($post.json_metadata);
			}
			
		//get meta tags
			let steemTags = metadata.tags;
			let dlikeTags = steemTags.slice(2);
			let metatags = dlikeTags.map(function (meta) { if (meta) return '<a href="#"> #' + meta + ' </a>' });
			let category = metadata.category;
			let dlikecat = category;
			let exturl = metadata.url;

			var currentPostNumber = i;
			var currentLikesDivElement = 'postLike_' + i;
			if(metadata && metadata.community == "dlike" ){
				getTotalcomments($post.author,$post.permlink);

				// get image here
				let img = new Image();
				if (typeof metadata.image === "string") {
					if (metadata.image.indexOf("https://dlike") >= 0){
					img.src = metadata.image.replace("?","%3f");
					}else{
					 img.src = metadata.image;
					}
				} else {
					if (!metadata.image || metadata.image[0] === undefined) {
					img.src = "https://dlike.io/images/default-img.jpg";
					} else {
					img.src = metadata.image[0];
					}
				}

				//get time
				let activeDate = moment.utc($post.created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();

				//Get the body
				let body;
				if($post && $post.body && $post.body != undefined){
					try {
					body = $post.body;
					body = body.split(/\n\n#####\n\n/);
					body = body[1];
					body = body.replace(/#([^\s]*)/g,'');
					//body = $post.body.replace(/<(.|\n)*?>/g, '');
					}catch(err) {
					body = "";
					}
				}else{
					body = "";
				}

				//image or youtube
				let thumbnail = '<img src="' + img.src + '" alt="' + $post.title + '" class="card-img-top img-fluid">';

				var getLocation = function(href) {
					var l = document.createElement("a");
					l.href = href;
					return l;
				};
				var url = getLocation(metadata.url);
				var youtubeAnchorTagVariableClass = '';
				if(url.hostname == 'www.youtube.com' || url.hostname == 'youtube.com' || url.hostname == 'youtu.be' || url.hostname == 'www.youtu.be'){
					//alert(url);
					youtubeAnchorTagVariableClass = 'youtubeAnchorTagVariableClass_' + i;
					if(url.search != ''){
						let query = url.search.substr(1); //remove ? from begning
						query = query.split('&')
						for (i in query){
							let splited = query[i].split('=');
							if(splited[0] == 'v'){
								thumbnail = '<iframe src="https://www.youtube.com/embed/' + splited[1] + '" class="card-img-top img-fluid" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe>';
							}
						}
					}else{
						thumbnail = '<iframe src="https://www.youtube.com/embed/' + url.pathname + '" class="card-img-top img-fluid" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe>';
					}
				}

				//check comments
				function getTotalcomments(thisAutor,thisPermlink){
					//Conting the comments (just the dlike ones)
					steem.api.getContentReplies(thisAutor,thisPermlink, function(err, result) {
						let totalDlikeComments = 0;  
						result.forEach(comment =>{
						let metadata;
							if (comment.json_metadata && comment.json_metadata.length > 0){
								metadata = JSON.parse(comment.json_metadata);
							}
							if(metadata && metadata.community == "dlike"){
								totalDlikeComments +=1;    
							}
						});
						$("#DlikeComments" + thisPermlink + thisAutor).html(totalDlikeComments);
					});
				}
				//start posts here
				$(content).append('<div class="col-lg-4 col-md-6 postsMainDiv mainDiv'+ currentLikesDivElement +'" postLikes="0" postNumber="'+ currentPostNumber +'">\n' +
					'\n' +
					'<article class="post-style-two">\n' +
					'\n' +
					'<div class="post-contnet-wrap-top">\n' +
					'\n' +
					'<div class="post-footer">\n' +
					'\n' +
					'<div class="post-author-block">\n' +
					'\n' +
					'<div class="author-thumb"><a href="#"><img src="https://steemitimages.com/u/' + $post.author + '/avatar" alt="img" class="img-responsive"></a></div>\n' +
					'\n' +
					'<div class="author-info">\n' +
					'\n' +
					'<h5><a href="#">' + $post.author + '</a><div class="time">' + activeDate + '</div></h5>\n' +
					'\n' +    
					'</div>\n' +
					'\n' + 
					'</div>\n' +
					'\n' +
					'<div class="post-comments"><span class="post-meta">' + category + '</span></div>\n' +
					'\n' +
					'</div>\n' +
					'\n' +
					'</div>\n' + 
					'\n' +
					'<div class="post-thumb"><a class="post_detail" data-toggle="modal" data-target="#postModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '">' + thumbnail + '</a></div>\n' + 
					'\n' +
					'<div class="post-contnet-wrap">\n' +
					'\n' +
					'<div class="row d-flex justify-content-center hov-it"><div class="hov-item"><img src="/images/post/dlike-hover.png" alt="img" class="img-responsive"><span class="hov_me" data-toggle="modal" data-target="" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><div class="hov-txt"><h5><span id="hov-num" class="commentsDiv' + currentLikesDivElement + '"></span></h5></div></span></div></div>\n' +
                    '\n' +
					'<h4 class="post-title"><a href="' + exturl + '" target="_blank">' + $post.title + '</a></h4>\n' +
					'\n' +
					'<p class="post-entry post-tags">' + metatags + '</p>\n' +
					'\n' +
					'<div class="post-footer">\n' +
					'<div class="post-author-block">\n' +
					'<div class="author-info"><i class="fas fa-dollar-sign"></i><span>&nbsp;' + $post.pending_payout_value.substr(0, 4) + '</span> | <i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+$post.permlink +$post.author +'">0</span></div>\n' +
					'</div>\n' +
					'<div class="post-comments"><a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+$post.permlink +$post.author +'"></i></a><span>&nbsp; | ' + $post.active_votes.length + ' Votes</span></div>\n' +
					'</div>\n' +
					'</div>\n' +
				'</article></div>');
				getTotalLikes($post.author,$post.permlink, currentLikesDivElement);

        		let author = $post.author;
        		let permlink = $post.permlink;				

    		//check if voted
    		steem.api.getActiveVotes($post.author, $post.permlink, function(err, result) {
                //console.log(result);
                    if(result === Array) {
                    	var voterList = result;
                   	} else {
                       	var voterList = [];
                    }
                    if(!(voterList === Array)) {
                       	voterList = [];
                    }
                    var voterList = result;
                for (let j = 0; j < voterList.length; j++) {
                	if (voterList[j].voter == username) { 
                		$("#vote_icon" + permlink + author).css("color", "RED"); 
                		$('#vote_icon' + permlink + author).click(function(){return false;});
                		$('#vote_icon' + permlink + author).hover(function() {toastr.error('hmm... Already Upvoted');})
                	}
                }                        
    		});

			}
		});

	});	

function getTotalLikes(thisAutor, thisPermlink, currentLikesDivElement){
	$.ajax({
		type: "POST",
		url: '/helper/postLikes.php?author='+thisAutor+'&permlink='+thisPermlink,
		dataType: 'json',
		success: function(response) {
			$('.mainDiv' + currentLikesDivElement).attr('postLikes', response.likes);
			$('.commentsDiv' + currentLikesDivElement).html(response.likes);
		},
		error: function() {
			console.log('Error occured');
		}
	});
};		
	});
</script>
