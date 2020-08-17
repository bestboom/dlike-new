<?php include('template/header5.php'); 
if (isset($_COOKIE['dlike_username']) || $_COOKIE['dlike_username']) {die('<script>window.location.replace("https://dlike.io/dlikeshare","_self")</script>');} else {$steem_user = $_COOKIE['username'];}?>
</div>
<div class="container"><div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">
    <div class="modal-content" style="background: #1b1e63;border-radius: 14px;"><div class="modal-body">
        <div class="share-block">=<p>Share To Get Rewarded</p></div>
        <div class="user-connected-form-block" style="background: #1b1e63;">
            <form class="user-connected-from share-form">
                <div class="form-group"><input type="text" class="form-control" id="url_field" required="true" placeholder="Enter URL" style="border-radius: 20px;"></div>
                <center><button type="button" class="btn btn-default" style="width: 40%;padding-top: 5px;" id="share"><i class="fas fa-spinner fa-spin loader" style="display:none;"></i><span id="plus">Share</span></button></center>
            </form>
            <p style="color: #fff;">Must read  <a href="/help" style="color: #e1ec31;"> Terms &amp; Conditions</a> for sharing!</p>
        </div>
    </div></div>
</div></div>  
<?php include('template/dlike_footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/steemconnect"></script>
<script src="/js/steemconnect.js"></script>
<script type="text/javascript">
$('#plus').click(function() {
    if (username != null) {$('#plus').hide();$('.loader').show();
        let input_url = $("#url_field").val();
        if (input_url == '') { $("#url_field").css("border-color", "RED");toastr.error('phew... You forgot to enter URL');$('#plus').show();$('.loader').hide();return false;
        }
        let verifyUrl = getDomain(input_url);
        let restricted_urls = ["dlike.io", "steemit.com", "wikipedia.org", "facebook.com", "youtube.com", "youtu.be", "pinterest.com", "twitter.com", "bloomberg.com"];
        if (isValidURL(input_url)) {
            if ($.inArray(verifyUrl, restricted_urls) > -1) {toastr.error('phew... Sharing from this url is not allowed');$('#plus').show();$('.loader').hide(); return false;
            }

            $.ajax({
            url: '/helper/check_pro.php',type: 'post',data: { user: username },
                success: function(data)  { 
                    try { var response = JSON.parse(data) 
                        if (response.error == true) { toastr.error(response.message);$('#plus').show();$('.loader').hide();return false;}
                        else {
                            $.ajax({url: '/helper/check_share.php',type: 'post',data: { url: input_url },
                                success: function(data)  { 
                                    try { var response = JSON.parse(data) 
                                        if (response.error == true) { toastr.error(response.message);$('#plus').show();$('.loader').hide();return false;} 
                                        else {$('#plus').hide();$('.loader').show();
                                            fetch_data("/helper/main.php", input_url);
                                        }
                                    } catch (err) {toastr.error('Sorry. Server response is malformed.');}
                                }
                             });
                        }
                    } catch (err) {toastr.error('Sorry. Server response is malformed.');}
                }
            });
        } else {toastr.error('phew... URL is not Valid');}
    } else { toastr.error('hmm... You must be login!'); return false; }
});
function fetch_data(apiUrl, webUrl) {
    $.post(apiUrl, { url: webUrl }, function(response) { let res = JSON.parse(response);
        window.location.replace("editDetails.php?url=" + encodeURIComponent(res.url) + "&title=" + encodeURIComponent(res.title) + "&imgUrl=" + encodeURIComponent(res.imgUrl) + "&details=" + encodeURIComponent(res.des));
    });
}
function isValidURL(url) {
    var RegExp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    if (RegExp.test(url)) {return true;
    } else {toastr.error('phew... Enter a valid url');return false;}
}
function getDomain(url) {
    let hostName = getHostName(url);
    let domain = hostName;

    if (hostName != null) { let parts = hostName.split('.').reverse();
        if (parts != null && parts.length > 1) {
            domain = parts[1] + '.' + parts[0];
            if (hostName.toLowerCase().indexOf('.co.uk') != -1 && parts.length > 2) { domain = parts[2] + '.' + domain;
            }
        }
    }
    return domain;
}
function getHostName(url) { var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
    if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
        return match[2];
    } else {return false;}
}
</script>