<?php include('template/header5.php');  ?>
</div><!-- sub-header -->
    
<div class="latest-post-section">
	<div class="container">
		<div class="row  align-items-center h-100 myloader" style="margin-bottom:30px;">
			<div class="row col-md-3 justify-content-center">
				<h4 class="lab_post">
					<?php echo $_GET['cat'];?>
				</h4>
			</div>
			<div class="col-md-9 lay">&nbsp;</div>
		</div>
		<!--  <div id="loader">Loading</div> -->
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
	//$("#loader").show();
	var savepoststatus=$('#savepoststatus');
	var saveuserpoststatus=$('#saveuserpoststatus');
	var savefeaturedpoststatus=$('#savefeaturedpoststatus');
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
					var username = resulthtml[i]['username'];
					var imgsrc =  resulthtml[i]['imgsrc'];
					var categoryset = resulthtml[i]['category'];
					var titleset = resulthtml[i]['title'];
					var userstatus = resulthtml[i]['userstatus'];
					var poststatus = resulthtml[i]['poststatus'];
					var author = username;
					var adduserhtml = "";
					var addfeaturedhtml = "";
					var addposthtml = "";
					var add_onclick2 = '';
					var ucolorset = '';
					var show_status = '';

					if(c_username == "dlike") {

						addfeaturedhtml += '<a id="featuredstatus_icon'+permlink +username +'" onclick="return openfeaturedmodal_popup(this)" class="showcursor" data-permlink="' + permlink + '" data-author="' + username + '" data-imgurl="' + imgsrc + '" data-title="' + titleset + '" data-category="' + categoryset + '"><i class="fa fa-plus" id="featuredpost_status'+permlink +username +'"></i></a><span>&nbsp; | &nbsp;';

						var add_onclick = 'onclick="return openmodal_popup(this)"';
						var colorset = '';
						if(poststatus == "Rejected") {
							colorset = 'style="color:red"';
							add_onclick =  '';

						}
						else if(poststatus == "Low Level") {
							colorset = 'style="color:blue"';
							add_onclick =  '';

						}
						else if(poststatus == "High Level") {
							colorset = 'style="color:green"';
							add_onclick =  '';

						}
						addposthtml = '<a '+colorset+' id="status_icon'+permlink +username+'" '+add_onclick+' class="showcursor" data-permlink="' + permlink + '" data-author="' + username + '" data-category="' + categoryset + '"><i class="fas fa-check-circle" id="post_status'+permlink +username +'"></i></a><span>&nbsp; ';
						add_onclick2 = 'onclick="return openuser_popup(this)"';
						ucolorset = 'style="color:gray;"';
						show_status = 'yes';
					}
					var mylabel = permlink +username;
					var newValue = mylabel.replace('.', '');

					if(userstatus == "0") {
						ucolorset = 'style="color:black"';
						show_status = "yes";
					}
					else if(userstatus == "1") {
						ucolorset = 'style="color:orange"';
						show_status = "yes";
					}
					else if(userstatus == "2") {
						ucolorset = 'style="color:green"';
						show_status = "yes";
					}
					else if(userstatus == "3") {
						ucolorset = 'style="color:red"';
						show_status = "yes";
					}

					if(show_status == 'yes') {
						adduserhtml += '<a '+ucolorset+' class="userstatus_icon'+newValue+' showcursor" '+add_onclick2+' data-permlink="' + permlink + '" data-author="' + username + '" data-category="' + categoryset + '"><i class="fa fa-check-circle" class="user_status'+newValue +'"></i></a>';
					}

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
					'<div class="author-thumb"><a href="#"><img src="https://steemitimages.com/u/' + username + '/avatar" alt="img" class="img-responsive"></a></div>\n' +
					'\n' +
					'<div class="author-info">\n' +
					'\n' +
					'<h5><a href="#">' + username + "&nbsp;" +adduserhtml +'</a><div class="time" id="articletime_'+permlink+'">'+timstamp+'</div></h5>\n' +
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
					'<div class="post-thumb"><a class="post_detail" data-toggle="modal" data-target="#postModal" data-permlink="' + permlink + '" data-author="' + username + '"></a></div>\n' + 
					'\n' +
					'<div class="post-contnet-wrap">\n' +
					'\n' +
					'<h4 class="post-title"><a href="" target="_blank"></a></h4>\n' +
					'\n' +
					'<p class="post-entry post-tags"></p>\n' +
					'\n' +
					'<div class="post-footer">\n' +
					'<div class="post-author-block">\n' +
					'<div class="author-info"><i class="fas fa-dollar-sign"></i><span class="pending_payout_value"></span> | <i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+permlink +username +'">0</span></div>\n' +
					'</div>\n' +
					'<div class="post-comments">'+addfeaturedhtml+addposthtml+'| &nbsp;<a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + permlink + '" data-author="' + username + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+permlink +username +'"></i></a><span class="active_votes">&nbsp; |  Votes</span></div>\n' +
					'</div>\n' +
					'</div>\n' +
					'</article></div>';

					$("#contentposts").append(responsehtml);

					steem.api.getContent(username , permlink, function(err, res) {
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
						let posttags = dlikeTags.map(function (meta) { if (meta) return '<a href="/tags/'+ meta +'">' + meta + ' </a>' });
						let post_description = metadata.body;
						let title = res.title;
					//let created = res.created;
					let created = timstamp;
					let created_time = moment.utc(created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
					let author = res.author;
					let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
					var username = author;
					var created_at = created;
					var permlink = res.permlink;
					var metatags =  posttags;
					var exturl =   metadata.url;;
					var thumbnail = '<img src="' + metadata.image + '" alt="' + title + '" class="card-img-top img-fluid">';

					$('#article_'+permlink+' span.post-meta').html(category);
					$('#article_'+permlink+' a.post_detail').html(thumbnail);
					$('#article_'+permlink+' h4.post-title a').attr('href',exturl);
					$('#article_'+permlink+' h4.post-title a').html(title);
					$('#article_'+permlink+' p.post-tags').html(metatags);
					$('#article_'+permlink+' span.pending_payout_value').html(res.pending_payout_value.substr(0, 4));
					$('#article_'+permlink+' span.active_votes').html("&nbsp; | "+res.active_votes.length+" Votes");

				});


					steem.api.getActiveVotes(username , permlink, function(err, result) {
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
				$("#loader").hide();
				$(".myloader").css('display','flex');
			}
			else {
				$("#loader").hide();
				$(".myloader").css('display','flex');
				$("#contentposts").append("No posts found.");
			}
		}
	});

});
</script>