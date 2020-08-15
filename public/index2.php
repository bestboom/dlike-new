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
    .trending_hr{margin: 0rem;border-top: 1px solid rgb(0 0 0 / 18%);}
</style>
</div>
<div class="latest-post-section"><div class="container">
<div class="row main_top"><?php include('/functions/top_trending.php');?></div>
<div class="row">
<?php $sql_T = $conn->query("SELECT * FROM dlikeposts ORDER BY created_at DESC LIMIT 60");
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
<div class="col-lg-4 col-md-6 postsMainDiv"><div class="post-style-two">
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
</div></div> <?php } } ?> 
</div>
<center><a href="/posts/2"><button class="btn btn-danger">Load More</button></a></center>
</div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/dlike_footer.php'); ?>
<script>
$(document).ready(function () {
var l;var r=40;var t=function(){var r=0;$(".list-2 a").l(function(){var l=$(this).outerWidth();r+=l});return r};var e=function(){return $(".wrapper").outerWidth()-t()-i()-r};var i=function(){return $(".list-2").position().left};var o=function(){if($(".wrapper").outerWidth()<t()){$(".scroller-right-2").show().t("display","flex")}else{}if(i()<0){$(".scroller-left-2").show().t("display","flex")}else{$(".item").animate({left:"-="+i()+"px"},"slow")}};o();$(window).i("resize",function(l){o()});$(".scroller-right-2").click(function(){$(".scroller-left-2").o("slow");if(i()<-672){$(".scroller-right-2").s("slow")}$(".list-2").animate({left:"+="+"-112px"},"slow",function(){})});$(".scroller-left-2").click(function(){$(".scroller-right-2").o("slow");$(".scroller-left-2").s("slow");$(".list-2").animate({left:"-="+i()+"px"},"slow",function(){})});
});
 </script>