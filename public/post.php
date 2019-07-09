<?php  include('template/header5.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$link = $_GET['link'];
$user = $_GET['user'];
$auth = str_replace('@', '', $user);
if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])) { $sender =  $_COOKIE['username']; }
$views = '1'; 
//post views
$sqlvs = "SELECT * FROM TotalPostViews where permlink = '$link' and author = '$auth'";
$resultvs = $conn->query($sqlvs);
if ($resultvs->num_rows > 0) {
    $rowview = mysqli_fetch_assoc($resultvs); 
    $postviews = $rowview["totalviews"];

    $sqlvip = "SELECT * FROM PostViews where permlink = '$link' and author = '$auth' and userip = '$ip'";
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
    $sqlview = "INSERT INTO TotalPostViews (author, permlink, totalviews)
    VALUES ('".$auth."', '".$link."', '".$views."')";
    mysqli_query($conn, $sqlview); 
    $postviews = '1';  
} 

//tip total income
$post_inc = "SELECT SUM(tip1) As post_inc, SUM(tip2) As post_inc2 FROM TipTop where permlink = '$link' and receiver = '$auth'";
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
   <div class="row"><div class="col-md-9">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="blog-details-wrapper">
                    <div class="single-post-block">
                        <h3 class="post-title"><a href="#"><span class="mod-title"></span></a></h3>

                        <div class="details-post-meta-block-top">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="details-post-meta-block-wrap">
                                            <div class="post-author-block">
                                                <div class="author-thumb">
                                                    <a href="#"><img src="" onerror="this.src='./images/post/authors/8.png'" alt="img" class="img-responsive mod-authThumb"></a>
                                                </div>
                                                <div class="author-info">
                                                    <h5> <a href="#" class="mod-auth"></a></h5>
                                                </div>
                                            </div>
                                            <div class="post-tag-block"><!-- post-likes-block -->
                                                <?php
                                                $sqlm = "SELECT likes FROM PostsLikes WHERE author = '$auth' and permlink = '$link'";
                                                $result = $conn->query($sqlm);
                                                $row = mysqli_fetch_assoc($result);
                                                if ($result->num_rows > 0) { $likesofpost = $row["likes"]; } else { $likesofpost = '0';}

                                                $sqlv = "SELECT * FROM MyLikes where permlink = '$link' and author = '$auth' and userip = '$ip'";
                                                $resultv = $conn->query($sqlv); 
                                                if ($resultv->num_rows > 0) { ?>
                                                    <div class="post-comments-mid">
                                                        <i class="fas fa-heart not-active"></i>&nbsp;&nbsp;<span id="tot_likes"><?php echo $likesofpost; ?></span> 
                                                    <? } else { ?>    
                                                        <div class="post-comments-mid"><span class="recomendation" id="up_vote" data-toggle="modal" data-target="#recomendModal" data-permlink="<?php echo $link; ?>" data-likes="<?php echo $likesofpost; ?>" data-author="<?php echo $auth; ?>">
                                                            <i class="fas fa-heart" id="vote_icon"></i></span>&nbsp;&nbsp;<span id="total_likes"><?php echo $likesofpost; ?></span> <? }?>
                                                        </div>                        
                                                    </div><!-- post-likes-block -->

                                                    <!-- post-views-block -->
                                                    <div class="post-share-block">
                                                        <i class="fas fa-eye"></i>&nbsp;&nbsp;<?php echo $postviews; ?>
                                                    </div><!-- post-views-block -->

                                                    <!-- post-income-block -->
                                                    <div class="post-share-block">
                                                        <i class="far fa-money-bill-alt"></i>&nbsp;&nbsp;$<?php echo $totalpostincome; ?>&nbsp;(<?php echo $postincome; ?> USDT <!--+ <?php echo $postincome2; ?> DSC-->)
                                                    </div><!-- post-income-block -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="post-thumb-block">
                                    <img src="" onerror="this.src='/images/post/8.png'" alt="img" class="card-img-post img-fluid mod-thumb">
                                </div>
                                <h3 class="post-title"></h3>
                                <p class="post-entry mod-post"></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="tip-msg"></div>
            <div class="details-post-meta-tip">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <center><img src="/images/bitfinex-logo.jpg" alt="img" class="img-responsive"></center>
                        </div>
                        <div class="col-sm-5 mid-tip">
                            <p class="tipratio">Tips are free from DLIKE <br>Tip Author 40% - 60% to ME</p>
                            <p class="tipthnk">You need to wait before you can TIP again.</p>
                        </div>
                        <div class="col-sm-4">

                            <?php
    //check if this post is tipped by you
    //if ($auth === $sender) { echo 'Same user';} else {}
                            if(empty($_COOKIE['username']) && !isset($_COOKIE['username'])) { echo '<center><button class="btn btn-danger">Login To Tip</button></center>'; $tiptime = '301';} else {
                                $verifysender = "SELECT * FROM TipTop where sender = '$sender'";
                                $result_sender = $conn->query($verifysender);
                                $row_sender = $result_sender->fetch_assoc(); 
                                if ($result_sender->num_rows > 0) { 

                                    $verifytip = "SELECT * FROM TipTop where permlink = '$link' and receiver = '$auth' and sender = '$sender'";
                                    $resultvtip = $conn->query($verifytip);
                                    $rowvtip = $resultvtip->fetch_assoc(); 
                                    if ($resultvtip->num_rows > 0) { 
                                        echo '<center><button class="btn btn-danger">You Already Tip This Post</button></center>';
                                        $tiptime = '0';
                                    } else {

                                        $verifytiptime = "SELECT TimeStampDiff(SECOND,tip_time,Now()) AS timed FROM TipTop where sender = '$sender' order by tip_time DESC limit 1";
                                        $resulttiptime = $conn->query($verifytiptime);
                                        $rowtiptime = $resulttiptime->fetch_assoc();
                                        if ($resulttiptime->num_rows > 0) {
                                            $tiptime = $rowtiptime['timed']; 
                                            if($tiptime < 300) {
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
                                    }   else    {   $tiptime = '301'; ?>
                                    <form action="/helper/addtips.php" method="post" id="tipsubmit">
                                        <input type="hidden" name="tipauthor" value="<?php echo $auth; ?>" />
                                        <input type="hidden" name="tippermlink" value="<?php echo $link; ?>" />
                                        <center><button class="btn btn-default btn-tip">TIP</button></center>
                                        </form> <?
                                    }   
                                }   ?>           
                                

                            </div>
                        </div>
                    </div>
                    <div class="container tip-sponsor">
                        <div class="row">
                            <div class="col tip-foot">This tip is sponsored by Bitfinex. Learn more about Bitfinex here</div>
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
                                        <ul class="social-share-list">
                                            <li><a href="#" class="faceboox"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" class="linkdin"> <i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#" class="instagram"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
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
                $sql1 = "SELECT json_metadata,username,permlink,title FROM steemposts ORDER BY id DESC LIMIT 3";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                        $json_metadata = json_decode($row1['json_metadata'],true);

                        $imgsrc = $json_metadata['image'];
                        $permlink = $row1['permlink'];
                        $username = $row1['username'];

                        echo "<div class='container' style='padding: 0px !important;'>
                        <div class='row'>
                        <div class='col' style='padding: 0px !important;'>
                        <div style='background:#eee;border-bottom:40px solid #111;'>
                        <a href='/post/@".$username."/".$permlink."'><img src='".$imgsrc."' class='img-fluid' style='width:100%;min-height:190px;'  onerror='this.src='./images/post/8.png''></a>  
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
                            <form action="helper/comment.php" method="POST" class="comment-form">
                                <div class="row">
                                    <input type="hidden" name="post_author" id="postauthor" value="" />
                                    <input type="hidden" name="post_permlink" id="postpermlink" value="" />
                                    <input type="hidden" name="cmt_author" id="c_author" value="" />
                                    <input type="hidden" name="cmt_permlink" id="c_permlink" value="" />
                                    <input type="hidden" name="user_at" id="userauth" value="" />
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Comment" class="form-control cmt" name="cmt_body"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-default cmt_bt">Submit</button>
                            </form>
                        </div>
                        <div class="comment-area">
                            <h4>Comments</h4>
                            <ul class="comments cmt_section"></ul>
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

        <?php

        $sqlt = "SELECT sender, tip_time, permlink, tip1, tip2 FROM TipTop ORDER BY tip_time DESC LIMIT 10";
        $resultkj = $conn->query($sqlt);

        if ($resultkj->num_rows > 0) {
            while($rowkj = $resultkj->fetch_assoc()) { ?>
                <div class="activity-block">
                    <div class="row my-entry">
                        <div class="col-sm-8">
                            <div class="row">
                                <div><span class="btn btn-icon btn-exp"><span class="text-dark">Tx</span></span></div>
                                <div class="exp-user"><?php echo $rowkj["sender"]; ?></div>
                                <div class="exp-user">For <span><?php echo $rowkj["tip_time"]; ?></span></div>
                                <div class="exp-user"><?php echo $rowkj["tip1"]; ?></div>
                                <div class="exp-user"><?php echo $rowkj["tip2"]; ?></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="exp-amt"><span id=""><?php echo $rowkj["permlink"]; ?></span> Dlikes</div>
                        </div>
                    </div>
                </div>
            <? }
        }
        ?>                        
        <?php include('template/footer3.php'); ?>
        <script type="text/javascript">
            post_author = '<?php echo $auth; ?>';
            post_permlink = '<?php echo $link; ?>';
            steem.api.getContent(post_author , post_permlink, function(err, res) {
        console.log(res);

        let metadata = JSON.parse(res.json_metadata);
        let img = new Image();
        if (typeof metadata.image === "string"){
            img.src = metadata.image.replace("?","?");
        } else {
            img.src = metadata.image[0];
        }
        json_metadata = metadata;
        let category = metadata.category;
        let exturl = metadata.url;
        if (category === undefined) { category = "dlike"; } else {category = metadata.category;}
        let steemTags = metadata.tags;
        let dlikeTags = steemTags.slice(2);
        let posttags = dlikeTags.map(function (meta) { if (meta) return '<a href="#">' + meta + ' </a>' });
        let title = res.title;
        let author = res.author;
        let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
        let post_description = metadata.body.replace(/<[\/]{0,1}(p)[^><]*>/ig,"");
        //let post_body = $(post_description).text();

        $('.mod-auth').html(author);
        $('.mod-title').html(title);
        $('.mod-thumb').attr("src", img.src);
        $('.mod-authThumb').attr("src", auth_img);
        $('.mod-tags').html(posttags);
        $('.mod-post').text(post_description);
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
        if (username === null) 
        {
            toastr.error('hmm... You must be login!');
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
    var countDown = 295 - directTime;

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
</script>