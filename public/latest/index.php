<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../includes/config.php');
include('../template/news-header.php'); 
include('../functions/main.php');
$ipInfo = file_get_contents('http://ip-api.com/json/' . $thisip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
$mytimezone =  date_default_timezone_get();
?></div><!-- sub-header -->
<div class="container" style="background: #191d5d;max-width: 100% !important;">
  <div class="row" style="padding: 25px;"><div class="col" style="text-align:center;color: #fff;"><h3>Latest News</h3></div></div>
</div>
<div class="faq-section" style="padding-top:1px;"><div class="container news-set"><div style="padding-left:10px;">
<h3 style="font-weight: 600;font-size: 24px;">World News</h3><hr style="margin-top: 0;background-color: #5f5f5f;margin-bottom: 10px;">
  <?php $sql1 = "SELECT * FROM latestnews where category='world' ORDER BY id DESC LIMIT 13";
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
<h3 style="font-weight: 600;font-size: 24px;">Cryptocurrencies</h3><hr style="margin-top: 0;background-color: #5f5f5f;margin-bottom: 10px;">
  <?php $sql1 = "SELECT * FROM latestnews where category='cryptocurrency' ORDER BY id DESC LIMIT 13";
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
<h3 style="font-weight: 600;font-size: 24px;">Business</h3><hr style="margin-top: 0;background-color: #5f5f5f;margin-bottom: 10px;">
  <?php $sql1 = "SELECT * FROM latestnews where category='business' ORDER BY id DESC LIMIT 13";
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
<h3 style="font-weight: 600;font-size: 24px;">Technology</h3><hr style="margin-top: 0;background-color: #5f5f5f;margin-bottom: 10px;">
  <?php $sql1 = "SELECT * FROM latestnews where category='technology' ORDER BY id DESC LIMIT 13";
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
<h3 style="font-weight: 600;font-size: 24px;">Sports</h3><hr style="margin-top: 0;background-color: #5f5f5f;margin-bottom: 10px;">
  <?php $sql1 = "SELECT * FROM latestnews where category='sports' ORDER BY id DESC LIMIT 13";
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
<h3 style="font-weight: 600;font-size: 24px;">Football</h3><hr style="margin-top: 0;background-color: #5f5f5f;margin-bottom: 10px;">
  <?php $sql1 = "SELECT * FROM latestnews where category='football' ORDER BY id DESC LIMIT 13";
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
<h3 style="font-weight: 600;font-size: 24px;">Entertainment</h3><hr style="margin-top: 0;background-color: #5f5f5f;margin-bottom: 10px;">
<?php $sql1 = "SELECT * FROM latestnews where category='entertainment' ORDER BY id DESC LIMIT 13";
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
</div></div></div>
<?php include('../template/news-footer.php'); ?>