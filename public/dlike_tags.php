<?php if (isset($_GET['tag'])) {$page_tag = $_GET['tag'];} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}
include ('template/header.php'); ?></div>
<div class="latest-post-section"><div class="container">
<div class="row main_top"><?php include('functions/top_trending.php');?></div>
<div class="row">
<?php $sql_P = $conn->query("SELECT * FROM dlike_tags where tag='$page_tag' ORDER BY created_time DESC");
if ($sql_P && $sql_P->num_rows > 0)
{   while ($row_P = $sql_P->fetch_assoc())
    {   $post_author = $row_P["author"];$permlink = $row_P["permlink"];
    	$sql_T = $conn->query("SELECT * FROM dlikeposts where username='$post_author' and permlink='$permlink'");
		$row_T = $sql_T->fetch_assoc();
        $imgUrl = $row_T["img_url"];$author = $row_T["username"];$title = $row_T["title"];
        $post_time = strtotime($row_T["created_at"]);$category=$row_T["ctegory"];$post_tags = trim($row_T["tags"]);$tags = preg_replace('/(\w+)/', '<a href="https://dlike.io/tags/$1">#$1</a>', $post_tags);
        $sql_W=$conn->query("SELECT * FROM dlikeaccounts where username = '$author'");
        if($sql_W && $sql_W->num_rows>0){$row_W=$sql_W->fetch_assoc();$user_profile_pic=$row_W["profile_pic"];}
        $checkLikes=$conn->query("SELECT * FROM postslikes WHERE author='$author' and permlink = '$permlink'");
        if ($checkLikes->num_rows > 0){$row_L = $checkLikes->fetch_assoc();$postLikes = $row_L['likes'];}else{$postLikes = '0';}$post_income = $postLikes * $post_reward; ?>
<div class="col-lg-4 col-md-6 postsMainDiv"><?php include('functions/post_data.php');?></div>
<?php } } ?>
</div></div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/footer.php'); ?>