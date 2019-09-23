$(document).ready(function(){
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

			$post["vote_info"] = "";
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
				let metatags = dlikeTags.map(function (meta) { if (meta) return '<a href="/tags/' + meta + '"> #' + meta + ' </a>' });
				let category = metadata.category;
				let category_link = category.toLowerCase();
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

				var adduserhtml = "";
				var mylabel = $post.permlink +$post.author;
				var newValue = mylabel.replace('.', '');

				adduserhtml += '<a style="color:white;" class="userstatus_icon'+newValue+'"><i class="fa fa-check-circle" class="user_status'+newValue +'"></i></a>';

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
					'<div class="author-thumb"><a href="/@' + $post.author + '"><img src="https://steemitimages.com/u/' + $post.author + '/avatar" alt="img" class="img-responsive"></a></div>\n' +
					'\n' +
					'<div class="author-info">\n' +
					'\n' +
					'<h5><a href="/@' + $post.author + '">' + $post.author  + "&nbsp;" +adduserhtml +'</a><div class="time">' + activeDate + '</div></h5>\n' +
					'\n' +    
					'</div>\n' +
					'\n' + 
					'</div>\n' +
					'\n' +
					'<div class="post-comments post-catg"><a href="/category/' + category_link + '"><span class="post-meta">' + category + '</span></a></div>\n' +
					'\n' +
					'</div>\n' +
					'\n' +
					'</div>\n' + 
					'\n' +
					'<div class="post-thumb"><a href="/post/@' + $post.author + '/' + $post.permlink + '">' + thumbnail + '</a></div>\n' + 
					'\n' +
					'<div class="post-contnet-wrap">\n' +
					'\n' +
					'<div class="row d-flex justify-content-center hov-it"><div class="hov-item"><img src="./images/post/dlike-hover.png" alt="img" class="img-responsive"><span class="hov_me" data-toggle="modal" data-target="" data-likes="" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><div class="hov-txt"><h5><span id="hov-num" class="commentsDiv' + currentLikesDivElement + '"></span></h5></div></span></div></div>\n' +
                    '\n' +
					'<h4 class="post-title"><a href="/post/@' + $post.author + '/' + $post.permlink + '">' + $post.title + '</a></h4>\n' +
					'\n' +
					'<p class="post-entry post-tags">' + metatags + '</p>\n' +
					'\n' +
					'<div class="post-footer">\n' +
					'<div class="post-author-block">\n' +
					'<div class="author-info"><i class="fas fa-dollar-sign"></i><span>&nbsp;' + $post.pending_payout_value.substr(0, 4) + '</span> <b>+</b> <span id="se_token'+newValue +'" data-popover="true" data-html="true" data-content="">0</span> <b>DLIKER</b></div>\n' +
					'</div>\n' +
					'<div class="post-comments"><a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+newValue+'"></i></a><span>&nbsp;' + $post.active_votes.length + '</span>&nbsp; | &nbsp;<i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+$post.permlink +$post.author +'">0</span></div>\n' +
					'</div>\n' +
					'</div>\n' +
				'</article></div>');
				//getTotalLikes($post.author,$post.permlink, currentLikesDivElement);

        		let author = $post.author;
        		let permlink = $post.permlink;				

				$.getJSON('https://scot-api.steem-engine.com/@'+$post.author+'/'+$post.permlink+'', function(data) {
	                //console.log(data.DLIKER.pending_token);
	                let pending_token = (data.DLIKER.pending_token)/1000;
	                $('#se_token' + newValue ).html(pending_token);

	                let voters = data.DLIKER.active_votes;
	                let netshare = data.DLIKER.vote_rshares;

	                    if(voters === Array) {
	                    	var voterList = voters;
	                   	} else {
	                       	var voterList = [];
	                    }
	                    if(!(voters === Array)) {
	                       	var voterList = [];
	                    }
	                    var voterList = voters;
	                    if (voterList.length === 0) {
                            $post["vote_info"] = '<center><red>No Upvotes Yet!</red></center>';
                        }
	                for (let v = 0; v < voterList.length; v++) {
						if(voterList[v].weight>0){
	                        let vote_amt = ((voterList[v].rshares / netshare) * pending_token).toFixed(3);
	                        let votePercent = ((voterList[v].percent / 10000) * 100);
	                        votePercent = parseInt(votePercent);
	                        let voter = voterList[v].voter;
	                        console.log(voter);
	                        if (v > 0) {
	                        	$('#se_token' + newValue ).css('cursor','pointer');
	                        }
	                    	$post["vote_info"] += ('<li style="list-style:none;"><span style="color:#c51d24;"><a> @' + voter + '</a></span>&nbsp;<span>(' + votePercent + '%)</span>&nbsp;&nbsp;<span style="float:right;"><i>' + vote_amt + '</i></span></li>');
	                        if (v == 16) {
	                            let moreV = voterList.length - 15;
	                        $post["vote_info"] += "... and " + moreV + " more upvotes.";
	                            break;
	                        } 
	                    }    
	                }
	                $('#se_token' + newValue ).attr("data-content", $post['vote_info']);
	            }); 

        		//user-pro status
				$.ajax({
					type: "POST",
					url: '/helper/getuserpoststatus.php',
					data:{'author':author},
					dataType: 'json',
					success: function(response) {
					    var mylabel = permlink +author;
						var newValue = mylabel.replace('.', '');
					    if(response.status == "OK") {
						var all_status = response.setstatus;

							if(all_status == "3") {
							    var colorset = 'red';
							    $('.userstatus_icon' + newValue).css({"color": colorset});
							    var erroset = "PRO User";
							}
						$('.userstatus_icon' + newValue).hover(function() {toastr.success(erroset);});	
					    }
					    else {
						    $('.userstatus_icon' + newValue).remove();
					    }
					}
				});

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
                		$("#vote_icon" + newValue).css("color", "RED"); 
                		$('#vote_icon' + newValue).click(function(){return false;});
                		$('#vote_icon' + newValue).hover(function() {toastr.error('hmm... Already Upvoted');})
                	}
                }                        
    		});

    		}
		});
	});
});

//check likes
/* function getTotalLikes(thisAutor, thisPermlink, currentLikesDivElement){
	$.ajax({
		type: "POST",
		url: '/helper/postLikes.php?author='+thisAutor+'&permlink='+thisPermlink,
		dataType: 'json',
		success: function(response) {
			$('.mainDiv' + currentLikesDivElement).attr('postLikes', response.likes);
			$('.hov_me').attr('data-likes', response.likes);
			$('.commentsDiv' + currentLikesDivElement).html(response.likes);
		},
		error: function() {
			//console.log('Error occured');
		}
	});
}; */

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
