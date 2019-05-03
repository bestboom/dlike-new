<?php include('template/header2.php'); require ('lib/solvemedialib.php'); ?>
    <?php if($_COOKIE['username'] == ''){ ?>
        <div class="container">
            <div class="row home-banner">
                <div class="col-md-3 main main_offer">
                    <div class="daily">
                        <div class="daily_box"><p class="daily_start">10</p><p class="daily_mid">STEEM</p><p class="daily_end">Daily</p></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-content">
                        <h2>Dlike - Where You Get Liked</h2>
                        <p>Share What you like with community <br>Get rewarded if community likes your shares</p>
                        <h5>Daily Top Recommended Post (most dlikes) is Rewarded By Dlike</h5>
                        <h5>Anyone can recommend a post for which steem account is not compulsory</h5>
                        <!-- <h2 class="annc">Starting 11th March</h2> -->
                    </div>
                </div>
                <div class="col-md-3 main_offer">
                    <div class="daily">
                        <div class="daily_box"><p class="daily_start">2500</p><p class="daily_mid">DLike Tokens</p><p class="daily_end">Daily</p></div>
                    </div>
                </div>
             </div>
         </div>
            <? } else { ?>
                <div class="banner-content home-connect">
                    <div class="news-headline-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-1 col-md-2">
                                <i class="fas fa-volume-up vol"></i>
                            </div>
                            <div class="col-lg-11 col-md-10">
                                <div class="news-headlines-block">
                                    <div class="news-headlines-slider ticker">
                                        <ul>
                                            <li>Dlike will soon start token sale for steemians with huge bonus.</li>
                                        </ul>
                                    </div><!-- news-headlines-slider -->
                                </div>
                            </div>
                        </div>
                    </div>
            <? } ?>
            </div>
        </div>
    </div><!-- sub-header -->

    <style>
    .trendingclass{text-align: center;    margin-bottom: 25px;}
    .trendingclass .row{margin:0;}
    .trendingclass .trendingword{font-weight: 900; width: 12%;}
    .trendingclass .colxs-1{text-align: center;font-size: 12px;text-transform: capitalize;}

    @media (min-width: 375px) {
      .trendingclass .trendingword{width: 100%;}
      .trendingclass .colxs-1 {	width: 33%;font-size: 13px;}
    }
    @media (min-width: 480px) {
      .trendingclass .trendingword{width: 100%;}
      .trendingclass .colxs-1 {	width: 20%;font-size: 13px;}
    }
    
    </style>
    <div class="latest-post-section">
	<div class="container trendingclass">
	    <div class="row">
		<div class="colxs-1 trendingword">Trending Now ></div>
		<div class="colxs-1">test 1</div>
		<div class="colxs-1">test 2</div>
		<div class="colxs-1">test 3</div>
		<div class="colxs-1">test 4</div>
		<div class="colxs-1">test 5</div>
		<div class="colxs-1">test 6</div>
		<div class="colxs-1">test 7</div>
		<div class="colxs-1">test 8</div>
		<div class="colxs-1">test 9</div>
		<div class="colxs-1">test 10</div>
	    </div>
	</div>
    
        <div class="container">
	    
            <div class="row  align-items-center h-100 post_select">
                <div class="row col-md-3 justify-content-center">
                        <h4 class="lab_post orderByLatest activeOrderBy">Latest</h4>
                        <h4 class="lab_post orderByTopRated">Top Rated</h4>
                </div>
                <div class="col-md-9 lay">&nbsp;</div>
            </div>
            
            <div class="row" id="content">
            </div>
		
		
		  <div class="modal fade" id="PostStatusModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
			<div class="modal-body text-center">
			    <input type="hidden" id="p_username" />
			    <input type="hidden" id="p_permlink" />
			    <input type="hidden" id="p_category" />
			    <p>What would you think about this post?</p>
			    <select class="form-control" id="status_select">
				<option value="">Please select</option>
				<option value="Rejected">Rejected</option>
				<option value="Low Level">Low Level</option>
				<option value="High Level">High Level</option>
			    </select>
			    <br>
			    <p><input type="button" id="savepoststatus" class="btn btn-primary" value="Save it"/></p>
				    
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		      </div>
		      
		    </div>
		  </div>
		
		
        </div>
    </div>
<?php include('template/modals/modal.php'); ?>    
<?php include('template/footer2.php'); ?>
<style>
.showcursor{cursor:pointer;}
</style>
<script>
    function openmodal_popup(self){
	var permlink = $(self).data('permlink');
	var author = $(self).data('author');
	var category = $(self).data('category');
	
	$("#p_username").val(author);
	$("#p_permlink").val(permlink);
	$("#p_category").val(category);
	
	$("#PostStatusModal").modal('show');
    }
    	$(document).ready(function(){


	var savepoststatus=$('#savepoststatus');

	
	    
	

	savepoststatus.click(function(){

	    var p_username = $("#p_username").val();
	    var p_permlink = $("#p_permlink").val();
	    var p_category = $("#p_category").val();
	    var p_status = $("#status_select").val();
	    if(p_status == ""){
		alert("Please select status.");
		return false;
	    }
	    
	    $.ajax({
		    type: "POST",
		    url: '/helper/poststatus.php',
		    data:{'p_username':p_username,'p_permlink':p_permlink,'p_category':p_category,'p_status':p_status},
		    dataType: 'json',
		    success: function(response) {
			if(response.status == "OK") {
			    toastr.success(response.message);
			    $('#PostStatusModal').modal('hide');
			    
			    var all_status = p_status;
			    if(all_status == "Rejected") {
				var colorset = 'red';
				$('#status_icon' + p_permlink + p_username).css({"color": colorset});
				$('#status_icon' + p_permlink + p_username).removeAttr('onclick');
			    }
			    else if(all_status == "Low Level") {
				var colorset = 'blue';
			       $('#status_icon' + p_permlink + p_username).css({"color": colorset});
				$('#status_icon' + p_permlink + p_username).removeAttr('onclick');
			    }
			    else if(all_status == "High Level") {
				var colorset = 'green';
				$('#status_icon' + p_permlink + p_username).css({"color": colorset});
				$('#status_icon' + p_permlink + p_username).removeAttr('onclick');
			    }
				
			}
			else {
			    $('#PostStatusModal').modal('hide');
			    toastr.error(response.message);
			    return false;
			}
		    },
		    error: function() {
			$('#PostStatusModal').modal('hide');
			 toastr.error('Error occured');
			    return false;
		    }
	    });
	});


  
	$(".orderByTopRated").click(function(){
		$( ".orderByLatest" ).removeClass( "activeOrderBy" );
		$( ".orderByTopRated" ).last().addClass( "activeOrderBy" );
		showPostSortedByLikes();
	});
	
	$(".orderByLatest").click(function(){
		$( ".orderByLatest" ).last().addClass( "activeOrderBy" );
		$( ".orderByTopRated" ).removeClass( "activeOrderBy" );
		showPostSortedByLatest();
	});
	
	let $tag, $limit, content = "#content";
	let query = {
		tag: "dlike",
		limit: 92,
	};

	steem.api.getDiscussionsByCreated(query, function (err, res) {
		//console.log(res);
		res.forEach(($post, i) => {
			let metadata;
			if ($post.json_metadata && $post.json_metadata.length > 0){
				metadata = JSON.parse($post.json_metadata);
			}
			
			var currentPostNumber = i;
			var currentLikesDivElement = 'postLike_' + i;
			if(metadata && metadata.community == "dlike"){
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

				//get meta tags
				let steemTags = metadata.tags;
				let dlikeTags = steemTags.slice(2);
				let metatags = dlikeTags.map(function (meta) { if (meta) return '<a href="#"> #' + meta + ' </a>' });
				let category = metadata.category;
				let exturl = metadata.url;

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
					'<div class="row d-flex justify-content-center hov-it"><div class="hov-item"><img src="./images/post/dlike-hover.png" alt="img" class="img-responsive"><span class="hov_me" data-toggle="modal" data-target="" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><div class="hov-txt"><h5><span id="hov-num" class="commentsDiv' + currentLikesDivElement + '"></span></h5></div></span></div></div>\n' +
                    '\n' +
					'<h4 class="post-title"><a href="' + exturl + '" target="_blank">' + $post.title + '</a></h4>\n' +
					'\n' +
					'<p class="post-entry post-tags">' + metatags + '</p>\n' +
					'\n' +
					'<div class="post-footer">\n' +
					'<div class="post-author-block">\n' +
					'<div class="author-info"><i class="fas fa-dollar-sign"></i><span>&nbsp;' + $post.pending_payout_value.substr(0, 4) + '</span> | <i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+$post.permlink +$post.author +'">0</span></div>\n' +
					'</div>\n' +
					'<div class="post-comments"><a id="status_icon'+$post.permlink +$post.author +'" onclick="return openmodal_popup(this)" class="showcursor" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '" data-category="' + category + '"><i class="fas fa-check-circle" id="post_status'+$post.permlink +$post.author +'"></i></a><span>&nbsp; | &nbsp;<a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+$post.permlink +$post.author +'"></i></a><span>&nbsp; | ' + $post.active_votes.length + ' Votes</span></div>\n' +
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


		$.ajax({
			type: "POST",
			url: '/helper/getpoststatus.php',
			data:{'permlink':$post.permlink},
			dataType: 'json',
			success: function(response) {
			    if(response.status == "OK") {
				var all_status = response.setstatus;
				if(all_status == "Rejected") {
				    var colorset = 'red';
				    $('#status_icon' + permlink + author).css({"color": colorset});
				    $('#status_icon' + permlink + author).removeAttr('onclick');
				}
				else if(all_status == "Low Level") {
				    var colorset = 'blue';
				   $('#status_icon' + permlink + author).css({"color": colorset});
				    $('#status_icon' + permlink + author).removeAttr('onclick');
				}
				else if(all_status == "High Level") {
				    var colorset = 'green';
				    $('#status_icon' + permlink + author).css({"color": colorset});
				    $('#status_icon' + permlink + author).removeAttr('onclick');
				}
				
				$('#status_icon' + permlink + author).hover(function() {toastr.error('Post already Checked!');})
					
			    }
			}
		});



    		}
		});


		
	    
		
	});

	steem.api.getContent(topauthor , toppermlink, function(err, res) {
		let metadata = JSON.parse(res.json_metadata);
		let img = new Image();
		if (typeof metadata.image === "string"){
			img.src = metadata.image.replace("?","?");
		} else {
			img.src = metadata.image[0];
		}
		json_metadata = metadata;
		let category = metadata.category;
		if (category === undefined) { category = "dlike"; } else {category = metadata.category;};
		let steemTags = metadata.tags;
        let dlikeTags = steemTags.slice(2);
        let posttags = dlikeTags.map(function (meta) { if (meta) return '<a href="#">' + meta + ' </a>' });
		let post_description = metadata.body;
		let title = res.title;
        let created = res.created;
        let created_time = moment.utc(created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
        let author = res.author;
        let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
        //let post_body = $(post_description).text();

		$('.auth_name').html(author);
        $('#top_title').html(title);
        $('.post_catg').html(category);
        $('.post-date').html(created_time);
		$('.top_post').text(post_description.substr(0,150)+'...');
        $('.tags').html(posttags);
		$('#top_img').attr("src", img.src).show();
        $('.authThumb').attr("src", auth_img);
        $('#top_post_votes').html(res.pending_payout_value.substr(0, 4));
	});

});

//check likes
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

function showPostSortedByLikes() {
	var divList = $(".postsMainDiv");
	divList.sort(function(a, b){
		return $(b).attr("postLikes") - $(a).attr("postLikes")
	});
	$("#content").html(divList);
};

function showPostSortedByLatest() {
	var divList = $(".postsMainDiv");
	divList.sort(function(a, b){
		return $(a).attr("postNumber") - $(b).attr("postNumber")
	});
	$("#content").html(divList);
	
};

</script>
