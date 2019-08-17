<?php 
if (isset($_GET['user'])) 
{
	$prof_user = $_GET['user'];
} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}
include('template/header5.php');
//check pro status
    $sql_T = "SELECT * FROM prousers where username='$prof_user'";
    $result_T = $conn->query($sql_T);
    if ($result_T && $result_T->num_rows > 0) 
    {
    	$profile_user = 'PRO';
    }
?>
</div><!-- sub-header --> 
	<div id="p_cover" class="img-fluid"></div>
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
					<span class="p_name"></span>
					<?php if($profile_user== "PRO")
						{ echo '<span><i class="fas fa-check-circle p_pro" title="PRO User"></i></span>'; }
					?>
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
			<span class="followers"></span>
			<span class="following"></span>
			<span class="p_joined p_data_pad"></span>
		</div>
		<div class="row p_data_bot">
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
<?php include('template/footer3.php'); ?>
<script>
	$(document).ready(function(){
		$('#loadings').delay(6000).fadeOut('slow');
		let profname = '<?php echo $_GET['user'];?>';

//profile details
	$('#p_img').attr("src","https://steemitimages.com/u/"+profname+"/avatar");
	steem.api.getAccounts([profname], function(err, result) {
	  	//console.log(result)
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

// get user comments
	let $start_author, $cmt_limit, cmt_content = "#cmt_content";
	let comments_query = {
		start_author: profname,
		limit: 21,
	};

	steem.api.getDiscussionsByComments(comments_query, function(err, result){
    	//console.log(err, result);

    	result.forEach(($post, i) => {
    		let cmt_body = $post.body;
    		let activeDate = moment.utc($post.created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
			let reputation = steem.formatter.reputation($post.author_reputation);
			let url = $post.url;

    		$(cmt_content).append('<div class="profile_content">\n' +
				'\n' +
				'<div style="padding-bottom:5px;"><span><a href="/@'+$post.author+'"><img src="https://steemitimages.com/u/' + $post.author + '/avatar" alt="img" class="img-fluid rounded-circle p_content_img"></a></span>\n' +
				'\n' + 
				'<span class="p_content_author"><a href="/@'+$post.author+'">' + $post.author + '</a></span><span style="padding-right:4px;">('+reputation+')</span>\n' +
				'\n' + 
				'<span style="padding-right:5px;">in '+$post.category+'</span><span class="time"><i class="far fa-clock"></i> ' + activeDate + '</span></div>\n' +
				'\n' +  
				'<h4 class="p_content_title"><a href="https://steemit.com' + url + '" target="_blank">Re: ' + $post.root_title + '</a></h4>\n' +
				'\n' +
				'<h5 class="p_content_body">' + cmt_body + '</h5>\n' +
				'\n' +
			'</div>');		

    	});
    });	

// get user replies
	let rep_content = "#replies_content";
	steem.api.getRepliesByLastUpdate(profname, '', 23, function(err, result) {
	  	//console.log(err, result);

      	result.forEach(($post, i) => {
			let rep_body = $post.body;
			let activeDate = moment.utc($post.created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
			let reputation = steem.formatter.reputation($post.author_reputation);
			let url = $post.url;

			$(rep_content).append('<div class="profile_content">\n' +
				'\n' +
				'<div style="padding-bottom:5px;">\n' +
				'\n' +
				'<span><a href="/@'+$post.author+'"><img src="https://steemitimages.com/u/' + $post.author + '/avatar" alt="img" class="img-fluid rounded-circle p_content_img"></a></span>\n' +
				'\n' +
				'<span class="p_content_author"><a href="/@'+$post.author+'">' + $post.author + '</a></span><span class="p_content_pad">('+reputation+')</span>\n' +
				'\n' +
				'<span class="p_content_pad">in '+$post.category+'</span><span class="time"><i class="far fa-clock"></i> ' + activeDate + '</span>\n' +
				'\n' + 
				'</div>\n' +
				'\n' +  
				'<h4 class="p_content_title"><a href="https://steemit.com' + url + '" target="_blank">Re: ' + $post.root_title + '</a></h4>\n' +
				'\n' +
				'<h5 class="p_content_body">' + rep_body + '</h5>\n' +
				'\n' +
			'</div>');		
    	});
	});
// check if user following
    isFollowing = username;
    steem.api.getFollowers(profname, username, "blog", 10, function(err, result) {
    console.log(result)
        let isFollow = (result.filter(followers => followers.follower == isFollowing));
        if(isFollow.length > 0) {isFollow = 'Following'} else {isFollow = 'Follow'}
        $('.foll').html(isFollow);
    console.log(isFollow)
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