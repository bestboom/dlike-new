<?php include('includes/config.php');
$link = $_GET['link']; $user = $_GET['user']; $auth = str_replace('@', '', $user);
if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])) { $sender =  $_COOKIE['username']; } else {$sender='';}
$post_url = "https://steemapi.dlkapps.ml/get_content?author={$auth}&permlink={$link}";
$response = file_get_contents($post_url);
$result = json_decode($response);
$og_title = $result->title;

$meta_data = json_decode($result->json_metadata);
$og_image = $meta_data->image;

$new_body = $meta_data->body;
$og_description = strip_tags($new_body);
$og_description = implode(' ', array_slice(explode(' ', $og_description), 0, 23));
$ext_link = $meta_data->url;
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$uri = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$og_url = $uri;

include('template/header.php');
//$body_post = $new_body;
//$body_text = preg_replace("/<p[^>]*>(?:\s|&nbsp;)*<\/p>/", '', $body_post);
$body_text = preg_replace('#<p>&nbsp;</p>#i','<p></p>', $new_body);


//tip total income
$post_inc = "SELECT SUM(tip1) As post_inc, SUM(tip2) As post_inc2 FROM tiptop where permlink = '$link' and receiver = '$auth'";
$result_inc = $conn->query($post_inc);
if ($result_inc->num_rows > 0) 
{
    $rowinc = mysqli_fetch_assoc($result_inc);
    $postincome = number_format($rowinc["post_inc"],3);
    $totalpostincome = round($postincome,3);
} else { $postincome = '0.00'; }

//check pro user
$sqlp = "SELECT * FROM prousers where username='$sender'";
$resultp = $conn->query($sqlp);
if ($resultp->num_rows > 0) {echo "<script>let thisuser = 'PRO';</script>";} else{echo "<script>let thisuser = '';</script>";}

$sql_status = "SELECT * FROM userstatus where username = '$sender'";
$result_status = $conn->query($sql_status);
if ($result_status->num_rows > 0 ) 
{ 
    $row_status = $result_status->fetch_assoc();
    $user_status = $row_status['status'];
    if($user_status = '3' )
    { 
        $sender_status = "PRO";
    } 
    else 
    { 
        $sender_status = "Not PRO";
    }
} 
else 
{ $sender_status = "NOT PRO";}  


?>
</div>
<style>
    body {background: #f4f4f4;}
    .single-post-block > h1 {font-family: medium-content-sans-serif-font, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Arial, sans-serif;letter-spacing: -0.022em;}
    .main_post > p {font-family: medium-content-serif-font, Georgia, Cambria, "Times New Roman", Times, serif;font-weight: 400;font-size: 18px;color: rgba(0, 0, 0, 0.84);letter-spacing: -0.004em;line-height: 1.58;font-style: normal;margin-top: 0.86em;}
    .image_resized {width: 100% !important;max-width: 100% !important;min-width: 100% !important;}
    .main_post > figure > img {width: 100% !important;max-width: 100% !important;min-width: 100% !important;}
    .main_post h1, h2, h3, h4, h5, h6 {font-family: medium-content-sans-serif-font, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Arial, sans-serif;font-weight: 600;color: rgba(0, 0, 0, 0.84);letter-spacing: -0.033em;line-height: 1.3;}
    .main_post h3 {font-size: 21px;}
    .main_post h2 {font-size: 25px;}
    .main_post h1 {font-size: 30px;}
    .main_post a {text-decoration: underline;color: #c51d24;;font-weight: lighter !important;font-size:17px;}
</style>
<div class="container" style="padding-top: 60px;background: #fff;border: 1px solid #eee;">
<div class="row"><div class="col-md-12">
<div class="container"><div class="row"><div class="col">
<div class="blog-details-wrapper"><div class="single-post-block" style="width: 100%;max-width: 100%;">
<h1 class="post-title"><a href="<?php echo $og_url; ?>"><?php echo $og_title; ?></a></h1>
<div class="details-post-meta-block-top"><div class="container">
<div class="row" style="justify-content: space-between;margin: 3px;">
    <div class="col-lg-3 col-md-4 col-sm-4 auth_info">
        <div class="post-author-block" style="display: flex;align-items: center;">
            <div class="author-thumb">
                <a href="#" class="author-thumb-link"><img src="" alt="img" class="mod-authThumb"></a>
            </div>
            <div class="author-info">
                <h5> <a href="#" class="mod-auth" style="padding: 10px;"></a></h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-5 auth_info">
        <div class="post-share-block">
            <a class="up_steem"><i class="fas fa-chevron-circle-up" id="steem_vote_icon"></i></a>&nbsp;| $<span class="pending_payout">0.00</span><b> + </b><span id="se_token" data-popover="true" data-html="true" data-content=""><span id="pending_dliker"></span></span> DLIKER
        </div><!-- post-views-block -->
    </div>
</div>
<div class="post-thumb-block"></div>                          
<span class="main_post post-entry"><?php echo $body_text; ?></span>
<p class="post_link"><a href="<?php echo $ext_link; ?>" target="_blank">Source of shared link</a></p>
</div></div>
</div></div></div></div>

<div class="details-post-meta-block"><div class="container"><div class="row"><div class="col"><div class="details-post-meta-block-wrap">
<div class="post-tag-block"><h5>Post Tag</h5><div class="tags mod-tags"></div></div>
<div class="post-share-block"><h5>Share this</h5><ul class="social-share-list"></ul></div>
</div></div></div></div></div>
</div>
</div></div>

<div class="container" style="background: #fff;"><div class="row"><div class="col"><div class="post-comment-block">
<div class="comment-respond"><h4>Leave A Comment</h4><div class="row"><div class="col-md-12"><div class="form-group"><textarea placeholder="Comment" class="form-control cmt" name="cmt_body"></textarea></div></div></div><button class="btn btn-default comt_bt">Comment</button><br><br>
<div class="comt_ads"><iframe data-aa="1318357" src="//ad.a-ads.com/1318357?size=336x280" scrolling="no" style="width:336px; height:280px; border:0px; padding:0; overflow:hidden" allowtransparency="true"></iframe></div></div>
<div class="comment-area"><h4>Comments</h4><ul class="comments cmt_section" id="comment_sec"></ul></div>
</div></div></div></div></div>

<div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm" role="document"><div class="modal-content mybody"> <?php include('template/modals/recomend.php'); ?></div></div></div>
<div class="modal fade" id="prouser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom"> <?php include('template/modals/prouser.php'); ?></div></div></div>
<div class="modal fade" id="upvoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm" role="document"><div class="modal-content mybody"> <?php include('template/modals/upvotemodal.php'); ?></div></div></div>
<script type="text/javascript">let post_author = '<?php echo $auth; ?>';let post_permlink = '<?php echo $link; ?>';</script>                  
<?php include('template/footer.php'); $conn->close(); ?>