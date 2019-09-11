<?php include('template/header5.php');  ?>
</div><!-- sub-header -->
<div id="p_cover" class="img-fluid"></div>    
<div class="latest-post-section" style="min-height:80vh;padding: 35px 0 60px 0;">
	<div class="container">
		<div class="row" style="margin: 0px 1px 25px;">
			<div style="background: #eceff199;min-width: 100%;padding: 5px;">
				<i class="fas fa-hand-holding-heart" style="border: 1px solid #c51d24;border-radius: 15px;padding: 3px;color: #c51d24;margin-left: 10px;"></i> <span style="font-weight: 600;padding-left: 10px;">Latest posts shared with #<?php echo $_GET['tag'];?> tag.</span>
			</div>
		</div>
		<div id="loadings"><img src="/images/loader.svg" width="100"></div>
		<div class="row" id="contentposts"></div>
	</div>
</div>

<div class="modal fade" id="upvoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content mybody">
            <?php include('template/modals/upvotemodal.php'); ?>
        </div>
    </div>
</div>
<?php include('template/footer.php'); ?>
<script>
	$(document).ready(function(){
		$('#loadings').delay(4000).fadeOut('slow');
	
		var c_username = $('#c_username').val();
		var tagname = '<?php echo $_GET['tag'];?>';

		$.ajax({
			type: 'POST',
			url: '/helper/gettposts.php',
			data:{'mytag':tagname},
			dataType: 'json',
				success: function(response) {
				    if(response.status == "OK") {
						var resulthtml = response.data_row;
						//console.log(resulthtml);
						for(i=0;i<resulthtml.length;i++) 
						{

							var responsehtml = '';
							var currentPostNumber = i;
							var permlink = resulthtml[i]['permlink'];
							var author = resulthtml[i]['username'];

					responsehtml = '<div class="col-lg-4 col-md-6 postsMainDiv mainDiv" postLikes="0" postNumber="'+currentPostNumber+'" id="article_'+permlink+'">\n' +
					'\n' +
					'<article class="post-style-two">\n' +
					'\n' +
					'<div class="post-contnet-wrap-top">\n' +
					'\n' +
					'<div class="post-footer">\n' +
					'\n' +
					'<div class="post-author-block">\n' +
					'\n' +
					'<div class="author-thumb"><a href="/@' + author + '"><img src="https://steemitimages.com/u/' + author + '/avatar" alt="img" class="img-responsive"></a></div>\n' +
					'\n' +
					'<div class="author-info">\n' +
					'\n' +
					'<h5><a href="/@' + author + '">' + author +'</a><div class="time" id="post_time"></div></h5>\n' +
					'\n' +    
					'</div>\n' +
					'\n' + 
					'</div>\n' +
					'\n' +
					'<div class="post-comments"><span class="post-meta"></span></div>\n' +
					'\n' +
					'</div>\n' +
					'\n' +
					'</div>\n' + 
					'\n' +
					'<div class="post-thumb"><a class="post_detail" data-toggle="modal" data-target="#postModal" data-permlink="' + permlink + '" data-author="' + author + '"></a></div>\n' + 
					'\n' +
					'<div class="post-contnet-wrap">\n' +
					'\n' +
					'<h4 class="post-title"><a href=""></a></h4>\n' +
					'\n' +
					'<p class="post-entry post-tags"></p>\n' +
					'\n' +
					'<div class="post-footer">\n' +
					'<div class="post-author-block">\n' +
					'<div class="author-info"><i class="fas fa-dollar-sign"></i><span class="pending_payout_value"></span> + <span id="se_token">0</span> DLIKER | <i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+permlink +author +'">0</span></div>\n' +
					'</div>\n' +
					'<div class="post-comments">&nbsp;<a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + permlink + '" data-author="' + author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+permlink +author +'"></i></a><span class="active_votes">&nbsp; |  Votes</span></div>\n' +
					'</div>\n' +
					'</div>\n' +
					'</article></div>';

					$("#contentposts").append(responsehtml);

					steem.api.getContent(author , permlink, function(err, res) {
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
						let posttags = dlikeTags.map(function (meta) { if (meta) return '<a href="/tags/'+ meta +'"> #' + meta + ' </a>' });
						let post_description = metadata.body;
						let title = res.title;
						let created = res.created;
						let created_time = moment.utc(created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
						let author = res.author;
						let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
						var permlink = res.permlink;
						var metatags =  posttags;
						var exturl =   metadata.url;;
						let post_link = '/post/@' + author + '/' + permlink + '';
						var thumbnail = '<img src="' + metadata.image + '" alt="' + title + '" class="card-img-top img-fluid">';

						$('#article_'+permlink+' span.post-meta').html(category);
						$('#article_'+permlink+' a.post_detail').html(thumbnail);
						$('#article_'+permlink+' h4.post-title a').attr('href',post_link);
						$('#article_'+permlink+' h4.post-title a').html(title);
						$('#article_'+permlink+' p.post-tags').html(metatags);
						$('#article_'+permlink+' span.pending_payout_value').html(res.pending_payout_value.substr(0, 4));
						$('#article_'+permlink+' span.active_votes').html("&nbsp; | "+res.active_votes.length+" Votes");
						$('#article_'+permlink+' #post_time').html(created_time);

						$.getJSON('https://scot-api.steem-engine.com/@'+author+'/'+permlink+'', function(data) {
    						console.log(data.DLIKER.pending_token);
    						let pending_token = (data.DLIKER.pending_token)/1000;
    						$('#article_'+permlink+' #se_token').html(pending_token);
						});

						steem.api.getActiveVotes(author, permlink, function(err, result) {
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
								if (voterList[j].voter == c_username) { 
									$("#vote_icon" + permlink + author).css("color", "RED"); 
									$('#vote_icon' + permlink + author).click(function(){return false;});
									$('#vote_icon' + permlink + author).hover(function() {toastr.error('hmm... Already Upvoted');})
								}
							}                        
						});
					});
				}
				$("#loadings").hide();
			}
			else {
				$("#loadings").hide();
				var noposthtml = '';
					noposthtml = '<div style="background: #eee;width: 60%;padding: 30px;border-radius: 7px;text-align: center;flex-grow:1;margin-top:8%;">\n' +
					'\n' +
					'<div><i class="fas fa-frown" style="color: #c51d24;font-size: 5rem;"></i>\n' +
					'\n' +
					'</div>\n' +
					'\n' +
					'<div style="padding: 20px;"><h3 style="font-weight:600;color:#c51d24;">No Posts Found</h3>\n' +
					'\n' +
					'</div>\n' +
					'\n' +
					'</div>';				
				$("#contentposts").append(noposthtml);
			}
		}
	});
});
</script>