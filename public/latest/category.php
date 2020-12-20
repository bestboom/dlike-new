<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$page_category = $_GET['cat'];
include('../includes/config.php');
include('../latest/main.php');
include('../template/news-header.php'); 
$ipInfo = file_get_contents('http://ip-api.com/json/' . $thisip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
$mytimezone =  date_default_timezone_get();
function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    $string = str_replace('--', '-', $string); // Replaces all spaces with hyphens.
    return strtolower($string);
}
function validationData($data){$data = htmlspecialchars(strip_tags(nl2br(trim($data))));return $data;}
?></div><!-- sub-header -->
<div class="container" style="background: #191d5d;max-width: 100% !important;">
  <div class="row" style="padding: 25px;"><div class="col" style="text-align:center;color: #fff;"><h3>Latest <?php echo ucfirst($page_category); ?> News</h3></div></div>
</div>
<div class="faq-section" style="padding-top:1px;"><div class="container news-set"><div style="padding-left:10px;">
  <div class="row" style="margin: 2px;font-size: 0.85rem;color: #c51d24;"><a href="/latest">Latest News </a> &nbsp; > &nbsp; <?php echo ucfirst($page_category); ?></div>
  <?php $sql1 = "SELECT * FROM latestnews where category='$page_category' ORDER BY id DESC LIMIT 54";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) 
    {
      while($row1 = $result1->fetch_assoc()) 
      { 
        $title = $row1['title'];
        $category = $row1['category'];
        $news_id = $row1['id'];
        $news_time = $row1['news_time'];
        $permlink = validationData(clean($title));
        $dt = new DateTime();
        $dt->setTimestamp($news_time);
        $dt->setTimezone(new DateTimeZone($mytimezone));
        $datetime = $dt->format('H:i');
        echo "".$datetime."&nbsp;<i class='fas fa-step-forward' style='color: #c51d24;'></i>&nbsp;&nbsp;<a href='https://dlike.io/latest/news/".$category."/".$news_id."/".$permlink."' class='news-detail'>".$row1['title']."</a><br>";
      }
    } ?>
<br> 
</div></div></div>
<?php include('../template/news-footer.php'); ?>