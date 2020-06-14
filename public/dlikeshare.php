<?php include('template/header7.php'); 
if (!isset($_COOKIE['dlike_username']) || !$_COOKIE['dlike_username']) {
    die('<script>window.location.replace("https://dlike.io/share","_self")</script>');
} else {
    $dlike_user = $_COOKIE['dlike_username'];
}
?>
</div>
    <div class="container">
        <div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">
            <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
                <div class="modal-body">
                    <div class="share-block">
                        <p>Share To Get Rewarded</p>
                    </div>
                    <div class="user-connected-form-block" style="background: #1b1e63;">
                        <form class="user-connected-from share-form">
                            <div class="form-group">
                                <input type="text" class="form-control" id="url_field" required="true" placeholder="Enter URL" style="border-radius: 20px;">
                            </div>
                            <center>
                                <button type="button" class="btn btn-default" style="width: 40%;padding-top: 5px;" id="dlike_share"><i class="fas fa-spinner fa-spin share_loader" style="display:none;"></i><span id="share_plus">Share</span></button>
                            </center>
                        </form>
                        <p style="color: #fff;">Must read  <a href="/help" style="color: #e1ec31;"> Terms &amp; Conditions</a> for sharing!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php include('template/dlike_footer.php'); ?>
<script type="text/javascript">
    //var dlike_username  = $.cookie("dlike_username");
    $('#dlike_share').click(function() {
            console.log(dlike_username);
            if (dlike_username != null) {
                let url = $("#url_field").val();
                if (url == '') {
                    $("#url_field").css("border-color", "RED");
                    toastr.error('phew... You forgot to enter URL');
                    return false;
                }
                let verifyUrl = getDomain(url);
                if (isValidURL(url)) {
                    if (verifyUrl.match(/steemit.com/g)) {
                        toastr.error('phew... Steem URL not allowed');
                        return false;
                    }
                    $('#share_plus').hide();
                    $('.share_loader').show();
                    fetch_data("helper/main.php", url);
                } else {
                    toastr.error('phew... URL is not Valid');
                }
            } else { toastr.error('hmm... You must be login!'); return false; }
        });
        function fetch_data(apiUrl, webUrl) {
            $.post(apiUrl, { url: webUrl }, function(response) {

                let res = JSON.parse(response);
                window.location.replace("editDetails4.php?url=" + encodeURIComponent(res.url) + "&title=" + encodeURIComponent(res.title) + "&imgUrl=" + encodeURIComponent(res.imgUrl) + "&details=" + encodeURIComponent(res.des));

            });
        }

        function isValidURL(url) {
            var RegExp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (RegExp.test(url)) {
                return true;
            } else {
                toastr.error('phew... Enter a valid url');
                return false;
            }
        }

        function getDomain(url) {
            let hostName = getHostName(url);
            let domain = hostName;

            if (hostName != null) {
                let parts = hostName.split('.').reverse();
                if (parts != null && parts.length > 1) {
                    domain = parts[1] + '.' + parts[0];
                    if (hostName.toLowerCase().indexOf('.co.uk') != -1 && parts.length > 2) {
                        domain = parts[2] + '.' + domain;
                    }
                }
            }
            return domain;
        }

        function getHostName(url) {
            var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
            if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
                return match[2];
            } else {
                return false;
            }
        }
</script>