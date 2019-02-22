<?php include('template/header.php'); 

$link = $_GET['link'];
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
$categories  = array("News", "Cryptocurrencygreen", "Food", "LifeStyle"); 
?>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }

        .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused) {
            border-color: #eee;
        }

        .ck.ck-editor__main > .ck-editor__editable {
            background: #eee;
        }

        .ck.ck-toolbar {
            background: #eeeeee36;
        }
    </style>

                               
    <script>
        $('.submit').click(function () {
            if ($('div.right_grid_info img').attr('src') == 'https://dlike.io/images/default-img.jpg' || '') {
                $("#freeow").freeow("Hello..", "<span style='color:#fff;'>Sorry! Image could not be captured!</span>", {
                    classes: ["smokey", "error"],
                    autoHide: true
                });
                return false;
            }
            if ($('.tags_field input').val().length === 0) {
                $("#freeow").freeow("Hello..", "<span style='color:#fff;'>Please enter related tags</span>", {
                    classes: ["smokey", "error"],
                    autoHide: true
                });
                return false;
            }
            if ($('.category_field input').val().length === 0) {
                $("#freeow").freeow("Hello..", "<span style='color:#fff;'>Please enter related category</span>", {
                    classes: ["smokey", "error"],
                    autoHide: true
                });
                return false;
            }
            var categories = $.trim($('.category_field input').val()).split(' ');
            if (categories.length > 1) {
                $("#freeow").freeow("Hello..", "<span style='color:#fff;'>Please enter only one category</span>", {
                    classes: ["smokey", "error"],
                    autoHide: true
                });
                return false;
            }
            if ($('.title_field input').val().length === 0) {
                $("#freeow").freeow("Hello..", "<span style='color:#fff;'>Please check title of the post</span>", {
                    classes: ["smokey", "error"],
                    autoHide: true
                });
                return false;
            }

        });
        ClassicEditor
            .create( document.querySelector( '#description_editor' ), {ckfinder: { uploadUrl: 'ck_uploader.php?command=QuickUpload&type=Files&responseType=json'}} )
            .then(editor => {
            //console.log( editor );
        }
        )
        .catch(error => {
            console.error(error);
        } );
    </script>
    <script>
        $(document).ready(function () {
            $('.form_wrap #exturl').prop("readonly", true);

            var categoryField = document.getElementById("cat");
            categoryField.addEventListener('keypress', function ( event ) {
                var key = event.which;
                if (key === 32) {
                    event.preventDefault();
                }
            });
        });
    </script>


<div class="container">
            <div class="row">
                <div class="col">
                    <div class="subheader-wrapper">
                        <h3>Contact Us</h3>
                        <p>
                            Many desktop publishing packages and web page editors now use <br>
                            Lorem Ipsum as their default model text
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sub-header -->
    <div class="contact-form-section" style="margin-top: 100px;">
        <div class="container d-flex h-100">
            
            <div class="contact-info-outer">
                <div class="contact-info-wrap">
                    <div class="row align-items-center h-100">
                        <div class="col-md-6">
                            <div class="row">

                                <div class="user-connected-form-block">
                                    <form class="user-connected-from user-signup-form" method="post" action="helper/submit_post.php">
                                    	<input type="hidden" name="image" value="<?php print $img; ?>">
                                        <div class="form-group">
                                        	<div class="input-group mb-3">
                                        		<div class="input-group-prepend">
                                            		<div class="input-group-text mb-deck"> Title</div>
                                        		</div>
                                            	<input type="text" class="form-control" name="title" value="<?php print $title; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="input-group mb-3">
                                        		<div class="input-group-prepend">
                                            		<div class="input-group-text mb-deck"> Link</div>
                                        		</div>
                                            	<input type="text" class="form-control" disabled="true" name="exturl" id="exturl" value="<?php print $url; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col">
                                                <select class="form-control form-control-lg" id="cats">
                                            	<?php foreach ($categories as $category){ ?>
                                                	<option value="<?php echo $category;?>"><?php echo $category;?></option>	
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-control form-control-lg" id="rewards">
                                                	<option>Reward Option</option>
                                                	<option>50% SBD and 50% SP</option>
                                                    <option>100% Steem Power</option>
                                                    <option>Declined</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="input-group mb-3">
                                        		<div class="input-group-prepend">
                                            		<div class="input-group-text mb-deck"> Tags</div>
                                        		</div>
                                        		<input type="text" class="form-control" name="tags" value="" placeholder="Enter tags with spaces">
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" id="description_editor" placeholder="Description"><?php print $des; ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">SUBMIT</button>
                                    </form>
                                </div><!-- create-account-block -->

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="contact-info-block">
                                    <div class="contact-info-inner">
                                        <img class="img-fluid d-flex h-100 flex-column" src="<?php $imgUrl = $img != 'null' ? $img : "https://dlike.io/images/default-img.jpg"; print $imgUrl; ?>" alt="dlike"/>
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