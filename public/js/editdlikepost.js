const $input = document.querySelector(".dlike_tags"); const tags_check = /[a-zA-Z0-9 \/]+/;
$input.addEventListener("keypress", e => {if (!tags_check.test(e.key)) {e.preventDefault();toastr.error('Characters not allowed. Only tags separated by space.');}});
function getHostName(url) {var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
    if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {return match[2];} else {return false;}
}
function getDomain(url) {let hostName = getHostName(url); let domain = hostName;
    if (hostName != null) {let parts = hostName.split('.').reverse();
        if (parts != null && parts.length > 1) {domain = parts[1] + '.' + parts[0];
        if (hostName.toLowerCase().indexOf('.co.uk') != -1 && parts.length > 2) {domain = parts[2] + '.' + domain;}}
    }
    return domain;
}
let domain_name = getDomain(url_submitted);
$('#domain_name').html(domain_name);
$('.dlike_share_post').click(function(clickEvent) {
    if (dlike_username != null) {
        
        let verifyUrl = getDomain(urlInput);
        if($('.dlike_cat').val() == "0") {$('.dlike_cat').css("border-color", "RED");toastr.error('Please Select an appropriate Category');return false;}
        var tags = $('.dlike_tags').val();var allowed_tags_type = /^[a-zA-Z0-9]+$/;
        if (allowed_tags_type.test(tags)) {$('.tags').css("border-color", "RED");toastr.error('Only alphanumeric tags, no Characters.');return false;}
        tags = $.trim(tags).split(' ');
        if (tags.length < 2) {$('.tags').css("border-color", "RED");toastr.error('Please add at least two related tags');return false;}
        var description = $('textarea#post_desc').val();
        var post_description = $.trim(description).split(' ');
        if (post_description.length < 5) {$('.data-desc').css("border-color", "RED");toastr.error('Please add description of link (max 100 words)');return false;}
        var title = $('.data-title').html();
        if (title=="") {toastr.error('Some error in this link!');return false;}
        var author = dlike_username;
        var permlink=title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').replace(/-+/g,'-').toLowerCase();
        var tags = $('.dlike_tags').val();
        var post_tags = $.trim(tags).replace(/\s+/g, ' ');
        var post_body = description.replace(/[\u2018\u2019]/g, "'").replace(/[\u201C\u201D]/g, '"');
        var urlImage =  $('.image_field').val();
        var post_category = $('.dlike_cat').val();

        $(".dlike_share_post").attr("disabled", true);$('.dlike_share_post').html('Publishing...');

        $.ajax({type: "POST",url: "/helper/submit_dlike_post.php",data: {in_url:verifyUrl,author: author,title: title,permlink: permlink,tags:post_tags,description:post_body,category: post_category,image:urlImage,exturl:urlInput},
            success: function(data) {
                try {var response = JSON.parse(data)
                    if (response.error == true) {$(".dlike_share_post").attr("disabled", false);$('.dlike_share_post').html('Publish');toastr.error(response.message);return false;
                    } else {toastr.success('Link Shared Successfully');setTimeout(function(){window.location.href = response.redirect;}, 500);}
                } catch (err) {toastr.error('Sorry. Server response is malformed.');}
            },
        });
    } else { toastr.error('You must be login with DLIKE username to share!'); return false; }
});