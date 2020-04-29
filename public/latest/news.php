<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../template/header6.php'); 
echo $link = $_GET['link'];
echo $id = $_GET['id'];
?>
</div><!-- sub-header -->
<style>
  .faq-section{background: #e6e6e6;}
  .news-set {max-width: 1366px;background: #fff;padding: 80px 50px 50px;}
  .news-detail{color: #202020;font-family: Verdana,Arial,Helvetica,sans-serif;font-size: 1rem;font-weight: 500;line-height: 2.2;text-decoration: underline;}
  .news-detail a:hover {color: #86828C;}
</style>
<div class="container" style="background: #191d5d;max-width: 100% !important;">
    <div class="row" style="padding: 25px;">
        <div class="col" style="text-align:center;color: #fff;">
            <h3>Latest News</h3>
        </div>
    </div>
</div>
    <div class="faq-section" style="padding-top:1px;">
        <div class="container news-set">
            <div style="padding-left:10px;">
          <?php $sql1 = "SELECT * FROM latestnews where id='$id'";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) 
                $post_data = mysqli_fetch_assoc($result1); 
    			$post_title = $post_data["title"];
                } ?>
                <h2><?php echo $post_title; ?></h2>
            </div>
        </div>
    </div>
<?php include('../template/news-footer.php'); ?>