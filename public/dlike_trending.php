<?php include ('template/header7.php'); ?>
</div>
<div class="latest-post-section"><div class="container">
<div class="row main_top"><?php include('functions/top_trending.php');?></div>
<div class="row">
<?php $topLikes= $conn->query("SELECT * FROM postslikes Where update_time > now() - INTERVAL 24 HOUR ORDER BY likes DESC LIMIT 30");
if ($topLikes && $topLikes->num_rows > 0){  while ($row_TL = $topLikes->fetch_assoc()){
    $author_tl = $row_TL["author"];$permlink_tl = $row_TL["permlink"];
    $sql_T = $conn->query("SELECT * FROM dlikeposts WHERE username='$author_tl' and permlink='$permlink_tl'");
    $row_T = $sql_T->fetch_assoc();
    $imgUrl = $row_T["img_url"];$author = $row_T["username"];$title = $row_T["title"];
    $post_time = strtotime($row_T["created_at"]);$permlink = $row_T["permlink"];$category=$row_T["ctegory"];
    $post_tags = $row_T["tags"];$post_hash_tags = preg_replace('/(\w+)/', '#$1', $post_tags);
    $sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$author'");
    if ($sql_W && $sql_W->num_rows > 0){$row_W = $sql_W->fetch_assoc();$user_profile_pic=$row_W["profile_pic"];}
    $checkLikes= $conn->query("SELECT * FROM postslikes WHERE author = '$author' and permlink = '$permlink'");
    if ($checkLikes->num_rows > 0){$row_L = $checkLikes->fetch_assoc();$postLikes = $row_L['likes'];}else{$postLikes = '0';}$post_income = $postLikes * $post_reward; ?>
<div class="col-lg-4 col-md-6 postsMainDiv"><?php include('functions/post_data.php');?></div> 
<?php } } ?>
</div></div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/dlike_footer.php'); ?>