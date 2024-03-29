<?php include('includes/config.php'); include('template/header.php'); 
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
} else { die('Not Allowed');} ?>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
<style>
    .ck-editor__editable {
        min-height: 200px;
    }

    .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused) {
        border-color: #c4c4c4;
    }

    .ck.ck-editor__main > .ck-editor__editable {
        background: #fff;
        border-color: #111;
    }

    .ck.ck-toolbar {
        background: #eeeeee36;
    }
    .user-connected-form-block p {
        text-align: left !important;
        padding: 1px 8px;
    }
</style>
<div class="latest-post-section">
    <div class="contact-form-section" style="margin-top: 100px;">
        <div class="container d-flex h-100">
            <div class="contact-info-outer">
                <div class="contact-info-wrap">
                    <div class="row align-items-center h-100">
                        <div class="col-md-6">
                            <div class="row">

                                <div class="user-connected-form-block">
                                    <form class="user-connected-from user-signup-form">
                                        <input type="hidden" name="image" class="image_field" value="<?php print $img; ?>">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text mb-deck"> Title</div>
                                                </div>
                                                <input type="text" class="form-control title_field" name="title" value="<?php print $title; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text mb-deck"> Link</div>
                                                </div>
                                                <input type="text" readonly="readonly" class="form-control" name="exturl" value="<?php print $url; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col">
                                                <select class="form-control form-control-lg catg" name="category">
                                                    <option value="0">Select Category</option>
                                                <?php foreach ($categories as $category){ ?>
                                                    <option value="<?php echo $category;?>"><?php echo $category;?></option>    
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-control form-control-lg rewards" name="reward_option" id="rewards">
                                                    <option value="1">50% SBD and 50% SP</option>
                                                    <option value="2">100% Steem Power</option>
                                                    <option value="3">Declined</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text mb-deck"> Tags</div>
                                                </div>
                                                <input type="text" class="form-control tags" name="tags" value="" placeholder="Enter tags with spaces">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" name="description" id="editor" placeholder="Write minimum 40 words on how this share is useful for community or anything relevant to, related to the subject matter discussed in the shared article."></textarea>
                                        </div>
                                        <button type="button" class="btn btn-default shareme2">Publish</button>
                                    </form>
                                </div><!-- create-account-block -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="contact-info-block">
                                    <div class="contact-info-inner">
                                        <img class="img-fluid d-flex flex-column" src="<?php $imgUrl = $img != 'null' ? $img : "https://dlike.io/images/default-img.jpg"; print $imgUrl; ?>" alt="dlike"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- contact-section -->
</div>
<?php include('template/footer.php'); ?>
<script type="text/javascript">

let editor;
ClassicEditor
    .create( document.querySelector( '#editor' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
            ]
        }
    } )
    .then( newEditor => {
        editor = newEditor;
    })
    .catch( error => {
        console.error( error );
    });

    function stripHtml(html)
    {
        var tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }   
</script>
<script type="text/javascript">
    function getHostName(url) {
        var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
        if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
            return match[2];
        } else {
            return null;
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
    const $inputTags = document.querySelector(".tags");
    const tags_check = /[a-zA-Z0-9 \/]+/;
    $inputTags.addEventListener("keypress", e => {
      console.log(e);
      if (!tags_check.test(e.key)) {
        e.preventDefault();
        toastr.error('Characters not allowed. Only tags separated by space.');
      }
    });
    $('.shareme2').click(function(clickEvent) {
        if (username != null) {
            //console.log(username);
            let urlInput = '<?php echo $url; ?>';
            let verifyUrl = getDomain(urlInput);

            if (verifyUrl.match(/prosportsdaily.com/g) || verifyUrl.match(/steemit.com/g)) {
                toastr.error('phew... Sharing from this url is not allowed');
                return false;
            }

            let text_words = stripHtml(editor.getData()).trim().split(/\s+/)
            if (text_words.length < 40) {
                toastr.error('Please Write minimum 40 words to explain this share!');
                return false;
            }

            if ($('.catg').val() == "0") {
                $('.catg').css("border-color", "RED");
                toastr.error('Please Select an appropriate Category');
                return false;
            }

            // tag check
            var tags = $('.tags').val();
            tags = $.trim(tags);
            tags = tags.split(' ');

            if (tags.length < 2) {
                $('.tags').css("border-color", "RED");
                toastr.error('Please add at least two related tags');
                return false;
            }
            if ($('.title_field').val() == "") {
                toastr.error('Title Should not be empty!');
                return false;
            }

            $.ajax({
                url: '/helper/steem/check_pro.php',
                type: 'post',
                dataType: 'json',
                data: { user: username },
                success: function(response) {
                    //console.log(response);
                    if (response.error === true) {
                            toastr['error'](response.data);
                            return false;
                    } else {
                        $.ajax({
                            url: '/helper/steem/check_share.php',
                            type: 'post',
                            dataType: 'json',
                            data: { url: urlInput },
                            success: function(response) {
                                //console.log(response);
                                if (response.error == true) {
                                    toastr['error'](response.data);
                                    return false;
                                } else { 
                                    /*var datam = {
                                        title: $('.title_field').val(),
                                        tags: $('.tags').val(),
                                        description: editor.getData(),
                                        category: $('.catg').val(),
                                        image: $('.image_field').val(),
                                        rewards: $('.rewards').val(),
                                        exturl:urlInput
                                    };*/
                                    var parentAuthor = "";
                                    var parentPermlink = 'hive-116221';
                                    var author = username;
                                    var title = $('.title_field').val();
                                    var permlink = title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
                                    var urlImage =  $('.image_field').val();
                                    var added_tags = $('.tags').val();
                                    var vtags = added_tags.replace(/([a-zA-Z0-9-]+)/g, "\"$1\"");
                                    var qtags = vtags.replace(/\s+/g, ', ').toLowerCase();
                                    var description = editor.getData();
                                    var post_body = description.replace(/[\u2018\u2019]/g, "'").replace(/[\u201C\u201D]/g, '"');
                                    var body = '<center><img src="'+urlImage+'" alt="Shared From DLIKE" /></center><br>'+post_body+'<br><center><br><a href="https://dlike.io/post/@' + author + '/' + permlink+'">Shared On DLIKE</a><hr><br><a href="https://dlike.io/"><img src="https://dlike.io/images/dlike-logo.jpg"></a></center>';
                                    var post_category = $('.catg').val();
                                    var post_tags = '["hive-116221", "dlike", '+ qtags +']';
                                    var meta_tags = JSON.parse(post_tags);
                                    var jsonMetadata = {
                                        "tags": meta_tags,
                                        "app": "dlike/3",
                                        "community": "dlike",
                                        "format": "html",
                                        "image": urlImage,
                                        "url": urlInput,
                                        "type": "share",
                                        "body": post_body,
                                        "category": post_category
                                    };
                                    
                                    //console.log(jsonMetadata)
                                    $(".shareme2").attr("disabled", true);
                                    $('.shareme2').html('Publishing...');
                                    /*
                                    api.comment(parentAuthor, parentPermlink, author, permlink, title, body, jsonMetadata, function (err, res) {
                                        //console.log(err, res)
                                        if(!err) {
                                            toastr.success('Post published successfully');
                                            setTimeout(function(){
                                                window.location.href = "https://dlike.io/post/@" + author + "/" + permlink;
                                            }, 5000);
                                        } else {
                                            $(".shareme2").attr("disabled", false);
                                            $('.shareme2').html('Publish');
                                            toastr.error('There is some issue!');
                                            return false;
                                        }
                                    }); */
                                    var datam = {
                                        title: title,
                                        permlink: permlink,
                                        tags: $('.tags').val(),
                                        meta_body: post_body,
                                        main_body: body,
                                        category: $('.catg').val(),
                                        image: $('.image_field').val(),
                                        rewards: $('.rewards').val(),
                                        exturl:urlInput
                                    };
                                    $.ajax({
                                        type: "POST",
                                        url: "/helper/steem/submit_post.php",
                                        data: datam,
                                        
                                        success: function(data) {
                                            console.log(data);
                                            try {
                                                var response = JSON.parse(data)
                                                if (response.error == true) {
                                                    $(".shareme2").attr("disabled", false);
                                                    $('.shareme2').html('Publish');
                                                    toastr.error(response.message);
                                                    return false;
                                                } else {
                                                    toastr.success('Post published successfully');
                                                    setTimeout(function(){
                                                        window.location.href = response.redirect;
                                                    }, 5000);
                                                }
                                            } catch (err) {
                                                toastr.error('Sorry. Server response is malformed.');
                                            }
                                        },
                                        error: function(xhr, textStatus, error) {
                                            console.log(xhr.statusText);
                                            console.log(textStatus);
                                            console.log(error);
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            });
        } else { toastr.error('You must be login to share!'); return false; }
        //$('form').submit();
    });

</script>