<?php include('template/header.php'); 
$link = $_GET['link'];
$user = $_GET['user'];
$auth = str_replace('@', '', $user);
?>
</div>
        <div class="container">
         <div class="row"><div class="col-md-9">
            <div class="container">
            <div class="row">
                <div class="col">
                        <div class="blog-details-wrapper">
                            <div class="single-post-block">
                                <h3 class="post-title"><a href="#"><span class="mod-title"></span></a></h3>
                                <div class="post-thumb-block">
                                    <img src="" onerror="this.src='/images/post/8.png'" alt="img" class="img-responsive mod-thumb">
                                </div>
                                <h3 class="post-title"></h3>
                                <p class="post-entry mod-post"></p>
                            </div>
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
        </div><div class="col-md-3" style="background: #000;height: 100%;">ggggggggggggggggfffffffffffffggggggggg</div>
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
<?php include('template/footer.php'); ?>
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
</script>