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
$categories  = array("News", "Cryptocurrency", "Food", "Sports", "LifeStyle", "Videos"); 
?>
<div class="container">
            <div class="offset-md-2 col-md-8">
                <div class="banner-content">
                    <h2>Share For Community</h2>
                    <p>Share only useful content for community <br>Selfies and personal spamming not allowed</p>
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
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" name="description" placeholder="Description"><?php print $des; ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default shareme">SUBMIT</button>
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
<?php include('template/footer.php'); ?>