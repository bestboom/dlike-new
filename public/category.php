<?php include('template/header2.php');  ?>
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
	    <div class="row  align-items-center h-100 myloader" style="margin-bottom:30px;">
                <div class="row col-md-3 justify-content-center">
                        <h4 class="lab_post"><?php echo $_GET['cat'];?></h4>
                </div>
                <div class="col-md-9 lay">&nbsp;</div>
            </div>
	    <div id="loader">Loading</div>
	    <div class="row" id="contentposts">
	    </div>
	</div>
    </div>

<div class="modal fade" id="upvoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content mybody">
            <?php include('template/modals/upvotemodal.php'); ?>
        </div>
    </div>
</div> 
<?php include('template/footer2.php'); ?>
<style>
.showcursor{cursor:pointer;}
</style>
<script>

    	$(document).ready(function(){
			
		$("#loader").show();
		
      
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
					    '<h5><a href="#">' + username + '</a><div class="time" id="articletime_'+permlink+'">'+timstamp+'</div></h5>\n' +
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
					    '<div class="post-comments"><a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + permlink + '" data-author="' + username + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+permlink +username +'"></i></a><span class="active_votes">&nbsp; |  Votes</span></div>\n' +
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
					let posttags = dlikeTags.map(function (meta) { if (meta) return '<a href="#">' + meta + ' </a>' });
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
				    
				    
				    
				});
				   
				    
				    
				    
				}
				$("#loader").hide();
				$(".myloader").css('display','flex');
				
				
			    }
			}
			});

		});

</script>
