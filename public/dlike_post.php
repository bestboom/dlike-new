<?php $link = $_GET['link'];$user = $_GET['user'];
include('includes/config.php');
function limit_text($text, $limit) {if (str_word_count($text, 0) > $limit) {$words=str_word_count($text, 2);$pos=array_keys($words);$text=substr($text, 0, $pos[$limit]);}return $text;}
$sql_P = $conn->query("SELECT * FROM dlikeposts where username='$user' and  permlink='$link'");
if ($sql_P && $sql_P->num_rows > 0){ $row_P = $sql_P->fetch_assoc();
    $imgUrl = $row_P["img_url"];$post_time = strtotime($row_P["created_at"]);
    $permlink = $row_P["permlink"];$author = $row_P["username"];$title = $row_P["title"];
    $description = $row_P["description"];$post_category = $row_P["ctegory"];
    $post_tags = trim($row_P["tags"]);$tags = preg_replace('/(\w+)/', '<a href="https://dlike.io/tags/$1">#$1</a>', $post_tags); $ext_url = $row_P["ext_url"];$post_id = $row_P["id"];$pub_time=$row_P["created_at"];
}
$sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$user'");
$row_W = $sql_W->fetch_assoc(); $profile_pic = $row_W["profile_pic"];
$checkLikes = $conn->query("SELECT * FROM postslikes WHERE author = '$user' and permlink = '$link'");
if ($checkLikes->num_rows > 0){$row_L = $checkLikes->fetch_assoc();$postLikes = $row_L['likes'];}else{$postLikes = '0';}$post_income = $postLikes * $post_reward;
$urlData = parse_url($ext_url ); $host = preg_replace('/^www\./', '', $urlData['host']);
$og_title=strip_tags($title);$og_image=$imgUrl;$new_description=strip_tags($description);$og_description=limit_text($new_description , 30);$og_url="https://dlike.io/post/".$author."/".$permlink;$og_title_sc=str_replace('"', "'", $og_title);$og_description_sc=str_replace('"', "'", $og_description);
include('template/header.php');
?><style>.more_posts{font-size: 18px;font-weight: 700;padding-bottom: 15px;text-align: center;}.post-com-cat{color: #1652f0;}.read_more{float: right;color: #1652f0;font-size: 12px;}.auth_inf{margin-bottom: 0px;}</style></div>
<div class="latest-post-section"><div class="container">
    <article class="post-style-two post-full-width">
        <div class="post-thumb"><?php echo '<img src="'.$imgUrl.'" alt="'.$permlink.'" class="img-responsive">'; ?></div>
        <div class="post-contnet-wrap">
            <div class="post-footer">
                <div class="post-author-block">
                    <div><?php echo '<a href="/profile/'.$author.'"><img src="'.$profile_pic.'" alt="'.$author.'" class="img-fluid my_img"></a>'; ?></div>
                    <div class="author-info"><h5 class="auth_inf"><?php echo '<a href="/profile/'.$author.'">'.$author.'</a>'; ?></h5><span class="auth-time"><?php echo time_ago($post_time); ?></span>
                    </div>
                </div>
                <div class="post-comments post-com-cat"><?php echo '<a href="/category/'. $post_category.'">'.ucfirst($post_category).'</a>'; ?></div>
            </div>
            <h1 class="post-title"><?php echo $title; ?></h1>
            <p class="post-entry"><?php echo $description; ?><br><span class="read_more">Read more on: <?php echo '<a href="'.$ext_url .'" target="_blank">'.$host.'</a>'; ?></span></p>
            <p class="post-entry post-tags"><?php echo $tags; ?></p>
            <div class="post-footer">
                <div class="post-author-block"><div><img src="/images/post/dlike-hover.png" alt="DLIKE" class="hov_vote" data-permlink="<?php echo $permlink; ?>" data-author="<?php echo $author; ?>"> | <span id="post_likes" class="post_likes<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $postLikes; ?></span>LIKES</div></div>
                <div class="post-comments"><div><span class="dlike_tokens<?php echo $permlink; ?><?php echo $author; ?>"><?php echo $post_income; ?></span> <b>DLIKE</b></div></div>
            </div>
        </div>
    </article>
<div class="more_posts">More Like This</div>
<div class="row">
<?php $sql_T = $conn->query("SELECT * FROM dlikeposts where ctegory='$post_category' and id != '$post_id' ORDER BY created_at DESC LIMIT 9");
if ($sql_T && $sql_T->num_rows > 0)
{   while ($row_T = $sql_T->fetch_assoc())
    {   $imgUrl = $row_T["img_url"];$author = $row_T["username"];
        $post_time = strtotime($row_T["created_at"]);
        $permlink = $row_T["permlink"];$title = $row_T["title"];$category=$row_T["ctegory"];
        $post_tags = trim($row_T["tags"]);$tags = preg_replace('/(\w+)/', '<a href="https://dlike.io/tags/$1">#$1</a>', $post_tags); 
        $sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$author'");
        if ($sql_W && $sql_W->num_rows>0){$row_W=$sql_W->fetch_assoc();$user_profile_pic=$row_W["profile_pic"];}
        $checkLikes=$conn->query("SELECT * FROM postslikes WHERE author='$author' and permlink = '$permlink'");
        if ($checkLikes->num_rows > 0){$row_L = $checkLikes->fetch_assoc();$postLikes = $row_L['likes'];}else{$postLikes = '0';}$post_income = $postLikes * $post_reward; ?>
<div class="col-lg-4 col-md-6 postsMainDiv"><?php include('functions/post_data.php');?></div>
<?php } } ?>
</div></div></div>
<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"><?php include('template/modals/upvotefail.php'); ?></div></div></div>
<?php include ('template/footer.php'); ?>