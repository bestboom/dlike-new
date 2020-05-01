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
		$post_source = $post_data["resource"];
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
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$uri = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$og_url = $uri;
include('../template/news-header.php');
include('../functions/main.php');
?></div><!-- sub-header -->
<div class="container" style="background: #191d5d;max-width: 100% !important;">
    <div class="row" style="padding: 25px;"><div class="col" style="text-align:center;color: #fff;"><h3>Latest <?php echo ucfirst($news_category); ?> News</h3></div></div>
</div>
<div class="faq-section" style="padding-top:1px;padding-bottom: 0px;"><div class="container news-set"><div class="row" style="margin: 0px">
    <div class="col-md-8">
        <div class="row" style="margin: 2px;font-size: 0.85rem;color: #c51d24;"><a href="/latest">Latest News </a> &nbsp; > &nbsp; <a href="/latest/<?php echo $news_category; ?>"> <?php echo ucfirst($news_category); ?></a></div>
        <h2 class="title"><?php echo $post_title;?></h2><hr style="margin-top: 1px; margin-bottom: 5px;background-color: #202020;">
        <span class="row" style="margin:0px;margin-bottom: 10px;font-size: 0.8rem;font-weight: 600;">By <?php echo $post_source; ?> | <?php echo ucfirst($news_category); ?> </span>
        <img src="<?php echo $image;?>" style="width:100%"><br>
        <p style="padding-top: 15px;"><?php echo $description; ?></p>
        <p style="font-weight: bold"><a href="<?php echo $post_ext_link; ?>" target="_blank">Continue Reading <?php echo $post_title;?></a></p>
    </div>
    <div class="col-md-4">
    	<div style="width:100%;background: #c51d24;padding: 15px;color: #fff;font-size: 1.3rem;font-weight: 600;text-align: center;">
    		<span style="padding-bottom: 20px;">Share on DLIKE to Get Rewarded</span><br>
    		<span style="font-size: 1.1rem;padding: 10px;">STEEM + DLIKER Upvotes</span><br><span style="font-size: 1.1rem;padding: 10px;">Daily Reward Pool</span><br><button style="background-color: #fff;color: #373f59;border: 2px solid transparent;border-radius: 22px;margin-bottom: 10px;margin-top: 20px;padding: 5px 25px;font-weight: 600;font-size: 18px;">Share Now</button>
    	</div>
    	<div style="margin-top: 25px;"><span style="color: #202020;font-size: 1.1rem;">Latest <?php echo $news_category; ?> News</span><hr style="margin: 0;background-color: #5f5f5f;">
    		<span style="margin-top: 10px;">
    			<?php $sql2 = "SELECT * FROM latestnews where category='$news_category' ORDER BY id DESC LIMIT 9";
	                $result2 = $conn->query($sql2);
	                if ($result2->num_rows > 0) 
	                {
	                  while($row2 = $result2->fetch_assoc()) 
	                  { 
	                    $side_title = $row2['title'];
	                    $side_category = $row2['category'];
	                    $side_id = $row2['id'];
	                    $side_permlink = validationData(clean($side_title));
	                    echo "<i class='fas fa-step-forward' style='color: #c51d24;'></i>&nbsp;&nbsp;<a href='https://dlike.io/latest/news/".$side_category."/".$side_id."/".$side_permlink."' class='news-detail' style='font-size:0.8rem'>".$side_title."</a><br>";
	                  }
	                } ?>
    		</span>
    	</div>
    </div>
</div></div></div>
<?php include('../template/news-footer.php'); ?>