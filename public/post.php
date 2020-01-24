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
<div class="container" style="padding-top: 40px;">
   <div class="row">
    <div class="col-md-9">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="blog-details-wrapper">
                        <div class="single-post-block">
                            <!-- <center><ins class="bmadblock-5ddbb7dff918d6c5b02131db" style="display:inline-block;width:468px;height:60px;"></ins><script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/5ddbb7dff918d6c5b02131db"></script></center>
                            <br> -->
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
                                    <div class="post-thumb-block">
                                        <img src="/images/post/8.png" alt="img" class="card-img-post img-fluid">
                                    </div>
                                    <h3 class="post-title"></h3>
                                    <span class="post-entry mod-post"><?php echo $body_text; ?></span>
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
                                    if ($resultvtip->num_rows > 0) { 
                                        echo '<center><button class="btn btn-danger">You Already Tip This Post</button></center>';
                                        $tiptime = '0';
                                    } else {

                                        $verifytiptime = "SELECT TimeStampDiff(SECOND,tip_time,Now()) AS timed FROM tiptop where sender = '$sender' order by tip_time DESC limit 1";
                                        $resulttiptime = $conn->query($verifytiptime);
                                        $rowtiptime = $resulttiptime->fetch_assoc();
                                        if ($resulttiptime->num_rows > 0) {
                                            $tiptime = $rowtiptime['timed']; 
                                            if($tiptime < 600) {
                                                echo    '<div id="countdown">
                                                <div class="btn"><span id="minutes">00</span><span style="float:center">:</span>
                                                <span id="seconds">00</span></div></div>'; 
                                                echo    '<div id="aftercount" style="display: none;"><center><button class="btn btn-success">Ready To Tip Again</button></center></div>';    

                                            }  else { ?>
                                                <form action="/helper/addtips.php" method="post" id="tipsubmit">
                                                    <input type="hidden" name="tipauthor" value="<?php echo $auth; ?>" />
                                                    <input type="hidden" name="tippermlink" value="<?php echo $link; ?>" />
                                                    <center><button class="btn btn-default btn-tip">TIP</button></center>
                                                    </form> <?
                                                }                
                                            }   
                                        }   
                                    }   else    {   $tiptime = '601'; ?>
                                    <form action="/helper/addtips.php" method="post" id="tipsubmit">
                                        <input type="hidden" name="tipauthor" value="<?php echo $auth; ?>" />
                                        <input type="hidden" name="tippermlink" value="<?php echo $link; ?>" />
                                        <center><button class="btn btn-default btn-tip" style="background: #fff;color: #090e68;">TIP</button></center>
                                        </form> <?
                                    }   
                                }   ?>           
                                

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
            <!-- sidebar -posts -->
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
            </div>

        </div></div>
        <div class="container">
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
                        <center>
                        <ins class="bmadblock-5d975d54237faa2ad109a7ed" style="display:inline-block;width:336px;height:280px;"></ins>
                        <script async type="application/javascript" src="//ad.bitmedia.io/js/adbybm.js/5d975d54237faa2ad109a7ed"></script>
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
        steem.api.getContent(post_author , post_permlink, function(err, res) {
        //console.log(res);
        res["voterlist"] = '';
        let metadata = JSON.parse(res.json_metadata);
        let img = new Image();
        if (typeof metadata.image === "string"){
            img.src = metadata.image.replace("?","?");
        } else {
            img.src = metadata.image[0];
        }

        //image or youtube
        let thumbnail = '<img src="' + img.src + '" alt="' + res.title + '" onerror="this.src=/images/post/8.png" class="card-img-post img-fluid">';

            var getLocation = function(href) {
                    var l = document.createElement("a");
                    l.href = href;
                    return l;
                };
                var url = getLocation(metadata.url);
                var youtubeAnchorTagVariableClass = '';
                if(url.hostname == 'www.youtube.com' || url.hostname == 'youtube.com' || url.hostname == 'youtu.be' || url.hostname == 'www.youtu.be'){
                    //alert(url);
                    youtubeAnchorTagVariableClass = 'youtubeAnchorTagVariableClass_' + '';
                    if(url.search != ''){
                        let query = url.search.substr(1); //remove ? from begning
                        //query = query.split('&')
                            let splited = query.split('=');
                            if(splited[0] == 'v'){
                                thumbnail = '<span class="embed-responsive embed-responsive-16by9"><iframe src="https://www.youtube.com/embed/' + splited[1] + '" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe></span>'
                            }
                    }else{
                        thumbnail = '<span class="embed-responsive embed-responsive-16by9"><iframe src="https://www.youtube.com/embed/' + url.pathname + '" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe></span>';
                    }
                }

        json_metadata = metadata;
        let category = metadata.category;
        let exturl = metadata.url;
        if (category === undefined) { category = "dlike"; } else {category = metadata.category;}
        let steemTags = metadata.tags;
        let dlikeTags = steemTags.slice(1);
        let posttags = dlikeTags.map(function (meta) { if (meta) return '<a href="#">' + meta + ' </a>' });
        let title = res.title;
        let author = res.author;
        let profile_url = "/@" + author;
        let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
        
        let post_description = metadata.body.replace(/<[\/]{0,1}(p)[^><]*>/ig,"");
        let ext_url = metadata.url;
        let pending_steem = res.pending_payout_value.substr(0, 4);

        //let post_body = $(post_description).text();

        let postbody;
        if(res.body && res.body != undefined){
        try {
        postbody = res.body;
        postbody = postbody.split(/\n\n#####\n\n/);
        postbody = postbody[1];
        //postbody = postbody.replace(/#([^\s]*)/g,'');
        //postbody = postbody.replace(/<(.|\n)*?>/g, '');
        }catch(err) {
        postbody = "";
        }
        }else{
        postbody = "";
        }
        //console.log(postbody);
        $('.mod-auth').html(author);
        $('.mod-title').html(title);
        $('.post-thumb-block').html(thumbnail);
        $('.mod-authThumb').attr("src", auth_img);
        $('.author-thumb-link').attr("href", profile_url);
        $('.mod-auth').attr("href", profile_url);
        $('.mod-tags').html(posttags);
        $('.mod-post').html(postbody);
        //$('.post_link').html('<a href="' + ext_url + '" target="_blank">Source of shared link</a>');
        $('.pending_payout').html(pending_steem);

        let page_description = post_description.substr(0,70);

        $(".social-share-list").html('<li><a class="twitter" href="javascript:void(0);" onclick="popup(\'https://www.twitter.com/share?text='+page_description+'&url=https://dlike.io/post/@'+author+'/'+post_permlink+'&hashtags=dlike\')"><i class="fab fa-twitter"></i></a></li><li><a class="faceboox" href="javascript:void(0);" onclick="popup(\'https://www.facebook.com/share.php?u=https://dlike.io/post/'+author+'/'+post_permlink+'&title='+title+'\')"><i class="fab fa-facebook-f"></i></a></li><li><a class="linkdin" href="javascript:void(0);" onclick="popup(\'https://www.linkedin.com/shareArticle?mini=true&url=https://dlike.io/post/'+author+'/'+post_permlink+'&title='+title+'&sumary=dlike.io\')"><i class="fab fa-linkedin-in"></i></a></li>');

                    //check if voted
            steem.api.getActiveVotes(author, post_permlink, function(err, result) {
                //console.log(result);
                    if(result === Array) {
                        var voterList = result;
                    } else {
                        var voterList = [];
                    }
                    if(!(voterList === Array)) {
                        voterList = [];
                    }
                    var voterList = result;
                for (let j = 0; j < voterList.length; j++) {
                    if (voterList[j].voter == username) { 
                        $("#steem_vote_icon").css("color", "RED"); 
                        $('#steem_vote_icon').click(function(){return false;});
                        $('a').removeClass('up_steem');
                        $('#steem_vote_icon').hover(function() {toastr.error('hmm... Already Upvoted');})
                    }
                }                        
            });

            $.getJSON('https://scot-api.steem-engine.com/@'+author+'/'+post_permlink+'', function(data) {
                //console.log(data.DLIKER.pending_token);
                let pending_token = (data.DLIKER.pending_token)/1000;
                $("#pending_dliker").html(pending_token);
                let voters = data.DLIKER.active_votes;
                let netshare = data.DLIKER.vote_rshares;

                    if(voters === Array) {
                        var voterList = voters;
                    } else {
                        var voterList = [];
                    }
                    if(!(voters === Array)) {
                        var voterList = [];
                    }
                    var voterList = voters;
                for (let v = 0; v < voterList.length; v++) {
                    if(voterList[v].weight>0){
                        let vote_amt = ((voterList[v].rshares / netshare) * pending_token).toFixed(3);
                        let votePercent = ((voterList[v].percent / 10000) * 100);
                        votePercent = parseInt(votePercent);
                        let voter = voterList[v].voter;
                        if (v > 0) {
                            $('#se_token').css('cursor','pointer');
                        }
                        res["voterlist"] += '<li style="list-style:none;"><span style="color:#c51d24;"><a> @' + voter + '</a></span>&nbsp;<span>(' + votePercent + '%)</span>&nbsp;&nbsp;<span style="float:right;"><i>' + vote_amt + '</i></span></li>'; 
                    }    
                }
                $('#se_token').attr("data-content", res["voterlist"]);
            });
    });
    //comments
var refreashComments = function () {
    let comment = []    
    steem.api.getContentReplies(post_author, post_permlink, function(err, result) {
            //showMainComment(0, result);
            
            for (var i = 0; i < result.length; i++) {
            //function showMainComment(i, commentsArray) {
            //console.log(commentsArray.length);
            $comment = result[i];

            //console.log($comment);
            let metadata;
            if ($comment.json_metadata && $comment.json_metadata.length > 0){
                metadata = JSON.parse($comment.json_metadata);
            }
            if(metadata && metadata.community == "dlike"){
                let a_p = "https://dlike.io/@"+$comment.author;
                let $commentbody = $comment.body.replace(/<[\/]{0,1}(p)[^><]*>/ig,"");

                $(".cmt_section").append('<li class="comment">\n' +
                    '<div class="comment-wrap">\n' +
                    '<div class="comment-info">\n' +
                    '<div class="commenter-thumb"><img src="https://steemitimages.com/u/'+$comment.author+'/avatar" class="img-fluid" alt=""></div>\n' +
                    '<div class="commenter-info">\n' +
                    '<span class="commenter-name">'+$comment.author+'</span>\n' +
                    '<span class="date">'+moment.utc($comment.created + "Z", "YYYY-MM-DD  h:mm:ss").fromNow()+'</span>\n' +
                    '</div>\n' +
                    '<div class="reply"><button type="button" class="reply-button">Reply</button></div>\n' +
                    '</div>\n' +
                    '<div class="comment-body">'+$commentbody+'</div>\n' +
                    '</div>\n' +
                    '</li>');
            }        
            
        }
    });
};
    refreashComments();
    //new-comment    
    $('.comt_bt').click(function () {
        if (username == null) 
        {
            toastr.error('hmm... You must be login!');
            return false;
        }
        if (!$.trim($('[name="cmt_body"]').val())) {
            toastr.error('It seems you forgot to post comment');
            return false;  
        }
    $(".comt_bt").html('commenting...');    
    let comment_body= $(".cmt").val(); 
    //console.log(comment_body); 
    let permlinkD = steem.formatter.commentPermlink(post_author, post_permlink);  
    var datac = {
            p_author: post_author,
            p_permlink: post_permlink,
            comt_body: comment_body,
            cmt_permlink: permlinkD
        };    
    $.ajax({
        type: "POST",
        url: "/helper/comment.php",
        data: datac,
            success: function(data) {
            console.log(data);
            try {
                var response = JSON.parse(data)
                    if(response.error == false) {
                        $(".cmt_section").html('');
                        $(".cmt").val('');
                        refreashComments();
                        toastr.success('Comment posted successfully!');
                        $(".comt_bt").html('Comment');
                    } else { 
                        toastr.error('There is some issue!'); 
                        $(".comt_bt").html('Comment');
                        return false;   
                    }
                } catch (err) {
                    toastr.error('Sorry. Server response is malformed.');
                }
            },
        });    
    });    

    // tip me
    var tipoptions = {
        target: '#tip-msg',
        url: '/helper/addtips.php',
        success: function() {
            $('#tipsubmit').hide();
            $('.tipratio').hide();
            $('.tipthnk').show();
        },
    }

    $('#tipsubmit').submit(function() {
        if (username == null) 
        {
            toastr.error('hmm... You must be login!');
            return false;
        }
        if (username == post_author) 
        {
            toastr.error('Sorry... You cant tip your own post!');
            return false;
        }
        if (thisuser !='PRO') {
            $("#prouser").modal("show");
            return false;
        }

        $(this).ajaxSubmit(tipoptions)
        return !1 
    });
    var directTime = <?=($tiptime)?>;
    var sTime = new Date().getTime();
    var countDown = 595 - directTime;

    function UpdateTime() {
        var cTime = new Date().getTime();
        var diff = cTime - sTime;
        var seconds = countDown - Math.floor(diff / 1000);
        if (seconds >= 0) {
            var minutes = Math.floor(seconds / 60);
            seconds -= minutes * 60;
            $("#minutes").text(minutes < 10 ? "0" + minutes : minutes);
            $("#seconds").text(seconds < 10 ? "0" + seconds : seconds);
            $(".tipratio").hide();
            $(".tipthnk").show();
        } else {
            $("#countdown").hide();
            $(".tipthnk").hide();
            $(".tipratio").show();
            $("#aftercount").show();

            clearInterval(counter);
        }
    }
    UpdateTime();
    var counter = setInterval(UpdateTime, 500);

    $('#aftercount').click(function () {
     location.reload(true); 
 });
    $('.prouser').click(function () {
     window.open("/help","_self");
 });  

//steem-upvote
$('.up_steem').click(function () {
    $("#vote_author").val(post_author);
    $("#vote_permlink").val(post_permlink);
    $("#upvoteModal").modal("show");
});   
</script>