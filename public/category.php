<?php include('template/header5.php');  ?>
</div><!-- sub-header -->
    
<div class="latest-post-section" style="min-height:80vh;">
	<div class="container">
		<div class="row  align-items-center h-100 myloader" style="margin-bottom:30px;">
			<div class="row col-md-3 justify-content-center">
				<h4 class="lab_post">
					<?php echo $_GET['cat'];?>
				</h4>
			</div>
			<div class="col-md-9 lay">&nbsp;</div>
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
  
<?php include('template/footer3.php'); ?>
<script>

	$(document).ready(function(){
	$('#loadings').delay(6000).fadeOut('slow');
	//var savepoststatus=$('#savepoststatus');
	//var saveuserpoststatus=$('#saveuserpoststatus');
	//var savefeaturedpoststatus=$('#savefeaturedpoststatus');
	//var c_username = $('#c_username').val();

	var c_username = '<?php echo $_COOKIE['username']; ?>';
	var catname = '<?php echo $_GET['cat'];?>';
	
	$.ajax({
		type: "POST",
		url: '/helper/gettposts.php',
		data:{'catname':catname},
		dataType: 'json',
		success: function(response) {
			if(response.status == "OK") {
				var resulthtml = response.data_row;
				
				//$(".total_posts").html(resulthtml.length+' posts found, <a style="color: #1652f0;" href="/tags/'+tagname+'">#'+tagname+'</a>');
				for(i=0;i<resulthtml.length;i++) {

					var responsehtml = '';
					var currentPostNumber = i;
					var currentLikesDivElement = 'postLike_' + i;
					var timstamp = resulthtml[i]['created_at'];
					var permlink = resulthtml[i]['permlink'];
					var auth_name = resulthtml[i]['username'];
					var imgsrc =  resulthtml[i]['imgsrc'];
					var categoryset = resulthtml[i]['category'];
					var titleset = resulthtml[i]['title'];
					var userstatus = resulthtml[i]['userstatus'];
					var poststatus = resulthtml[i]['poststatus'];
					var author = auth_name;
					var add_onclick2 = '';
					var ucolorset = '';


					var mylabel = permlink +author;
					var newValue = mylabel.replace('.', '');

					responsehtml = '<div class="col-lg-4 col-md-6 postsMainDiv mainDiv '+currentLikesDivElement+'" postLikes="0" postNumber="'+currentPostNumber+'" id="article_'+permlink+'">\n' +
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
					'<h5><a href="/@' + author + '">' + author +'</a><div class="time" id="articletime_'+permlink+'">'+timstamp+'</div></h5>\n' +
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
					'<div class="author-info"><i class="fas fa-dollar-sign"></i><span class="pending_payout_value"></span> | <i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+permlink +author +'">0</span></div>\n' +
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
						//let created = res.created;
						let created = timstamp;
						let created_time = moment.utc(created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
						let author = res.author;
						let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
						var author_name = author;
						var created_at = created;
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
				}
				$("#loader").hide();
				$(".myloader").css('display','flex');
			}
			else {
				//$("#loader").hide();
				//$(".myloader").css('display','flex');
				$("#contentposts").append("No posts found.");
			}
		}
	});

});
</script>