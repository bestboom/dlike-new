<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('template/header5.php');
$categories  = array("News", "Cryptocurrency", "Food", "Sports", "Technology", "LifeStyle", "Health", "Videos", "Business", "General"); 
?>
</div>
<style>
    body {
    	background: #f4f4f4;
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
<script src="lib/editor/build/ckeditor.js"></script>
<div class="container" style="padding-top: 20px;background: #fff;border: 1px solid #eee;">
	<div class="row">
		<div class="contact-form-section" style="margin-top: 30px;">
            <div class="row align-items-center h-100">
                <div class="user-connected-form-block">
                    <form class="user-connected-from user-signup-form" method="post" action="helper/submit_post.php">
                        <input type="hidden" name="image" value="">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck"> Title</div>
                                </div>
                                <input type="text" class="form-control title_field" name="title" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="20" name="description" id="editor2" placeholder=""></textarea>
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
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck"> Featured Image Link</div>
                                </div>
                                <input type="text" readonly="readonly" class="form-control" name="featured_image" value="">
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
                        <br>
                        <button type="button" class="btn btn-default shareme" id="com-sbmt">SUBMIT</button>
                        <button type="button" class="btn btn-success btn-md btn-rounded btn_my_templates">My Templates</button>
						<button type="button" class="btn btn-primary btn-md btn-rounded btn_move">Let's Publish</button>
                    </form>
                </div><!-- create-account-block -->
            </div>
		</div><!-- contact-section -->
    </div>
</div>
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
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text mb-deck">Tmplate Name</div>
                            </div>
                            <input type="text" class="form-control template_name" name="template_name" value="">
                        </div>
                    </div>
                    <button type="button" class="btn btn-default btn_save_temp">Save</button>
            </div>
        </div>
    </div>
</div>


<?php include('template/footer.php'); ?>
<script type="text/javascript">
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

    $(document).ready(function(){
        var steemuser = username;
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
