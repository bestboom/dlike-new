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
            <div class="contact-info-outer" style="display: none;">
                <div class="contact-info-wrap">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="map-block" id="map_block"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="contact-info-block">
                                    <div class="contact-info-inner">
                                        <h4>Contact Info</h4>
                                        <ul class="contact-info-list">
                                            <li>
                                                <img src="./images/others/25.png" alt="img" class="img-responsive">
                                                <p>
                                                    558 Rathdowne Road Miracel Carlton, 
                                                    Victoria 4500
                                                </p>
                                            </li>
                                            <li>
                                                <img src="./images/others/26.png" alt="img" class="img-responsive">
                                                <p>
                                                    supportexcoin@gmail.com
                                                    excoincompany@yourmail.com
                                                </p>
                                            </li>
                                            <li>
                                                <img src="./images/others/27.png" alt="img" class="img-responsive">
                                                <p>
                                                    +33 08 5584 566 88
                                                </p>
                                            </li>
                                        </ul>
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