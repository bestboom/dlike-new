<?php include('template/header5.php');?>
</div><!-- sub-header -->
<div class="latest-post-section" style="min-height:80vh;">
    <div class="container">
        <div class="row  align-items-center h-100 post_select">
            <div class="row col-md-3 justify-content-center">
                <h4 class="lab_post orderByLatest activeOrderBy">Latest</h4>
                <h4 class="lab_post orderByTopRated">Top Rated</h4>
            </div>
            <div class="col-md-9 lay">&nbsp;</div>
        </div>
        <div id="loadings"><img src="/images/loader.svg" width="100"></div>
        <div class="row" id="content">
        </div>
    </div>
</div>
<?php include('template/modals/modal.php'); ?>    
<?php include('template/footer3.php'); ?>
<script type="text/javascript">
    $( document ).ready(function() {    
    $('#loadings').delay(7000).fadeOut('slow');
});
</script>