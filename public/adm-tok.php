<?php
include('template/header.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["name"]) && isset($_POST["amount"]) && isset($_POST["reason"])){


}
?>
    <div class="contact-form-section">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 offset-md-1 col-md-9">
                    <h2>Share For Community</h2>
                    <div class="contact-form-wrap">
                                <form action="" class="comment-form" method="POST">
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
                                                <textarea placeholder="Reason" class="form-control" name="reason"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-default">Submit</button>
                                </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div><!-- contact-section -->
</div>    

<?php include('template/footer.php'); ?>