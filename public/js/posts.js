$(document).ready(function(){	
	let $tag, $limit, content = "#content";
	let query = {tag: "dlike",limit: 90,};
	steem.api.getDiscussionsByCreated(query, function (err, res) { res.forEach(($post, i) => {
		$post["vote_info"] = "";let metadata;
		if ($post.json_metadata && $post.json_metadata.length > 0){metadata = JSON.parse($post.json_metadata);}
		
		var currentPostNumber = i;var currentLikesDivElement = 'postLike_' + i;
		if(metadata && metadata.community == "dlike"){
			getTotalcomments($post.author,$post.permlink);
			// get image here
			let img = new Image();
			if (typeof metadata.image === "string") {if (metadata.image.indexOf("https://dlike") >= 0){img.src = metadata.image.replace("?","%3f");}else{img.src = metadata.image;}
			} else {if (!metadata.image || metadata.image[0] === undefined) {img.src = "https://dlike.io/images/default-img.jpg";} else {img.src = metadata.image[0];}}

			//get time
			let activeDate = moment.utc($post.created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();

			//get meta tags
			let steemTags = metadata.tags; let dlikeTags = steemTags.slice(2);
			let metatags = dlikeTags.map(function (meta) { if (meta) return '#' + meta + ' '});
			let category = metadata.category; let category_link = category.toLowerCase(); let exturl = metadata.url;

			//Get the body
			let body; if($post&&$post.body&&null!=$post.body)try{body=$post.body,body=body.split(/\n\n#####\n\n/),body=body[1],body=body.replace(/#([^\s]*)/g,"")}catch(o){body=""}else body="";

			//image or youtube
			let thumbnail = '<img src="' + img.src + '" alt="' + $post.title + '" class="card-img-top">';

			var getLocation = function(href) {var l = document.createElement("a");l.href = href;return l;};
			var url = getLocation(metadata.url);var youtubeAnchorTagVariableClass = '';
			if("www.youtube.com"==url.hostname||"youtube.com"==url.hostname||"youtu.be"==url.hostname||"www.youtu.be"==url.hostname)if(youtubeAnchorTagVariableClass="youtubeAnchorTagVariableClass_"+i,""!=url.search){let e=url.search.substr(1);for(i in e=e.split("&")){let l=e[i].split("=");"v"==l[0]&&(thumbnail='<iframe src="https://www.youtube.com/embed/'+l[1]+'" class="card-img-top" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe>')}}else thumbnail='<iframe src="https://www.youtube.com/embed/'+url.pathname+'" class="card-img-top" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe>';

			//check comments
			function getTotalcomments(t,e){steem.api.getContentReplies(t,e,function(a,n){let m=0;n.forEach(t=>{let e;t.json_metadata&&t.json_metadata.length>0&&(e=JSON.parse(t.json_metadata)),e&&"dlike"==e.community&&(m+=1)}),$("#DlikeComments"+e+t).html(m)})}

			var adduserhtml = ""; var mylabel = $post.permlink +$post.author;var newValue = mylabel.replace('.', '');
			adduserhtml += '<a style="color:white;" class="userstatus_icon'+newValue+'"><i class="fa fa-check-circle" class="user_status'+newValue +'"></i></a>';

			//start posts here
			$(content).append('<div class="col-lg-4 col-md-6 postsMainDiv mainDiv'+ currentLikesDivElement +'" postLikes="0" postNumber="'+ currentPostNumber +'">\n' +
				'\n' +
				'<article class="post-style-two"><div class="post-contnet-wrap-top">\n' +
				'\n' +
				'<div class="post-footer">\n' +
				'\n' +
				'<div class="post-author-block">\n' +
				'\n' +
				'<div><a href="https://steemit.com/@' + $post.author + '" target="_blank"><img src="https://steemitimages.com/u/' + $post.author + '/avatar" alt="img" class="img-responsive my_img"></a></div>\n' +
				'\n' +
				'<div class="author-info">\n' +
				'\n' +
				'<h5><a href="https://steemit.com/@' + $post.author + '" target="_blank">' + $post.author  + "&nbsp;" +adduserhtml +'</a><div class="time">' + activeDate + '</div></h5>\n' +
				'\n' +    
				'</div></div>\n' +
				'\n' +
				'<div class="post-comments post-catg"><span class="post-meta"><b>' + category + '</b></span></div>\n' +
				'\n' +
				'</div></div>\n' +
				'\n' +
				'<div class="post-thumb img-fluid"><a href="/post/@' + $post.author + '/' + $post.permlink + '">' + thumbnail + '</a></div>\n' + 
				'\n' +
				'<div class="post-contnet-wrap">\n' +
				'\n' +
				'<h4 class="post-title single_title"><a href="/post/@' + $post.author + '/' + $post.permlink + '">' + $post.title + '</a></h4>\n' +
				'\n' +
				'<p class="post-entry post-tags">' + metatags + '</p>\n' +
				'\n' +
				'<div class="post-footer">\n' +
				'<div class="post-author-block">\n' +
				'<div class="author-info"><i class="fas fa-dollar-sign"></i><span>&nbsp;' + $post.pending_payout_value.substr(0, 4) + '</span> <b>+</b> <span id="se_token'+newValue +'" data-popover="true" data-html="true" data-content="">0</span> <b>DLIKER</b></div>\n' +
				'</div>\n' +
				'<div class="post-comments"><a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+newValue+'"></i></a><span>&nbsp;' + $post.active_votes.length + '</span>&nbsp; | &nbsp;<i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+$post.permlink +$post.author +'">0</span></div>\n' +
				'</div></div>\n' +
			'</article></div>');
    		let author = $post.author;let permlink = $post.permlink;				
    		// dliker
			$.getJSON("https://scot-api.steem-engine.com/@"+$post.author+"/"+$post.permlink,function(e){let t=e.DLIKER.pending_token/1e3;$("#se_token"+newValue).html(t);let n=e.DLIKER.active_votes,o=e.DLIKER.vote_rshares;if(n===Array)var s=n;else s=[];if(n!==Array)s=[];0===(s=n).length&&($post.vote_info="<center><red>No Upvotes Yet!</red></center>");for(let e=0;e<s.length;e++)if(s[e].weight>0){let n=(s[e].rshares/o*t).toFixed(3),r=s[e].percent/1e4*100;r=parseInt(r);let a=s[e].voter;if(e>0&&$("#se_token"+newValue).css("cursor","pointer"),$post.vote_info+='<li style="list-style:none;"><span style="color:#c51d24;"><a> @'+a+"</a></span>&nbsp;<span>("+r+'%)</span>&nbsp;&nbsp;<span style="float:right;"><i>'+n+"</i></span></li>",16==e){let e=s.length-15;$post.vote_info+="... and "+e+" more upvotes.";break}}$("#se_token"+newValue).attr("data-content",$post.vote_info)});
    		//user-pro status
			$.ajax({type:"POST",url:"/helper/getuserpoststatus.php",data:{author:author},dataType:"json",success:function(s){var t=(permlink+author).replace(".","");if("OK"==s.status){if("3"==s.setstatus){$(".userstatus_icon"+t).css({color:"red"});var e="PRO User"}$(".userstatus_icon"+t).hover(function(){toastr.success(e)})}else $(".userstatus_icon"+t).remove()}});
    		steem.api.getActiveVotes($post.author,$post.permlink,function(e,o){if(o===Array)var t=o;else t=[];t!==Array&&(t=[]);t=o;for(let e=0;e<t.length;e++)t[e].voter==username&&($("#vote_icon"+newValue).css("color","RED"),$("#vote_icon"+newValue).click(function(){return!1}),$("#vote_icon"+newValue).hover(function(){toastr.error("hmm... Already Upvoted")}))});
    		}
		});
	});
$('body').popover({ selector: '[data-popover]', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});
$('.latest-post-section').on("click", ".upvoting", function() {
    var votepermlink = $(this).attr("data-permlink");var voteauthor = $(this).attr("data-author");
    $("#vote_author").val(voteauthor);$("#vote_permlink").val(votepermlink);
});
var rangeSlider = document.getElementById("rs-range-line");
var rangeBullet = document.getElementById("rs-bullet");
rangeSlider.addEventListener("input", showSliderValue, false);
function showSliderValue() {rangeBullet.innerHTML = rangeSlider.value;}
$('.upme').click(function() {
    var upvoteValue = $('#rs-range-line').val();var upvoteValue = upvoteValue * 100;var weight = parseInt(upvoteValue);
    var v_authorname = $("#vote_author").val();var v_permlink = $("#vote_permlink").val();var voter = username;
    var datav = {v_permlink: v_permlink,v_author: v_authorname,vote_value: upvoteValue};
    if (username != null) {$('#upvoting-bar').hide();$('#upvoting-status').show();
        $.ajax({type: "POST",url: "/helper/vote.php",data: datav,
            success: function(data) {
                try {var response = JSON.parse(data)
                    if (response.error == true) {toastr.error('There is some issue!');
                        $('#upvoteModal').modal('hide');$('#upvoting-status').hide();$('#upvoting-bar').show();return false;
                    } else {toastr.success('UpVoted Successfully!');
                        $('#upvoteModal').modal('hide');$('#upvoting-status').hide();$('#upvoting-bar').show();
                    }
                } catch (err) {toastr.error('Sorry. Server response is malformed.');
                    $('#upvoteModal').modal('hide');$('#upvoting-status').hide();$('#upvoting-bar').show();
                }
            }
        }); 
    } else { toastr.error('hmm... You must be login witn steem username!');$('#upvoteModal').modal('hide');return false;};
});
});