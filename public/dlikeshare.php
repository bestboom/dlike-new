<?php include('template/header.php'); 
if (!isset($_COOKIE['dlike_username']) || !$_COOKIE['dlike_username']) {die('<script>window.location.replace("https://dlike.io/share","_self")</script>');} else { $dlike_user = $_COOKIE['dlike_username'];} ?>
</div>
<div class="container"><div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">
    <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
        <div class="modal-body">
            <div class="share-block"> <p>Share To Get Rewarded</p></div>
            <div class="user-connected-form-block" style="background: #1b1e63;">
                <form class="user-connected-from share-form">
                    <div class="form-group"><input type="text" class="form-control" id="url_field" required="true" placeholder="Enter URL" style="border-radius: 20px;"></div>
                    <center><button type="button" class="btn btn-default" style="width: 40%;padding-top: 5px;" id="dlike_share"><i class="fas fa-spinner fa-spin share_loader" style="display:none;"></i><span id="share_plus">Share</span></button>
                    </center></form>
                <p style="color: #fff;">Must read  <a href="/help" style="color: #e1ec31;"> Terms &amp; Conditions</a> for sharing!</p>
            </div>
        </div>
    </div>
</div></div>
<?php include('template/footer.php'); ?>