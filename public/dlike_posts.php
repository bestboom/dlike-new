<?php include ('template/header.php'); ?></div>
<div class="latest-post-section"><div class="container">
<div class="row main_top"><?php include('functions/top_trending.php');?></div>
<div class="row">
<?php $currentPage = $_GET['page']; if(!$currentPage) { $currentPage = 1; } else{$currentPage = $currentPage;}
$posts_per_page =60;$offset = ($currentPage - 1) * $posts_per_page; $next_page=$currentPage + 1;
$sql_T = $conn->query("SELECT * FROM dlikeposts ORDER BY created_at DESC LIMIT $offset, $posts_per_page");
if ($sql_T && $sql_T->num_rows > 0){  while ($row_T = $sql_T->fetch_assoc()){
    $imgUrl = $row_T["img_url"];$author = $row_T["username"];
    $post_time = strtotime($row_T["created_at"]);$title = $row_T["title"];$permlink = $row_T["permlink"];
    $post_tags = trim($row_T["tags"]);$tags = preg_replace('/(\w+)/', '<a href="https://dlike.io/tags/$1">#$1</a>', $post_tags); 
    $sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$author'");
    if ($sql_W && $sql_W->num_rows>0){$row_W = $sql_W->fetch_assoc();$user_profile_pic=$row_W["profile_pic"];}
    $checkLikes= $conn->query("SELECT * FROM postslikes WHERE author = '$author' and permlink = '$permlink'");
    if ($checkLikes->num_rows > 0){$row_L = $checkLikes->fetch_assoc();$postLikes = $row_L['likes'];}else{$postLikes = '0';}$post_income = $postLikes * $post_reward; ?>
<div class="col-lg-4 col-md-6 postsMainDiv"><?php include('functions/post_data.php');?></div> <?php } } ?>
</div><center><a href="/posts/<?php echo $next_page; ?>"><button class="btn btn-danger">Load More</button></a></center></div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/footer.php'); ?>