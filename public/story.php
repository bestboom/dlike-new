<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('template/header5.php');
$categories  = array("News", "Cryptocurrency", "Food", "Sports", "Technology", "LifeStyle", "Health", "Videos", "Business", "General"); 
?>
</div>
<script src="lib/editor/build/ckeditor.js"></script>
<style>
    body {
    	background: #f4f4f4;
    /* We need to assaign this CSS Custom property to the body instead of :root, because of CSS Specificity and codepen stylesheet placement before loaded CKE5 content. */
        --ck-z-default: 100;
        --ck-z-modal: calc( var(--ck-z-default) + 999 );
    }
    .ck-content .ck-editor__editable {
        min-height: 50vh !important;
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
    .ck-editor__editable_inline {
        min-height: 50vh;
    }
    .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused) {
        border-color: #c4c4c4;
        min-height: 50vh !important;
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
    .mb-deck {color: #111;font-weight: 600;background:#eee;}
</style>
<div class="container" style="padding-top: 20px;background: #fff;border: 1px solid #eee;">
	<div class="row">
		<div class="contact-form-section" style="margin-top: 30px;width: 100%">
            <div class="align-items-center h-100">
                <div class="user-connected-form-block" style="padding: 40px 80px 45px 80px;">
                    <form class="user-connected-from user-signup-form" method="post" action="helper/submit_story.php">
                        <div id="aq"></div>
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
                                <input type="text" class="form-control" name="featured_image" value="">
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
                        <br>
                        <div class="row" style="justify-content: space-between;margin: 0px;">
                        	<button type="button" class="btn btn-primary btn-md btn-rounded btn_my_templates">My Templates</button>
							<button type="button" class="btn btn-primary btn-md btn-rounded submit_story">Publish</button>
						</div>
                    </form>
                </div><!-- create-account-block -->
            </div>
		</div><!-- contact-section -->
    </div>
</div>
<div class="modal fade" id="myTemplates" style="margin-top: 10%;text-align: center;" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background: #c51d24;color: #f5f5f5;">
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
            <div class="modal-header" style="background: #c51d24;color: #f5f5f5;">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/3.3.0/lodash.min.js"></script>
<script type="text/javascript">
    let editor2;
    ClassicEditor
    .create( document.querySelector( '#editor2' ), {
        ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl: 'helper/image_upload/ck_upload.php?command=QuickUpload&type=Files&responseType=json'
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
    function stripHtml(html)
    {
        var tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }
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

        $('.submit_story').click(function(clickEvent) {

            if ($('.title_field').val() == "") {
                toastr.error('Title Should not be empty!');
                return false;
            }

            var tags = $('.tags').val();
            tags = $.trim(tags);
            tags = tags.split(' ');

            if (tags.length < 2) {
                $('.tags').css("border-color", "RED");
                toastr.error('Please add at least two related tags');
                return false;
            }
            if ($('.catg').val() == "0") {
                $('.catg').css("border-color", "RED");
                toastr.error('You must Select an appropriate Category');
                return false;
            }
            let text_words = stripHtml(editor2.getData()).trim().split(/\s+/);
            if (text_words.length < 40) {
                toastr.error('It seems you forgot to write story!');
                return false;
            }
            var main_story = editor2.getData();
            var elem = document.createElement('div');
            elem.style.display = 'none';
            document.body.appendChild(elem);
            elem.innerHTML = main_story;
            //console.log(elem.querySelector('img').src);
            //var first_image = elem.querySelector('img').src;
            
            if ((elem.querySelector('img').src) == null) {
                toastr.error('There is no image in story. Please add featured image link');
                return false;
            } else { 
                first_image = elem.querySelector('img').src;
            }
            //$('form').submit();
            var datam = {
                story_title: $('.title_field').val(),
                story_tags: $('.tags').val(),
                story_content: editor2.getData(),
                story_category: $('.catg').val(),
                story_image: first_image,
                story_rewards: $('.rewards').val()
            };
            console.log(datam);
            $.ajax({
                type: "POST",
                url: "/helper/submit_story.php",
                data: datam,
                
                success: function(data) {
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            toastr.error('There is some issue');
                            return false;
                        } else {
                            toastr.success('Story published successfully');
                            $('#aq').html(response.data);
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
