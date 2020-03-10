<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$link = $_GET['link'];
$user = $_GET['user'];
$auth = str_replace('@', '', $user);
if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])) { $sender =  $_COOKIE['username']; } else {$sender='';}

$post_url = "https://tower.emrebeyler.me/api/v1/posts/?author=$auth&permlink=$link";
$response = file_get_contents($post_url);
$result = json_decode($response, TRUE);

$og_res = $result['results'][0];
$og_title = $og_res['title']; 

$body = $og_res['body'];
$body = explode("\n\n#####\n\n",$body);
$body = $body[1];
$body = str_replace(array('\'', '"'), '', $body); 
$og_description = strip_tags($body);
$og_description = implode(' ', array_slice(explode(' ', $og_description), 0, 23));

$meta_data = $result['results'][0]['json'];
$metadata = json_decode($meta_data, TRUE);
$og_image = $metadata['image'][0];
$ext_link = $metadata['url'];

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$uri = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$og_url = $uri;

include('template/header5.php');
//post body description
function removeTags($str) {  
    $str = preg_replace("#<(.*)/(.*)>#iUs", "", $str);
    return $str;
}
$body_text = $body;

$views = '1'; 
//post views
$sqlvs = "SELECT * FROM totalpostviews where permlink = '$link' and author = '$auth'";
$resultvs = $conn->query($sqlvs);
if ($resultvs->num_rows > 0) {
    $rowview = mysqli_fetch_assoc($resultvs); 
    $postviews = $rowview["totalviews"];

    $sqlvip = "SELECT * FROM postviews where permlink = '$link' and author = '$auth' and userip = '$ip'";
    $resultvip = $conn->query($sqlvip);
    if ($resultvip->num_rows > 0) { } else {
        $updatePostviews = "UPDATE TotalPostViews SET totalviews = '$postviews' + 1 WHERE author = '$auth' AND permlink = '$link'";
        $updatePostview = $conn->query($updatePostviews);
        $postviews = $postviews + '1';
        $sqlviewup = "INSERT INTO PostViews (author, permlink, views, userip, view_time)
        VALUES ('".$auth."', '".$link."', '".$views."', '".$ip."', '".date("Y-m-d h:m:s")."')";
        mysqli_query($conn, $sqlviewup);

    }
} else {
    $sqlview = "INSERT INTO totalpostviews (author, permlink, totalviews)
    VALUES ('".$auth."', '".$link."', '".$views."')";
    mysqli_query($conn, $sqlview); 
    $postviews = '1';  
} 

//tip total income
$post_inc = "SELECT SUM(tip1) As post_inc, SUM(tip2) As post_inc2 FROM tiptop where permlink = '$link' and receiver = '$auth'";
$result_inc = $conn->query($post_inc);
if ($result_inc->num_rows > 0) 
{
    $rowinc = mysqli_fetch_assoc($result_inc);
    $postincome = number_format($rowinc["post_inc"],3);
    //$postincome2 = number_format($rowinc["post_inc2"],3);
    //$totalpost = $postincome + $postincome2;
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
    .main_post > p {font-family: medium-content-serif-font, Georgia, Cambria, "Times New Roman", Times, serif;font-weight: 400;font-size: 18px;line-height: 1.53;color: rgba(0, 0, 0, 0.84);}
    .image_resized {width: 100% !important;max-width: 100% !important;min-width: 100% !important;}
    .main_post > figure > img {width: 100% !important;max-width: 100% !important;min-width: 100% !important;}
</style>
<div class="container" style="padding-top: 20px;background: #fff;border: 1px solid #eee;">
   <div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="blog-details-wrapper">
                        <div class="single-post-block" style="max-width: 100%;">
                            <center>
                                <iframe data-aa="1318371" src="//ad.a-ads.com/1318371?size=320x50" scrolling="no" style="width:320px; height:50px; border:0px; padding:0; overflow:hidden" allowtransparency="true"></iframe>
                            </center>
                            <br>
                            <h1 class="post-title mod-title"><a href="<?php echo $og_url; ?>"><?php echo $og_title; ?></a></h1>
                            <!--<h1><span class="mod-title"></span></h1>-->
                            <div class="details-post-meta-block-top">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 auth_info">
                                            <div class="post-author-block" style="display: flex;align-items: center;">
                                                <div class="author-thumb">
                                                    <a href="#" class="author-thumb-link"><img src="/images/post/authors/8.png" alt="img" class="mod-authThumb"></a>
                                                </div>
                                                <div class="author-info">
                                                    <h5> <a href="#" class="mod-auth" style="padding: 10px;"></a></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-4 auth_info">
                                            <div class="post-tag-block"><!-- post-likes-block -->
                                                <?php
                                                $sqlm = "SELECT likes FROM postslikes WHERE author = '$auth' and permlink = '$link'";
                                                $result_lk = $conn->query($sqlm);
                                                $row = mysqli_fetch_assoc($result_lk);
                                                if ($result_lk->num_rows > 0) { $likesofpost = $row["likes"]; } else { $likesofpost = '0';}

                                                $sqlv = "SELECT * FROM mylikes where permlink = '$link' and author = '$auth' and userip = '$ip'";
                                                $resultv = $conn->query($sqlv); 
                                                if ($resultv->num_rows > 0) { ?>
                                                    <div class="post-comments-mid">
                                                        <i class="fas fa-heart not-active"></i>&nbsp;&nbsp;<span id="tot_likes"><?php echo $likesofpost; ?></span> 
                                                    <? } else { ?>    
                                                        <div class="post-comments-mid"><span class="recomendation" id="up_vote" data-toggle="modal" data-target="#recomendModal" data-permlink="<?php echo $link; ?>" data-likes="<?php echo $likesofpost; ?>" data-author="<?php echo $auth; ?>">
                                                            <i class="fas fa-heart" id="vote_icon"></i></span>&nbsp;&nbsp;<span id="total_likes"><?php echo $likesofpost; ?></span> <? }?>
                                                        </div>                        
                                                    </div><!-- post-likes-block -->
                                                </div>
                                                <!-- post-views-block -->
                                                <div class="col-lg-1 col-md-2 col-sm-4 auth_info">
                                                    <div class="post-share-block">
                                                        <i class="fas fa-eye"></i>&nbsp;&nbsp;<?php echo $postviews; ?>
                                                    </div><!-- post-views-block -->
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-5 auth_info">
                                                    <div class="post-share-block">
                                                        <a class="up_steem"><i class="fas fa-chevron-circle-up" id="steem_vote_icon"></i></a>&nbsp;| $<span class="pending_payout">0.00</span><b> + </b><span id="se_token" data-popover="true" data-html="true" data-content=""><span id="pending_dliker"></span></span> DLIKER
                                                    </div><!-- post-views-block -->
                                                </div>
                                                <!-- post-income-block -->
                                                <div class="col-lg-3 col-md-5 col-sm-4 auth_info" style="">
                                                    <div class="post-share-block">
                                                        <i class="far fa-money-bill-alt"></i>&nbsp;&nbsp;$<?php echo $totalpostincome; ?>&nbsp;Tip<!--+(<?php //echo $postincome; ?> USDT  <?php //echo $postincome2; ?> DSC-->
                                                    </div>
                                                </div>
                                                <!-- post-income-block -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if(array_key_exists('type', $metadata)) {
                                            $type_text = $metadata['type'];
                                        
                                            if($type_text == 'story') {
                                                echo '<div class="post-thumb-block" style="display:none;"></div>';
                                            } else {
                                                echo '<div class="post-thumb-block"><img src="/images/post/8.png" alt="img" class="card-img-post img-fluid"></div>';
                                            }

                                        } else {
                                            echo '<div class="post-thumb-block"><img src="/images/post/8.png" alt="img" class="card-img-post img-fluid"></div>';
                                        }
                                    ?>
                                    
                                    <h3 class="post-title"></h3>
                                    <span class="main_post post-entry mod-post"><?php echo $body_text; ?></span>
                                    <p class="post_link"><a href="<?php echo $ext_link; ?>" target="_blank">Source of shared link</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div id="tip-msg"></div>
            <div class="details-post-meta-tip" style="background: #080e70;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <center><img src="/images/tips-dlike.png" alt="img" class="img-responsive"></center>
                        </div>
                        <div class="col-sm-5 mid-tip">
                            <h2 class="tipratio" style="font-size: 18px;line-height: 2;font-weight: 600;color: #fffffffc;">DLIKE pays to share Links <br>Start sharing to earn money Now!</h2>
                            <p class="tipthnk">You need to wait before you can TIP again.</p>
                        </div>
                        <div class="col-sm-4">
                            <?php
                            if(empty($_COOKIE['username']) && !isset($_COOKIE['username'])) { echo '<center><a href="/welcome"><button class="btn btn-danger">Login To Tip</button></a></center>'; $tiptime = '601';} else {
                                $verifysender = "SELECT * FROM tiptop where sender = '$sender'";
                                $result_sender = $conn->query($verifysender);
                                if ($result_sender->num_rows > 0) {
                                    $row_sender = $result_sender->fetch_assoc();   

                                    $verifytip = "SELECT * FROM tiptop where permlink = '$link' and receiver = '$auth' and sender = '$sender'";
                                    $resultvtip = $conn->query($verifytip);
                                    $rowvtip = $resultvtip->fetch_assoc(); 
                                    if ($resultvtip->num_rows > 0) 
                                    { 
                                        echo '<center><button class="btn btn-danger">You Already Tip This Post</button></center>';
                                        $tiptime = '0';
                                    } else {
                                        $verifytiptime = "SELECT TimeStampDiff(SECOND,tip_time,Now()) AS timed FROM tiptop where sender = '$sender' order by tip_time DESC limit 1";
                                        $resulttiptime = $conn->query($verifytiptime);
                                        $rowtiptime = $resulttiptime->fetch_assoc();
                                        if ($resulttiptime->num_rows > 0) 
                                        {
                                            $tiptime = $rowtiptime['timed']; 
                                            if($tiptime < 600) 
                                            {
                                                echo '<div id="countdown">
                                                <div class="btn"><span id="minutes">00</span><span style="float:center">:</span>
                                                <span id="seconds">00</span></div></div>'; 
                                                echo '<div id="aftercount" style="display: none;"><center><button class="btn btn-success">Ready To Tip Again</button></center></div>'; 
                                            }  else { ?>
                                                <form action="/helper/addtips.php" method="post" id="tipsubmit">
                                                    <input type="hidden" name="tipauthor" value="<?php echo $auth; ?>" />
                                                    <input type="hidden" name="tippermlink" value="<?php echo $link; ?>" />
                                                    <center><button class="btn btn-default btn-tip">TIP</button></center>
                                                </form> 
                                            <? }                
                                        }   
                                    }   
                                } else { $tiptime = '601'; ?>
                                    <form action="/helper/addtips.php" method="post" id="tipsubmit">
                                        <input type="hidden" name="tipauthor" value="<?php echo $auth; ?>" />
                                        <input type="hidden" name="tippermlink" value="<?php echo $link; ?>" />
                                        <center><button class="btn btn-default btn-tip" style="background: #fff;color: #090e68;">TIP</button></center>
                                    </form> 
                                <? } } ?>
                            </div>
                        </div>
                    </div>
                    <div class="container tip-sponsor">
                        <div class="row">
                            <div class="col tip-foot" style="color: #fff;">Tip this post for free - Author (40%) - You (60%)</div>
                        </div>
                    </div>
                </div>
                <div class="details-post-meta-block">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="details-post-meta-block-wrap">
                                    <div class="post-tag-block">
                                        <h5>Post Tag</h5>
                                        <div class="tags mod-tags">
                                        </div>
                                    </div><!-- post-tag-block -->
                                    <div class="post-share-block">
                                        <h5>Share this</h5>
                                        <ul class="social-share-list"></ul>
                                    </div><!-- post-share-block -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sidebar -posts
            <div class="col-md-3" style="margin-top: 30px !important;">
                <?php
                $sql1 = "SELECT * FROM steemposts ORDER BY id DESC LIMIT 4";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                        //$json_metadata = json_decode($row1['json_metadata'],true);

                        //$imgsrc = $json_metadata['image'];
                        $permlink = $row1['permlink'];
                        $username = $row1['username'];
                        $imgsrc = $row1['img_url'];

                        echo "<div class='container' style='padding: 0px !important;'>
                        <div class='row'>
                        <div class='col' style='padding: 0px !important;'>
                        <div style='background:#eee;border-bottom:40px solid #111;'>
                        <a href='/post/@".$username."/".$permlink."'><img src='".$imgsrc."' class='img-fluid' style='width:100%;min-height:8rem;' 'onerror='this.src='/images/post/authors/8.png''></a>  
                        </div>
                        <h4 class='post-title' style='white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin-bottom: 20px;margin-top: -40px;color: #fff;padding: 10px;'><a href='/post/@".$username."/".$permlink."'>".$row1['title']."</a></h4> 
                        </div>
                        </div>
                        </div>";
                    }
                }
                ?>
            </div>  -->

        </div></div>
        <div class="container" style="background: #fff;">
            <div class="row">
                <div class="col">
                    <div class="post-comment-block">
                        <div class="comment-respond">
                            <h4>Leave A Comment</h4>
                            <!--  <form action="" method="POST" class="comment-form"> -->
                                <div class="row">
                                  <!--  <input type="hidden" name="post_author" id="postauthor" value="" />
                                    <input type="hidden" name="post_permlink" id="postpermlink" value="" />
                                    <input type="hidden" name="cmt_author" id="c_author" value="" />
                                    <input type="hidden" name="cmt_permlink" id="c_permlink" value="" /> -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Comment" class="form-control cmt" name="cmt_body"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-default comt_bt">Comment</button>
                                <br>
                        <!--    </form>  -->
                        <!-- ads -->
                        <br>
                        <center>
                        <iframe data-aa="1318357" src="//ad.a-ads.com/1318357?size=336x280" scrolling="no" style="width:336px; height:280px; border:0px; padding:0; overflow:hidden" allowtransparency="true"></iframe>
                        </center>
                        <!-- ads -->
                        </div>
                        <div class="comment-area">
                            <h4>Comments</h4>
                            <ul class="comments cmt_section" id="comment_sec"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content mybody">
                    <?php include('template/modals/recomend.php'); ?>
                </div>
            </div>
        </div>
        <div class="modal fade" id="prouser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-custom modalStatus" role="document">
                <div class="modal-content modal-custom">
                    <?php include('template/modals/prouser.php'); ?>
                </div>
            </div>
        </div>
        <div class="modal fade" id="upvoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content mybody">
                    <?php include('template/modals/upvotemodal.php'); ?>
                </div>
            </div>
        </div>
                        
<?php include('template/footer.php'); $conn->close(); ?>
<script type="text/javascript">
    post_author = '<?php echo $auth; ?>';
    post_permlink = '<?php echo $link; ?>';
    var directTime = <?=($tiptime)?>;
</script>
<script src="/js/post_page.js"></script>