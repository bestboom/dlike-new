<?php include('template/header2.php'); ?>
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
    <div class="latest-post-section">
	<div class="container">
	    <div class="row  align-items-center h-100">
                <div class="row col-md-3 justify-content-center">
                        <h4 class="lab_post"><?php echo $_GET['tag'];?></h4>
                </div>
                <div class="col-md-9 lay">&nbsp;</div>
            </div>
	    <div class="row" id="contentposts">
	    </div>
	</div>
    </div>
  
<?php include('template/footer2.php'); ?>
<style>
.showcursor{cursor:pointer;}
</style>
<script>

    	$(document).ready(function(){
      
		  var tagname = '<?php echo $_GET['tag'];?>';
	
			$.ajax({
			type: "POST",
			url: '/helper/gettposts.php',
			data:{'tagname':tagname},
			dataType: 'json',
			success: function(response) {
			    if(response.status == "OK") {
				var resulthtml = response.data_row;
				var responsehtml = '';
				//$(".total_posts").html(resulthtml.length+' posts found, <a style="color: #1652f0;" href="/tags/'+tagname+'">#'+tagname+'</a>');
				for(i=0;i<resulthtml.length;i++) {

				    var currentPostNumber = i;
				    var currentLikesDivElement = 'postLike_' + i;

			
				    var username = resulthtml[i]['username'];
				    var created_at = resulthtml[i]['created_at'];
				    var category = resulthtml[i]['category'];
				    var permlink = resulthtml[i]['permlink'];
				    var metatags =  resulthtml[i]['metatags'];
				    var title =   resulthtml[i]['title'];
				    var exturl =   resulthtml[i]['exturl'];

				    var thumbnail = '<img src="' + resulthtml[i]['thumbnail'] + '" alt="' + title + '" class="card-img-top img-fluid">';

				    steem.api.getContent(username , permlink, function(err, res) {
					
					let title = res.title;
					let created = res.created;
					let created_time = moment.utc(created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
					let author = res.author;
					let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
					



					    responsehtml += '<div class="col-lg-4 col-md-6 postsMainDiv mainDiv'+ currentLikesDivElement +'" postLikes="0" postNumber="'+ currentPostNumber +'">\n' +
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
					    '<h5><a href="#">' + username + '</a><div class="time">' + created_time + '</div></h5>\n' +
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
					    '<div class="post-thumb"><a class="post_detail" data-toggle="modal" data-target="#postModal" data-permlink="' + permlink + '" data-author="' + username + '">' + thumbnail + '</a></div>\n' + 
					    '\n' +
					    '<div class="post-contnet-wrap">\n' +
					    '\n' +
					    '<h4 class="post-title"><a href="' + exturl + '" target="_blank">' + title + '</a></h4>\n' +
					    '\n' +
					    '<p class="post-entry post-tags">' + metatags + '</p>\n' +
					    '\n' +
					    '<div class="post-footer">\n' +
					    '<div class="post-author-block">\n' +
					    '<div class="author-info"><i class="fas fa-dollar-sign"></i><span>&nbsp;' + res.pending_payout_value.substr(0, 4) + '</span> | <i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+permlink +username +'">0</span></div>\n' +
					    '</div>\n' +
					    '<div class="post-comments"><a id="status_icon'+permlink +username +'" onclick="return openmodal_popup(this)" class="showcursor" data-permlink="' + permlink + '" data-author="' + username + '" data-category="' + category + '"><i class="fas fa-check-circle" id="post_status'+permlink +username +'"></i></a><span>&nbsp; | &nbsp;<a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + permlink + '" data-author="' + username + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+permlink +username +'"></i></a><span>&nbsp; | ' + res.active_votes.length + ' Votes</span></div>\n' +
					    '</div>\n' +
					    '</div>\n' +
				    '</article></div>';

				    
				    });
				    
				    
				}
				
				$("#contentposts").html(responsehtml);
			    }
			}
			});

		});

</script>
