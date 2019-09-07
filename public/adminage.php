<?php
if($_COOKIE['username'] != 'dlike'){die('<script>window.location.replace("https://dlike.io","_self")</script>');};
include('template/header5.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
    <div class="contact-form-section">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 offset-md-1 col-md-9">
                    <div class="banner-content">
                        <h2>Dlike Admin</h2>
                    </div>
                    <div class="contact-form-wrap">
                                <form action="helper/my-tok.php" class="contact-form" method="POST" id="toksubmit">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="UserName" class="form-control" name="user" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input type="number" placeholder="Amount" class="form-control" name="amount" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="Reason" class="form-control" name="reason" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div id="add-msg"></div>
                                    <div class="row justify-content-center">
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