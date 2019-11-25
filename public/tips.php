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
                <div class="comment-respond" style="padding: 30px 20px;">
                    <center><h4>@dlike_io</h4></center>
                        <center>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: 1rem;">My TIPs Balance: 109</p>
                            </div>
                        </div>
                        </center>
                        <div class="row">
                            <div class="col-md-4">
                                <p style="margin-bottom: 2px;">Get Free Tips</p>
                                <button class="btn btn-default-sm">Tweet Now</button>
                            </div>
                            <div class="col-md-4">
                                <i class="far fa-heart" style="font-size: 4rem; color: red;"></i>
                            </div>
                            <div class="col-md-4">
                                <p style="margin-bottom: 2px;">DIPS username</p>
                                <p>Certseek</p>
                            </div>
                        </div>
                        <center>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: 2rem;">My Earnings: $0.006</p>
                            </div>
                        </div>
                        </center>
                        <center><button class="btn btn-default">Withdraw</button></center>

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