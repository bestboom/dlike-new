$('#dlike_share').click(function() {
    if (dlike_username != null) {$('#share_plus').hide();$('.share_loader').show();
        let input_url = $("#url_field").val();
        if (input_url == '') { $("#url_field").css("border-color", "RED");toastr.error('phew... You forgot to enter URL');$('#share_plus').show();$('.share_loader').hide();return false;
        }
        let verifyUrl = getDomain(input_url);
        let restricted_urls = restricted.replace(/^'[ ]?|,$/g,'');console.log(restricted_urls);
        if (isValidURL(input_url)) {if ($.inArray(verifyUrl, restricted_urls) > -1) {toastr.error('phew... Sharing from this url is not allowed');$('#share_plus').show();$('.share_loader').hide(); return false;}

            $.ajax({url: '/helper/check_limits.php',type: 'post',data: { action : 'shares_limit',user: dlike_username },
                success: function(data)  { 
                    try { var response = JSON.parse(data) 
                        if (response.error == true) { toastr.error(response.message);$('#share_plus').show();$('.share_loader').hide();return false;}
                        else {
                            $.ajax({url: '/helper/check_limits.php',type: 'post',data: { action : 'unique_post',newurl: input_url },
                                success: function(data)  { 
                                    try { var response = JSON.parse(data) 
                                        if (response.error == true) { toastr.error(response.message);$('#share_plus').show();$('.share_loader').hide();return false;} 
                                        else {$('#share_plus').hide();$('.share_loader').show();
                                            fetch_data("/helper/main.php", input_url);}
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
    $.post(apiUrl, { url: webUrl }, function(response) {let res = JSON.parse(response);
        window.location.replace("editDlikePost.php?url=" + encodeURIComponent(res.url) + "&title=" + encodeURIComponent(res.title) + "&imgUrl=" + encodeURIComponent(res.imgUrl) + "&details=" + encodeURIComponent(res.des));
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

    if (hostName != null) {
        let parts = hostName.split('.').reverse();
        if (parts != null && parts.length > 1) {
            domain = parts[1] + '.' + parts[0];
            if (hostName.toLowerCase().indexOf('.co.uk') != -1 && parts.length > 2) { domain = parts[2] + '.' + domain;
            }
        }
    }
    return domain;
}
function getHostName(url) {
    var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
    if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
        return match[2];
    } else {return false;}
}