<?php 
include('template/header7.php'); 
include('functions/categories.php'); 
if (isset($_GET["url"])) {
    $decode = function ($data) {
        return rawurldecode($data);
    };
    $url = $_GET["url"];
    $img = $_GET["imgUrl"];
    $title = $_GET["title"];
    $des = $_GET["details"];
    $url = strip_tags(htmlspecialchars(trim($decode($url))));
    $img = strip_tags(htmlspecialchars(trim($decode($img))));
    $title = strip_tags(htmlspecialchars(trim($decode($title))));
    $des = strip_tags(htmlspecialchars(trim($decode($des))));
} else { die('Not Allowed');}

?>
</div><!-- sub-header -->
<style>
    .data-title {font-weight: 500;white-space: nowrap;padding-top: 3px;padding-right: 5px;overflow: hidden;text-overflow: ellipsis;font-weight: 600;margin-bottom: 0px;}
    .hov_vote{margin-top: -3px;}.post-style-two .post-entry{margin-bottom: 5px;padding-bottom: 5px;}
    .link_bottom{display: flex;justify-content: space-between;}
    .link_image{border-radius: 20px 20px 0px 0px;max-height: 340px;min-width: 100%;}
    .data-desc{margin-bottom: 4px;line-height: 1.5em;height: 3em;overflow: hidden;}
</style>
        <div class="container">
            <div class="user-login-signup-form-wrap" style="margin-top: 30px;margin-bottom: 40px;">
                <div class="modal-content" style="border:none;">
                    <div class="modal-body">
                        <input type="hidden" name="image" class="image_field" value="<?php print $img; ?>">
                        <img class="img-fluid d-flex flex-column link_image" src="<?php $imgUrl = $img != 'null' ? $img : "https://dlike.io/images/default-img.jpg"; print $imgUrl; ?>" alt="dlike"/>
                        <div class="modal-info-block" style="border: 1px solid rgba(0,0,0,.2);padding: 10px;border-radius: 0px 0px 10px 10px;">
                            <p class="data-title"><?php print $title; ?></p>
                            <p class="data-desc"><?php print $des; ?></p>
                            <div class="link_bottom">
                                <p style="margin-bottom: 1px;"><i class="fas fa-link" style="padding-right: 5px;color: #c3bbb2;font-size: 12px;"></i><span id="domain_name"></span></p>
                                <select style="border:none;" name="category" class="dlike_cat">
                                    <option value="0">Select Category</option>
                                <?php foreach ($categories as $category){ ?>
                                    <option value="<?php echo $category;?>"><?php echo $category;?></option>    
                                <?php } ?>
                                </select>
                            </div>
                            <div style="display: flex;justify-content: space-between;margin-top:9px">
                                <input type="text" placeholder="Tags separated by space" style="width: 60%;border: none;;color: rgb(27, 149, 224);" class="dlike_tags" />
                                <button type="button" class="btn btn-primary dlike_share_post" style="background-color: #c51d24;border-color: #c51d24;">SHARE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
<?php include('template/dlike_footer.php'); ?>

<script type="text/javascript">
const $input = document.querySelector(".dlike_tags");
const tags_check = /[a-zA-Z0-9 \/]+/;
$input.addEventListener("keypress", e => {
  console.log(e);
  if (!tags_check.test(e.key)) {
    e.preventDefault();
    toastr.error('Characters not allowed. Only tags separated by space.');
  }
});
</script>
<script type="text/javascript">
    function getHostName(url) {
        var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
        if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
            return match[2];
        } else {
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
    let url_submitted = '<?php echo $url; ?>';
    console.log(url_submitted);
    let domain_name = getDomain(url_submitted);
    $('#domain_name').html(domain_name);
    $('.dlike_share_post').click(function(clickEvent) {
        if (dlike_username != null) {
            console.log(dlike_username);
            let urlInput = '<?php echo $url; ?>';
            console.log(urlInput);
            let verifyUrl = getDomain(urlInput);

            if (verifyUrl.match(/cointelegraph.com/g) || verifyUrl.match(/steemit.com/g)) {
                toastr.error('phew... Sharing from this url is not allowed');
                return false;
            }
            if ($('.dlike_cat').val() == "0") {
                $('.dlike_cat').css("border-color", "RED");
                toastr.error('Please Select an appropriate Category');
                return false;
            }
            // tag check
            var tags = $('.dlike_tags').val();
            tags = $.trim(tags);
            tags = tags.split(' ');

            if (tags.length < 2) {
                $('.tags').css("border-color", "RED");
                toastr.error('Please add at least two related tags');
                return false;
            }
            var author = dlike_username;
            console.log(author);
            var title = $('.data-title').html();
            console.log(title);
            var permlink = title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').replace(/-+/g,'-').toLowerCase();
            console.log(permlink);
            //var urlImage =  $('.image_field').val();
            var tags = $('.dlike_tags').val();
            console.log(tags);
            var post_tags = $.trim(tags).replace(/\s+/g, ' ');
            console.log(post_tags);
            //var vtags = added_tags.replace(/([a-zA-Z0-9-]+)/g, "\"$1\"");
            //console.log(vtags);
            //var qtags = vtags.replace(/\s+/g, ', ').toLowerCase();
            //console.log(qtags);
            var description = $('.data-desc').html();
            console.log(description);
            var post_body = description.replace(/[\u2018\u2019]/g, "'").replace(/[\u201C\u201D]/g, '"');
            console.log(post_body);
            var urlImage =  $('.image_field').val();
            console.log(urlImage);
            //var body = '<center><img src="'+urlImage+'" alt="Shared From DLIKE" /></center><br>'+post_body+'<br><center><br><a href="https://dlike.io/post/@' + author + '/' + permlink+'">Shared On DLIKE</a><hr><br><a href="https://dlike.io/"><img src="https://dlike.io/images/dlike-logo.jpg"></a></center>';
            //console.log(body);
            var post_category = $('.dlike_cat').val();
            console.log(post_category);

            $(".dlike_share_post").attr("disabled", true);
            $('.dlike_share_post').html('Publishing...');

            var data = {
                author: author,
                title: title,
                permlink: permlink,
                tags: post_tags,
                description: post_body,
                category: post_category,
                image: urlImage,
                exturl:urlInput
            };

            $.ajax({
                type: "POST",
                url: "/helper/post/submit_dlike_post.php",
                data: data,
                success: function(data) {
                    //console.log(data);
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            $(".dlike_share_post").attr("disabled", false);
                            $('.dlike_share_post').html('Publish');
                            toastr.error(response.message);
                            return false;
                        } else {
                            toastr.success('Link Shared Successfully');
                            setTimeout(function(){
                                window.location.href = response.redirect;
                            }, 500);
                        }
                    } catch (err) {
                        toastr.error('Sorry. Server response is malformed.');
                    }
                },
            });
            
        } else { toastr.error('You must be login to share!'); return false; }
    });
</script>