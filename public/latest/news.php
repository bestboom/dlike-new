<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../includes/config.php');
include('../latest/main.php');  
$link = $_GET['link'];
$news_id = $_GET['id'];
$news_category = $_GET['category'];
$sql1 = "SELECT * FROM latestnews where id='$news_id'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) 
    {
      	$post_data = mysqli_fetch_assoc($result1); 
		$post_title = $post_data["title"];
		$post_ext_link = $post_data["ext_link"];
    } 
    $url = $post_ext_link;
    $grab = new DataGraber($url);
    if (!empty($grab->getTitle()) && !empty($grab->getThumbnail())){
		$image = $grab->getThumbnail();
		$description = $grab->getDescription();
    }
$og_title = $post_title;
$og_description = $description;
$og_image = $image;
$uri = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$og_url = $uri;
include('../template/news-header.php');
  
?>
</div><!-- sub-header -->
<style>
  .faq-section{background: #e6e6e6;}
  .news-set {max-width: 1366px;background: #fff;padding: 40px 15px 15px 15px;}
  .news-detail{color: #202020;font-family: Verdana,Arial,Helvetica,sans-serif;font-size: 1rem;font-weight: 500;line-height: 2.2;text-decoration: underline;}
  .news-detail a:hover {color: #86828C;}
  .title {font-size: 1.5rem;font-weight: 600;letter-spacing: -0.5px;line-height: 1.3;}
</style>
<div class="container" style="background: #191d5d;max-width: 100% !important;">
    <div class="row" style="padding: 25px;">
        <div class="col" style="text-align:center;color: #fff;">
            <h3>Latest News</h3>
        </div>
    </div>
</div>
    <div class="faq-section" style="padding-top:1px;padding-bottom: 0px;">
        <div class="container news-set">
            <div class="row" style="margin: 0px">
            <?php 
                ?>
                <div class="col-md-8">
	                <h2 class="title"><?php echo $post_title;?></h2>
	                <br>
	                <img src="<?php echo $image;?>" style="width:100%">
	                <br>
	                <p style="padding-top: 15px;"><?php echo $description; ?></p>
	                <p style="font-weight: bold">
	                	<a href="<?php echo $post_ext_link; ?>" target="_blank">Continue Reading <?php echo $post_title;?></a>
	                </p>
	            </div>
	            <div class="col-md-4">
	            	<div style="width:100%;background: #c51d24;padding: 15px;color: #fff;font-size: 1.3rem;font-weight: 600;text-align: center;">Share on DLIKE to Get Rewarded<br><span>STEEM + DLIKER Upvotes</span><br><span>Daily Reward Pool</span><br><button style="background-color: #fff;color: #373f59;border: 2px solid transparent;border-radius: 32px;font-size: 18px;">Share Now</button></div>
	            	<div style="margin-top: 25px;"><span style="border-bottom: 1px solid #111;">Latest <?php echo $news_category; ?> News</span></div>
	            </div>
            </div>
        </div>
    </div>
<?php include('../template/news-footer.php'); ?>