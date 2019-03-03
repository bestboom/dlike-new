<?php include('template/header.php'); ?>
    <div class="contact-form-section">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 offset-md-1 col-md-9">
                    <div class="contact-form-wrap">
                        <form class="contact-form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" id="url_field" required="true" placeholder="Enter URL">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="button" class="btn btn-default" id="share"><i class="fas fa-spinner fa-spin loader" style="display:none;"></i><span id="plus">Share</span></button>
                            </div>
                        </form><!-- contact-form -->
                    </div>
                </div>
            </div>
            
        </div>
    </div><!-- contact-section -->
<?php include('template/footer.php'); ?>