<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('template/header5.php');
?>
</div>
<div class="container" style="padding-top: 40px;">
<div class="row">
<div class="details-post-meta-tip" style="background: #080e70;">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <center><img src="/images/tips-dlike.png" alt="img" class="img-responsive"></center>
            </div>
            <div class="col-sm-5 mid-tip">
                <h2 class="tipratio" style="font-size: 18px;line-height: 2;font-weight: 600;color: #fffffffc;">DLIKE pays to share Links <br>Start sharing to earn money Now!</h2>
                <p class="tipthnk" style="display: none;">You need to wait before you can TIP again.</p>
            </div>
            <div class="col-sm-4">

                <form action="" method="post" id="">
                    <input type="hidden" name="tipauthor" value="">
                    <input type="hidden" name="tippermlink" value="">
                    <center><button type="button" class="btn btn-default up_tip" style="background: #fff;color: #090e68;">TIP</button></center>
                </form>            


            </div>
        </div>
    </div>
    <div class="container tip-sponsor">
        <div class="row">
            <div class="col tip-foot" style="color: #fff;">Tip this post for free - Author (40%) - You (60%)</div>
        </div>
    </div>
</div>
</div>
</div>

        <div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content mybody">
                    <?php include('template/modals/recomend.php'); ?>
                </div>
            </div>
        </div>
        <style>
        .post-comment-block .comment-respond, .post-comment-block .comment-area {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    padding: 60px 30px;
}
</style>
<div class="modal fade" id="modal-skill25" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="comment-respond">
                                                            <h4>Write A Comment</h4>
                                                            <form action="#">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                        <input type="text" placeholder="Name" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                        <input type="email" placeholder="Email address" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <textarea placeholder="Comment" class="form-control"></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <div class="custom-checkbox-wrap">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                    <label class="custom-control-label" for="customCheck4">Notify me of follow-up comments by email</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-default">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<?php include('template/footer.php'); $conn->close(); ?>
<script type="text/javascript">
    $('.up_tip').click(function () {
        $("#modal-skill25").modal("show");
    });   

</script>