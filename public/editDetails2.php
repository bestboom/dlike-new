<?php include('template/header5.php'); 

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
$categories  = array("News", "Cryptocurrency", "Food", "Sports", "Technology", "LifeStyle", "Health", "Videos", "Business", "General"); 
?>
</div><!-- sub-header -->

<!--<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>-->
<script src="lib/editor/build/ckeditor.js"></script>
<style>
    body {
    /* We need to assaign this CSS Custom property to the body instead of :root, because of CSS Specificity and codepen stylesheet placement before loaded CKE5 content. */
        --ck-z-default: 100;
        --ck-z-modal: calc( var(--ck-z-default) + 999 );
    }
    .ck-content .ck-editor__editable {
        min-height: 220px;
    }
    .editmodal .ck-editor__editable {
        min-height: 80vh;
    }
    .ck-content .image>figcaption {
        display: none !important;
    }
    .ck-content .image>img {
        display: block;
        margin: 0 auto;
        max-width: 85%;
        min-width: 50px;
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
    #editor2 .ck.ck-toolbar > .ck-toolbar__items { z-index: 5590 !important; }
</style>

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
                                        <p>Need to write extended content with images? use this <a href="#" data-toggle="modal" data-target="#editorModal">editor</a></p>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" name="description" id="editor" placeholder="Write minimum 40 words on how this share is useful for community or anything relevant to, related to the subject matter discussed in the shared article."></textarea><!--<?php print $des; ?> -->
                                        </div>
                                        <button type="button" class="btn btn-default shareme" id="com-sbmt">SUBMIT</button>
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
    <!-- modal error -->
    <div class="modal fade" id="alert-modal-error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-custom modalStatus" role="document">
            <div class="modal-content modal-custom">
                <div class="modal-body ">
                    <div class="mdStatusTitle sttError"><div class="iconTitle"><i class="fas fa-frown"></i></div></div>
                    <div class="mdStatusContent"><h3 id="alert-title-error"></h3><p id="alert-content-error"></p>
                        <div class="actBtn"><button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Ok.. Let Me Do!</span></button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
<!-- Modal -->
<div class="modal editmodal fade right" id="editorModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog momodel modal-fluid" role="document">
        <div class="modal-content ">
            <div class=" modal-header text-center">
                <h5 class="modal-title w-100" id="exampleModalPreviewLabel"></h5>
                <button  type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea class="form-control" rows="5" name="editor2" id="editor2" placeholder="Write minimum 40 words on how this share is useful for community or anything relevant to, related to the subject matter discussed in the shared article."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-danger btn-md btn-rounded" data-dismiss="modal">Close</button>-->
                <button type="button" class="btn btn-success btn-md btn-rounded btn_my_templates">My Templates</button>
                <button type="button" class="btn btn-primary btn-md btn-rounded btn-move">Let's Publish</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal --> 
<div class="modal fade" id="myTemplates" style="margin-top: 10%;text-align: center;" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background: red;">
                <h4 class="modal-title">My Templates</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="template_data"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myTemplateData" style="margin-top: 10%;text-align: center;" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text mb-deck">Tmplate Name</div>
                            </div>
                            <input type="text" class="form-control template_name" name="template_name" value="">
                        </div>
                    </div>
                    <button type="button" class="btn btn-default btn_save_temp">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('template/footer.php'); ?>
<script type="text/javascript">

    let editor;
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        toolbar: {
            items: [ 
                'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'alignment', 'blockQuote', 'undo' 
                ]
        }
    } )
    .then( newEditor => {
        editor = newEditor;
    })
    .catch( error => {
        console.error( error );
    });

    let editor2;
    ClassicEditor
    .create( document.querySelector( '#editor2' ), {
        ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl: 'helper/ck_upload.php?command=QuickUpload&type=Files&responseType=json'
        },
        toolbar: {
            items: [
                    'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'horizontalLine', 'strikethrough', 'blockQuote', '|', 'indent', 'outdent', 'alignment', '|', 'imageUpload', 'insertTable', 'mediaEmbed', 'undo','redo'
            ]
        },
        language: 'en',
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:full',
                'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells'
            ]
        },
        licenseKey: '',
    })
    .then( newEditor2 => {
        editor2 = newEditor2;
        //console.log( Array.from( editor2.ui.componentFactory.names() ) );
    })
    .catch( error => {
        console.error( error );
    });       

    $(".btn-move").click(function(){
        var newcontent=editor2.getData();
        editor.setData(newcontent);
        $('#exampleModalPreview').modal('hide');
        
    });
    function stripHtml(html)
    {
        var tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }

    $(document).ready(function(){
        var steemuser = 'dlike';
        $('.btn_my_templates').click(function() {
        var datav = {steemuser: steemuser};
            $.ajax({
                type: "POST",
                url: "/helper/user_templates/user_templates.php",
                data: datav,
                
                success: function(data) {
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            $('#myTemplates').modal('show');
                            toastr.error('No template!');
                            $('#template_data').html('<p>Sorry you have no saved temmplates</p><br><button type="button" class="btn btn-primary btn-sm btn-rounded btn_save_new_temp">Save New Template</button>');
                            return false;
                        } else {
                            $('#myTemplates').modal('show');
                            toastr.success('Template exist!');
                            $('#template_data').html('<div id="loaded_template_name"> Template Name:&nbsp;<span id="my_template_name">' + response.message + '</span><br>Template Saved:&nbsp;' + response.data + '</div><br><div class="row" style="margin-top: 20px; justify-content: center;"><button type="button" class="btn btn-danger btn-sm btn-rounded btn_load_temp_content">Load</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-sm btn-rounded btn_update_temp">UPDATE</button></div>');
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
        });

        $(document).on("click", ".btn_save_temp" , function() {
            var textlength = editor2.getData().replace(/<[^>]*>|\s/g, '').length;
            if(textlength < 100) {
                toastr.error('Minimum 100 words required to save template');
                return false;
            }
            if($('.template_name').val() == "") {
                toastr.error('Please Enter Template name');
                return false;
            } else {
                var template_name = $(".template_name").val();
                var template_content = editor2.getData();
                var datat = {
                    steemuser: steemuser,
                    template_name: template_name,
                    template_content: template_content
                };
                $.ajax({
                    type: "POST",
                    url: "/helper/user_templates/user_templates_save.php",
                    data: datat,
                    
                    success: function(data) {
                        try {
                            var response = JSON.parse(data)
                            if (response.error == true) {
                                toastr.error('Template could not be saved. Please try Later!');
                                return false;
                            } else {
                                $('#myTemplateData').modal('hide');
                                $('#myTemplates').modal('hide');
                                toastr.success('Template saved successfully');
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
        });
        $(document).on("click", ".btn_save_new_temp" , function() {
            $('#myTemplateData').modal('show');
        });
        $(document).on("click", ".btn_load_temp_content" , function() {
            var datak = {
                steemuser: steemuser
            };
            $.ajax({
                type: "POST",
                url: "/helper/user_templates/user_templates_load.php",
                data: datak,
                
                success: function(data) {
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            toastr.error('Template could not be loaded. Please try Later!');
                            return false;
                        } else {
                            $('#myTemplates').modal('hide');
                            toastr.success('Template loaded successfully');
                            editor2.setData(response.data);
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
        }); 
        $(document).on("click", ".btn_update_temp" , function() {
            var textlength = editor2.getData().replace(/<[^>]*>|\s/g, '').length;
            var my_template_name = $("#my_template_name").html();
            if(textlength < 100) {
                toastr.error('Minimum 100 words required to save template');
                return false;
            }
            var updated_template_content = editor2.getData();
            var datau = {
                steemuser: steemuser,
                my_template_name: my_template_name,
                updated_template_content: updated_template_content
            };
            $.ajax({
                type: "POST",
                url: "/helper/user_templates/user_templates_update.php",
                data: datau,
                
                success: function(data) {
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            toastr.error('Template could not be updated. Please try Later!');
                            return false;
                        } else {
                            $('#myTemplates').modal('hide');
                            toastr.success('Template updated successfully');
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
        });             
    });
</script> 