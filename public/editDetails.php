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

$categorires = [];
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
    <div class="main-container fixed-top-padding cont-sec" style="background:#e4e4e4;">
        <div class="container" style="margin-top: 0.1%;position:relative;">
            <div id="man-cont">

                <form class="form_wrap" method="post" action="submit_post.php" style="margin-top: 0px;">
                    <div class="agile_info row">
                        <div class="w3_info contact-form col-md-6" style="padding-bottom: 0px;">
                            <div class="ui form">
                                

                                <div class="field">
                                    <label>Add To Community</label>
                                    <div class="ui transparent input category_field">
                                        <input type="text" name="category" list="cats" value="" id='cat'
                                               placeholder="Like food, news, sports, do not write dlike">
                                        <datalist id="cats">
                                            <?php foreach ($categories

                                            as $category){ ?>
                                            <option value="<?php echo $category; ?>">
                                                <?php } ?>
                                        </datalist>
                                    </div>
                                    <div class="ui inverted divider"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="agile_info">
                                <div class="w3_info"
                                     style="flex-basis: 100%; -webkit-flex-basis: 100%; padding-top: 0px;">
                                    <div class="ui form">
                                        <div class="field">
                                            <label>Description</label>
                                            <textarea class="_b" rows="2" name="post" id="description_editor"
                                                      placeholder="Enter Description"><?php print $des; ?></textarea>
                                        </div>
                                        <div class="field" style="width: 50%; margin-top: 20px;">
                                            <label>Reward</label>
                                            <div class="ui transparent input category_field">
                                                <input type="text" name="category" list="rewards" value="" id='cat'
                                                       placeholder="Reward Options">
                                                <datalist id="rewards">
                                                    <option value="50% SBD and 50% SP">
                                                    <option value="100% Steem Power">
                                                    <option value="Declined">
                                                </datalist>
                                            </div>
                                            <div class="ui inverted divider"></div>
                                        </div>
                                        <div class="field ui clearing">
                                            <div class="ui">

                                                <button class="ui right floated medium orange button submit btn-primary"
                                                        type="submit" style="background:rgb(173, 31, 35);">Submit
                                                </button>

                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black; font-size: 16px; ">Schedule Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p style="font-size: 13px;">A scheduled post will be automatically published after the specified interval.</p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 14px;">Select Date:</span>
                        <input type="date" min="<?=date("Y-m-d");?>" class="select_date" style="width: 100%;">
                    </div>
                    <div class="col-md-6">
                        <span style="font-size: 14px;">Select Time:</span>
                        <input type="time" min="<?=date("H:i")?>" class="select_time" style="width: 100%;">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
                type="submit" data-dismiss="modal" style="background:rgb(173, 31, 35);  background-color: #DDDDDD; border: 1px solid #DDDDDD; border-radius: 5px; padding: 6px 16px; cursor: pointer;"><i class="fas fa-times"></i> CANCEL
            </button>
            <button
                    type="button" class="btn_schedule" style="background:rgb(173, 31, 35); border-radius: 5px; padding: 6px 16px; cursor: pointer;"><i class="far fa-calendar-alt"></i> SCHEDULE
            </button>
          </div>
        </div>
      </div>
    </div>
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
                                    <form class="user-connected-from user-signup-form">
                                    	<input type="hidden" name="image" value="<?php print  $img; ?>">
                                        <div class="form-group">
                                            <input type="text" name="title" value="<?php print $title; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="exturl" id="exturl" value="<?php print $url; ?>">
                                        </div>
                                        <div class="row form-group">
                                            <div class="col">
                                                <select class="form-control form-control-lg">
                                                    <option>Select Category</option>
                                                    <option>USA</option>
                                                    <option>UK</option>
                                                    <option>UAE</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-control form-control-lg">
                                                    <option>Reward Option</option>
                                                    <option>USA</option>
                                                    <option>UK</option>
                                                    <option>UAE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<input type="text" name="tags" value="" placeholder="Enter tags with spaces">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" id="comment" placeholder="Description"></textarea>
                                        </div>
                                    </form>
                                </div><!-- create-account-block -->

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="contact-info-block">
                                    <div class="contact-info-inner">
                                        <img class="img-fluid" src="<?php $imgUrl = $img != 'null' ? $img : "https://dlike.io/images/default-img.jpg"; print $imgUrl; ?>" alt="dlike"/>
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