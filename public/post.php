<?php include('template/header5.php'); 
$link = $_GET['link'];
$user = $_GET['user'];
$auth = str_replace('@', '', $user);
$sender =  $_COOKIE['username'];

if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}
echo $ip = ip2long($ip);
$_SESSION['usertoken'] = $ip;

if(!isset($_COOKIE['usertoken'])) {
  setcookie('usertoken', $_SESSION['usertoken'], time() + (86400 * 30), "/");
} else {$_COOKIE['usertoken'];}


?>
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
                                <div class="post-tag-block">
                                    <h5>Recomendations</h5>
                                    <div class="tags mod-tags">
                                    </div>
                                </div><!-- post-tag-block -->
                                <div class="post-share-block">
                                    <h5>Tip Now</h5>
                                    <ul class="social-share-list">
                                        <li><a href="#" class="faceboox"><i class="fab fa-facebook-f"></i></a></li>
                                    </ul>
                                </div><!-- post-share-block -->
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
                        <div class="col">
                            <img src="/images/logo.png" alt="img" class="img-responsive" style="width: 150px;max-width: 1110px">
                        </div>
                        <div class="col">
                            <p class="tipratio">Tips are fre from DLIKE <br>
                            Tip Author 60% - 40% to ME</p>
                            <p class="tipthnk" style="display: none;">Thanks for the tip. You need to wait before you cn do an other tip</p>
                        </div>
                        <div class="col">
                            <form action="helper/addtips.php" method="post" id="tipsubmit">
                                <input type="hidden" name="tipauthor" value="<?php echo $auth; ?>" />
                                <input type="hidden" name="tippermlink" value="<?php echo $link; ?>" />
                                <center><button class="btn btn-default">TIP</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details-post-meta-block">
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
                                        <li><a href="#" class="google-plus"> <i class="fab fa-google-plus-g"></i></a></li>
                                        <li><a href="#" class="linkdin"> <i class="fab fa-linkedin-in"></i></a></li>
                                        <li> <a href="#" class="pinterest"><i class="fab fa-pinterest"></i></a></li>
                                        <li><a href="#" class="instagram"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div><!-- post-share-block -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 30px !important;">
            <div class="container" style="padding: 0px !important;">
                <div class="row">
                    <div class="col" style="padding: 0px !important;">
                        <div style="background:#eee;height: 250px;margin-bottom: 15px;">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="padding: 0px !important;">
                <div class="row">
                    <div class="col" style="padding: 0px !important;">
                        <div style="background:#eee;height: 250px;margin-bottom: 15px;"></div>
                    </div>
                </div>
            </div>
            <div class="container" style="padding: 0px !important;">
                <div class="row">
                    <div class="col" style="padding: 0px !important;">
                        <div style="background:#eee;height: 250px;"></div>
                    </div>
                </div>
            </div>
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
<?php include('template/footer3.php'); ?>
<script type="text/javascript">
    post_author = '<?php echo $auth; ?>',
    post_permlink = '<?php echo $link; ?>';
    steem.api.getContent(post_author , post_permlink, function(err, res) {
        //console.log(res);

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
        $(this).ajaxSubmit(tipoptions)
        return !1
    });
</script>