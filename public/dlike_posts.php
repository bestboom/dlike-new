<?php include ('template/header7.php'); ?>
<style>
    .latest-post-section{min-height:80vh;padding: 70px 0px 60px 0px;}
    .hov_vote{cursor:pointer;width: 21px;height: 21px;margin-top:-3px;}
    #post_likes{padding-right: 3px;font-weight: bold;padding-left: 3px;}
    .bottom_block{width:100%}
    .post-style-two .post-contnet-wrap-top{padding: 5px 10px 5px 10px;}
    .post-style-two .author-info h5{padding-top: 6px;line-height: 1em;}
    .post_bottom{padding: 15px 15px 10px !important;}
    .col-lg-4.col-md-6.postsMainDiv > .post-style-two{margin-bottom: 40px !important;}
    .post-tags{padding-bottom: 5px !important;margin-bottom: 5px !important;}
    .main_top{margin: 5px;font-weight: 600;justify-content: space-between;color: #c51d24;}
</style>
</div>
<div class="latest-post-section"><div class="container">
<div class="row main_top"><div><span><i class="fa fa-home"></i>&nbsp;Latest</span><span style="padding-left: 15px;"><i class="fa fa-bolt"></i>&nbsp;Trending</span></div><div>STEEM Posts</div></div>
<hr style="margin: 0rem;border-top: 1px solid rgb(0 0 0 / 18%);">
<?php $posttags = $conn->query("SELECT * FROM dlike_trending_tags order by count DESC Limit 10");
if ($posttags->num_rows > 0) {while($row = $posttags->fetch_assoc()) {
    $trending_html .='<a class="nav-item nav-link" href="/tags/'.$row['tag'].'">'.strtoupper($row['tag']).'</a>';}
} else { $trending_html = '';} ?>
<div class="col-lg-12 col-md-12 " style="margin-bottom: 14px">
<div class="p-0"><div class="container p-0"><div class="row"><div class="w-100 p-3" style="padding:0 !important;">
    <div class="scroller scroller-left-2 mt-2"><i class="fa fa-chevron-left"></i></div>
    <div class="scroller scroller-right-2 mt-2"><i class="fa fa-chevron-right"></i></div>
    <div class="wrapper"><nav class="nav nav-tabs list-2 mt-2" id="myTab" role="tablist">
    <a class="nav-item nav-link active" id="public-chat-tab" data-toggle="tab" href="#" role="tab" aria-controls="public" aria-expanded="true" style="font-weight: 900">Trending now ></a><?php echo $trending_html;?></nav></div>
</div></div></div></div></div>
<div class="row">
<?php
echo $currentPage = $_GET['page']; if(!$currentPage) { $currentPage = 1; } else{$currentPage = $currentPage;}
$posts_per_page = 4;echo $offset = ($currentPage - 1) * $posts_per_page;
//$sql_T = $conn->query("SELECT * FROM dlikeposts ORDER BY created_at DESC LIMIT '$offset.', '.$posts_per_page");
$sql_T = $conn->query("SELECT * FROM dlikeposts ORDER BY created_at DESC LIMIT 4, 5");
if ($sql_T && $sql_T->num_rows > 0){  while ($row_T = $sql_T->fetch_assoc()){
    $imgUrl = $row_T["img_url"];$author = $row_T["username"];
    $post_time = strtotime($row_T["created_at"]);$title = $row_T["title"];
    $post_tags = $row_T["tags"];$permlink = $row_T["permlink"];
    $post_hash_tags = preg_replace('/(\w+)/', '#$1', $post_tags);
    $sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$author'");
    if ($sql_W && $sql_W->num_rows > 0){  $row_W = $sql_W->fetch_assoc();$profile_pic = $row_W["profile_pic"];
        if (!empty($profile_pic)) { $user_profile_pic = $profile_pic; } else { $user_profile_pic = 'https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';}
    }
    $checkLikes= $conn->query("SELECT * FROM postslikes WHERE author = '$author' and permlink = '$permlink'");
    if ($checkLikes->num_rows > 0){$row_L = $checkLikes->fetch_assoc();$postLikes = $row_L['likes'];}else{$postLikes = '0';}$post_income = $postLikes * $post_reward; ?>
<div class="col-lg-4 col-md-6 postsMainDiv"><article class="post-style-two">
    <div class="post-contnet-wrap-top"><div class="post-footer"><div class="post-author-block">
    <div class="author-thumb"><?php echo '<a href="/profile/'. $author.'"><img src="'.$user_profile_pic.'" alt="'.$row_T['username'].'" class="img-responsive"></a>'; ?></div>
    <div class="author-info"><h5><?php echo '<a href="/profile/'. $author.'">'. $author.'</a>'; ?><div class="time"><?php echo time_ago($post_time); ?></div></h5> </div></div>
    <div class="post-catg"><a href="/category/"><span class="post-meta"><?php echo ucfirst($row_T["ctegory"]); ?></span></a></div>
    </div></div>
    <div class="post-thumb img-fluid"><?php echo '<a href="/post/'.$author.'/'.$permlink.'"><img src=' . $imgUrl . ' class="card-img-top" /></a>'; ?></a></div>
    <div class="post-contnet-wrap post_bottom">
    <h4 class="post-title"><?php echo '<a href="/post/'.$author.'/'.$permlink.'">'.$title.'</a>'; ?></h4>
    <p class="post-entry post-tags"><?php echo $post_hash_tags; ?></p>
    <div class="post-comments bottom_block">
        <div><img src="./images/post/dlike-hover.png" class="hov_vote" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>"> | <span id="post_likes" class="post_likes<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $postLikes; ?></span>LIKES</div>
        <div><span class="dlike_tokens<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $post_income; ?></span> <b>DLIKE</b></div>
    </div>
</article></div>
<?php } } ?> 
</div></div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/dlike_footer.php'); ?>
<script type="text/javascript">
    $('.hov_vote').click(function() {
        if (dlike_username != null) {
            var mypermlink = $(this).attr("data-permlink");
            var authorname = $(this).attr("data-author");
            $(this).addClass('fas fa-spinner fa-spin like_loader');
            var update = '1';
            $.ajax({ type: "POST",url: "/helper/solve.php", data: {ath: authorname, plink: mypermlink},
                success: function(data) {
                    try { var response = JSON.parse(data)
                        if (response.done == true) {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');$('#upvotefail').modal('show');return false;
                        } else if (response.error == true) {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');toastr.error(response.message);return false;
                        } else {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');
                            toastr.success(response.message);
                            var getpostlikes = $(".post_likes" + mypermlink + authorname).html();
                            var post_income = response.post_income;
                            var newlikes = parseInt(getpostlikes) + parseInt(update);
                            var updatespostincome = (newlikes * post_income).toFixed(2); 
                            $('.post_likes' + mypermlink + authorname).html(newlikes);
                            $('.dlike_tokens' + mypermlink + authorname).html(updatespostincome);
                        }
                    } catch (err) {toastr.error('Sorry. Server response is malformed.');}
                }
            });
        } else {toastr.error('You must be login with DLIKE username!');return false;}
    });
</script>



<script>
$(document).ready(function () {
    var hidWidth;var scrollBarWidths_2 = 40;
    var widthOfList_2 = function(){var itemsWidth = 0;
        $('.list-2 a').each(function(){var itemWidth = $(this).outerWidth();itemsWidth+=itemWidth;});
        return itemsWidth;
    };
    var widthOfHidden_2 = function(){return (($('.wrapper').outerWidth())-widthOfList_2()-getLeftPosi_2())-scrollBarWidths_2;};
    var getLeftPosi_2 = function(){return $('.list-2').position().left;};
    var reAdjust_2 = function(){
        if (($('.wrapper').outerWidth()) < widthOfList_2()) {$('.scroller-right-2').show().css('display', 'flex');
        }else {//$('.scroller-right-2').hide();
        }
        if (getLeftPosi_2()<0) {$('.scroller-left-2').show().css('display', 'flex');
        }else {$('.item').animate({left:"-="+getLeftPosi_2()+"px"},'slow');
        }
    }
    reAdjust_2();
    $(window).on('resize',function(e){reAdjust_2();});
    $('.scroller-right-2').click(function() {$('.scroller-left-2').fadeIn('slow');
        if(getLeftPosi_2() < -672){$('.scroller-right-2').fadeOut('slow');}
        $('.list-2').animate({left:"+="+"-112px"},'slow',function(){});
    });
    $('.scroller-left-2').click(function() {
        $('.scroller-right-2').fadeIn('slow');$('.scroller-left-2').fadeOut('slow');
        $('.list-2').animate({left:"-="+getLeftPosi_2()+"px"},'slow',function(){});
    });
});
 </script>