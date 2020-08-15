<?php include ('template/header7.php'); ?>
</div>
<div class="row main_top"><?php include('functions/top_trending.php');?></div>
<div class="row">
<?php $topLikes= $conn->query("SELECT * FROM postslikes Where update_time > now() - INTERVAL 24 HOUR ORDER BY likes DESC LIMIT 30");
if ($topLikes && $topLikes->num_rows > 0){  while ($row_TL = $topLikes->fetch_assoc()){
    $author_tl = $row_TL["author"];$permlink_tl = $row_TL["permlink"];
    
    $sql_T = $conn->query("SELECT * FROM dlikeposts WHERE username='$author_tl' and permlink='$permlink_tl'");
    $row_T = $sql_T->fetch_assoc();
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