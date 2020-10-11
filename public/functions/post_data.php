<?php $user_profile_pic=preg_replace("(^https?:)", "", $user_profile_pic);$imgUrl = preg_replace("/^http:/i", "https:", $imgUrl);
if(!$user_profile_pic){$user_profile_pic="https://i.postimg.cc/rwbTkssy/dlike-user-profile.png";}
?>
<article class="post-style-two">
<div class="post-contnet-wrap-top"><div class="post-footer"><div class="post-author-block">
<div><?php echo '<a href="/profile/'. $author.'"><img src="'.$user_profile_pic.'" alt="'.$author.'"  class="img-fluid my_img"></a>'; ?></div>
<div class="author-info"><h5><?php echo '<a href="/profile/'. $author.'">'. $author.'</a>'; ?><div class="time"><?php echo time_ago($post_time); ?></div></h5> </div></div>
<div class="post-catg"><?php echo '<a href="/category/'. $category.'"><span class="post-meta">'. ucfirst($category).'</span></a>'; ?></div>
</div></div>
<div class="post-thumb img-fluid"><?php echo '<a href="/post/'.$author.'/'.$permlink.'"><img src=' . $imgUrl . ' class="card-img-top" /></a>'; ?></a></div>
<div class="post-contnet-wrap post_bottom">
<h4 class="post-title single_title"><?php echo '<a href="/post/'.$author.'/'.$permlink.'">'.$title.'</a>'; ?></h4>
<p class="post-entry post-tags"><?php echo $tags; ?></p>
<div class="post-comments bottom_block">
<div><img src="/images/post/dlike-hover.png" class="hov_vote" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>"> | <span id="post_likes" class="post_likes<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $postLikes; ?></span>LIKES</div>
<div><span class="dlike_tokens<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $post_income; ?></span> <b>DLIKE</b></div>
</div></article>