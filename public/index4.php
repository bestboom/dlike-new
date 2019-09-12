<?php include('template/header5.php');


$sql = "SELECT sp.img_link,sp.title FROM featuredposts as sp order by sp.id DESC limit 10";
$result = $conn->query($sql);
$featuredposts_html = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $featuredposts_html .= '<div><div class="testimonial-block post_block"><img src="'.$row['img_link'].'" class="card-img-top img-fluid" style="margin: 0 !important;"><div class="shadow_bottom"><a class="post_title">'.$row['title'].'</a></div></div></div>';
    }
}

$sql = "SELECT sp.json_metadata FROM steemposts";
$result = $conn->query($sql);
$featuredposts_html = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $json_data = json_decode($row['json_metadata'],true);
        $category_array[] = $json_data['category'];
    }
}
$main_categories = array_values(array_unique($category_array));



$posttags = "SELECT tagname, count(*) FROM posttags WHERE updated_at > DATE_SUB( NOW(), INTERVAL 24 HOUR) Group by tagname order by count(*) DESC Limit 10";
    $posttags_r = $conn->query($posttags);
    if ($posttags_r->num_rows > 0) {
        $trending_html = '';
        $counter = 0; 
            while($row = $posttags_r->fetch_assoc()) {
                if (strpos($row['tagname'], 'dlike') === false && $counter < 12) {
                    $trending_html .= '<a class="nav-item nav-link" href="/tags/'.$row['tagname'].'" role="tab" data-toggle="tab">'.strtoupper($row['tagname']).'&nbsp;<button type="button" class="close closeBtn" aria-label="Close"><span aria-hidden="true"></span></button></a>';
                    ++$counter;
                }  
            }
} else {
    $trending_html = '';
}



?>
    </div><!-- sub-header -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <div class="latest-post-section"  style="padding-top: 40px !important;padding-bottom: 20px !important;">
        <div class="container">
            <div class="row" style="background:  #f3f4f5;padding-top: 31px;margin-bottom: 20px;">

                <div class="col-lg-12 col-md-12 " style="margin-bottom: 10px">
                    <div class="p-0">
                        <div class="container p-0">
                            <div class="row">
                                <div class="w-100 p-3" style="padding-top: 0 !important;padding-bottom: 0 !important;">
                                </div>

                            </div>
                        </div>
                    </div><!-- testimonial-section -->
                </div>



                <div class="col-lg-12 col-md-12 " style="margin-bottom: 9px">
                    <div class="p-0">
                        <div class="container p-0">
                            <div class="row">
                                <div class="w-100 p-3" style="padding-top: 0 !important;padding-bottom: 0 !important;">
                                    <div class="scroller scroller-left-2 mt-2"><i class="fa fa-chevron-left"></i></div>
                                    <div class="scroller scroller-right-2 mt-2"><i class="fa fa-chevron-right"></i></div>
                                    <div class="wrapper">
                                        <nav class="nav nav-tabs list-2 mt-2" id="myTab" role="tablist">
                                            <a class="nav-item nav-link active" id="public-chat-tab" data-toggle="tab" href="#publicChat" role="tab" aria-controls="public" aria-expanded="true" style="font-weight: 900">Trending now ></a>

                                            <?php echo $trending_html;?>

                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- testimonial-section -->
                </div>

                <?php if($show_events == "yes") { echo $events_html;  } ?>

                
            </div>

        </div>

        <script>
            $(document).ready(function () {



                

                var hidWidth;
                var scrollBarWidths = 40;

                var widthOfList = function(){
                    var itemsWidth = 0;
                    $('.list a').each(function(){
                        var itemWidth = $(this).outerWidth();
                        itemsWidth+=itemWidth;
                    });
                    return itemsWidth;
                };

                var widthOfHidden = function(){
                    return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
                };

                var getLeftPosi = function(){
                    return $('.list').position().left;
                };

                var reAdjust = function(){
                    if (($('.wrapper').outerWidth()) < widthOfList()) {
                        $('.scroller-right').show().css('display', 'flex');
                    }
                    else {
                        //$('.scroller-right').hide();
                    }

                    if (getLeftPosi()<0) {
                        $('.scroller-left').show().css('display', 'flex');
                    }
                    else {
                        $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
                        //$('.scroller-left').hide();
                    }
                }

                reAdjust();

                $(window).on('resize',function(e){
                    reAdjust();
                });

                $('.scroller-right').click(function() {

                    $('.scroller-left').fadeIn('slow');
                    //$('.scroller-right').fadeOut('slow');
                    console.log(getLeftPosi());
                    if(getLeftPosi() < -672){
                        $('.scroller-right').fadeOut('slow');
                    }

                    $('.list').animate({left:"+="+"-112px"},'slow',function(){

                    });
                });

                $('.scroller-left').click(function() {

                    $('.scroller-right').fadeIn('slow');
                    $('.scroller-left').fadeOut('slow');

                    $('.list').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){

                    });
                });


                ////////////////

                var scrollBarWidths_2 = 40;

                var widthOfList_2 = function(){
                    var itemsWidth = 0;
                    $('.list-2 a').each(function(){
                        var itemWidth = $(this).outerWidth();
                        itemsWidth+=itemWidth;
                    });
                    return itemsWidth;
                };

                var widthOfHidden_2 = function(){
                    return (($('.wrapper').outerWidth())-widthOfList_2()-getLeftPosi_2())-scrollBarWidths_2;
                };

                var getLeftPosi_2 = function(){
                    return $('.list-2').position().left;
                };

                var reAdjust_2 = function(){
                    if (($('.wrapper').outerWidth()) < widthOfList_2()) {
                        $('.scroller-right-2').show().css('display', 'flex');
                    }
                    else {
                        //$('.scroller-right-2').hide();
                    }

                    if (getLeftPosi_2()<0) {
                        $('.scroller-left-2').show().css('display', 'flex');
                    }
                    else {
                        $('.item').animate({left:"-="+getLeftPosi_2()+"px"},'slow');
                        //$('.scroller-left').hide();
                    }
                }

                reAdjust_2();

                $(window).on('resize',function(e){
                    reAdjust_2();
                });

                $('.scroller-right-2').click(function() {

                    $('.scroller-left-2').fadeIn('slow');
                    //$('.scroller-right-2').fadeOut('slow');
                    console.log(getLeftPosi_2());
                    if(getLeftPosi_2() < -672){
                        $('.scroller-right-2').fadeOut('slow');
                    }

                    $('.list-2').animate({left:"+="+"-112px"},'slow',function(){

                    });
                });

                $('.scroller-left-2').click(function() {

                    $('.scroller-right-2').fadeIn('slow');
                    $('.scroller-left-2').fadeOut('slow');

                    $('.list-2').animate({left:"-="+getLeftPosi_2()+"px"},'slow',function(){

                    });
                });

                $(".search_btn_hover")
                    .on( "mouseenter", function() {
                        $(this).css("background", "#171F24");
                        $(".fa-user").css("color", "white");
                    })
                    .on("mouseleave", function () {
                        $(this).css("background", "white");
                        $(".fa-user").css("color", "black");
                    });

                $(".edit_btn_hover")
                    .on( "mouseenter", function() {
                        $(this).css("background", "#171F24");
                        $(".fa-pencil-alt").css("color", "white");
                    })
                    .on("mouseleave", function () {
                        $(this).css("background", "white");
                        $(".fa-pencil-alt").css("color", "black");
                    });
                
                $("#btn_share").click(function () {
                    window.location.href="/share.php";
                })

                setTimeout(function () {

                    $(".slick-next").hover(function () {
                        $(this).css("background", "#303030");
                    })

                    $(".slick-prev").hover(function () {
                        $(this).css("background", "#303030");
                    })

                    $(".testimonials-wrap")
                        .on( "mouseenter", function() {
                            $(this).css("opacity", "0.8");
                        })
                        .on("mouseleave", function () {
                            $(this).css("opacity", "1");

                            $(".slick-next").css("background", "transparent");
                            $(".slick-prev").css("background", "transparent");
                        });
                }, 2000);

                setInterval(function () {
                    $(".slick-next").click();
                }, 50000);

            });
        </script>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    </div>



    
<?php include('template/modals/modal.php'); ?>
<?php include('template/footer.php'); ?>

<style>
.showcursor{cursor:pointer;}
.defaultcoloruser{color:gray;}
</style>
<script>
$(document).ready(function(){
	    
    var show_category=$('#show_category');
    var c_username = $('#c_username').val();


    show_category.click(function(){
	    //var p_username = $("#pu_username").val();
	    var category_html = '<div class="col-sm-12" style="display:block;overflow:hidden;">';
        var category_value = '';
        <?php foreach($main_categories as $category) { ?>
            category_value = '<?php echo $category;?>';
            category_html += '<div class="col-sm-3"><label><input type="checkbox" name="user_category[]" value="'+category_value+'"/> '+category_value+'</label></div>';
        <?php } ?>
        category_html += '<a href="javascript:" onclick="return call_save_category()" class="btn btn-primary">Save</a></div>';
        
	    $("#categoryStatusModal").modal('show');
        $("#categoryStatusModal div.modal-body").append(category_html);
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
            console.log(i);
            if(i==91){
                $("#loader").hide();
            }
            
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
				let metatags = dlikeTags.map(function (meta) { if (meta) return '<a href="/tags/'+meta+'"> #' + meta + ' </a>' });
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
				var adduserhtml = "";
				var addfeaturedhtml = "";
				var addposthtml = "";
				if(c_username == "dlike" || c_username == "chirag-im") {
					
					
					addfeaturedhtml += '<a id="featuredstatus_icon'+$post.permlink +$post.author +'" onclick="return openfeaturedmodal_popup(this)" class="showcursor" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '" data-imgurl="' + img.src + '" data-title="' + $post.title + '" data-category="' + category + '"><i class="fa fa-plus" id="featuredpost_status'+$post.permlink +$post.author +'"></i></a><span>&nbsp; | &nbsp;';
					addposthtml = '<a id="status_icon'+$post.permlink +$post.author +'" onclick="return openmodal_popup(this)" class="showcursor" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '" data-category="' + category + '"><i class="fas fa-check-circle" id="post_status'+$post.permlink +$post.author +'"></i></a><span>&nbsp; ';
				}
				var mylabel = $post.permlink +$post.author;
				var newValue = mylabel.replace('.', '');
		
				adduserhtml += '<a style="color:gray;" class="userstatus_icon'+newValue+' showcursor" onclick="return openuser_popup(this)" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '" data-category="' + category + '"><i class="fa fa-check-circle" class="user_status'+newValue +'"></i></a>';
				
				
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
					'<h5><a href="#">' + $post.author + "&nbsp;" +adduserhtml +'</a><div class="time">' + activeDate + '</div></h5>\n' +
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
					'<div class="post-comments">'+addfeaturedhtml+addposthtml+'| &nbsp;<a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+$post.permlink +$post.author +'"></i></a><span>&nbsp; | ' + $post.active_votes.length + ' Votes</span></div>\n' +
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

</script>