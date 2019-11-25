<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('template/header5.php');
?>
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

                <form action="" method="post" id="tipsubmit">
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

        <div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content mybody">
                    <?php include('template/modals/recomend.php'); ?>
                </div>
            </div>
        </div>

<?php include('template/footer.php'); $conn->close(); ?>
<script type="text/javascript">
    $('.up_tip').click(function () {
        $("#recomendModal").modal("show");
    });   

</script>