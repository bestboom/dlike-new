<div class="modal-body p-4" id="result">
    <div class="section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col">
                        <div class="blog-details-wrapper">
                            <div class="single-post-block">
                                <div class="row d-flex single_close"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="mod-close">×</span></button></div>
                                <h3 class="post-title"><a href="#"><span class="mod-title"></span></a></h3>
                                <div class="post-thumb-block">
                                    <img src="" onerror="this.src='./images/post/8.png'" alt="img" class="img-responsive mod-thumb">
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
    </div>     
</div>           