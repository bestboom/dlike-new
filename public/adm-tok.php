<?php
include('template/header.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
    <div class="contact-form-section">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 offset-md-1 col-md-9">
                    <div class="banner-content">
                        <h2>Share For Community</h2>
                    </div>
                    <div class="contact-form-wrap">
                                <form action="helper/my-tok.php" class="contact-form" method="POST" id="toksubmit">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="UserName" class="form-control" name="user">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input type="number" placeholder="Amount" class="form-control" name="amount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="Reason" class="form-control" name="reason">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div id="add-msg"></div>
                                        <button type="Submit" class="btn btn-default">Submit</button>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div><!-- contact-section -->
</div>    

<?php include('template/footer.php'); ?>