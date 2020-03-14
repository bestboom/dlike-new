<?php 
include('template/header5.php'); 
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

    <div class="contact-form-section" style="margin-top: 100px;">
        <div class="container d-flex h-100">
            <div class="contact-info-outer">
                <div class="contact-info-wrap">
                    <div class="row align-items-center h-100">
                        <div class="col-md-6">
                            <div class="row">

                                <div class="user-connected-form-block">
                                    <form class="user-connected-from user-signup-form" method="post" action="">
                                        <input type="hidden" name="image" value="<?php print $img; ?>">
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
                                                <select class="form-control form-control-lg" name="reward_option" id="rewards">
                                                    <option>Reward Options</option>
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
                                            <textarea class="form-control" rows="5" name="description" id="editor" placeholder="Write minimum 40 words on how this share is useful for community or anything relevant to, related to the subject matter discussed in the shared article."></textarea><!--<?php print $des; ?> -->
                                        </div>
                                        <button type="button" class="btn btn-default shareme2" id="com-sbmt">SUBMIT</button>
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
   
<?php include('template/footer.php'); ?>
<script type="text/javascript">

let editor;
ClassicEditor
    .create( document.querySelector( '#editor' ), {
        alignment: {
            options: [ 'left', 'right' ]
        },
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote','alignment', 'undo', 'redo' ],
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

    $('.shareme2').click(function(clickEvent) {
        if (username != null) {
            let urlInput = '<?php echo $url; ?>';
            let verifyUrl = getDomain(urlInput);

            if (verifyUrl.match(/prosportsdaily.com/g) || (/steemit.com.com/g)) {
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
                url: '/helper/check_share.php',
                type: 'post',
                dataType: 'json',
                data: { url: url },
                success: function(response) {
                    console.log(response);
                    if (response.status === false) {
                        toastr['error'](response.message);
                        return false;
                    } else {
                        $.ajax({
                            url: '/helper/check_pro.php',
                            type: 'post',
                            dataType: 'json',
                            data: { user: username },
                            success: function(response) {
                                console.log(response);
                                if (response.status === false) {
                                        toastr['error'](response.message);
                                        return false;
                                } else { 
                                    $('form').submit();
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