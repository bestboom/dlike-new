<?php
include('template/header5.php'); 
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
          <?php $sql1 = "SELECT * FROM latestnews ORDER BY id DESC LIMIT 48";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) 
                {
                  while($row1 = $result1->fetch_assoc()) 
                  { 
                    $category = $row1['category'];
                    $news_time = $row1['news_time'];
                    echo "".$news_time."<i class='fas fa-step-forward'></i>&nbsp;<a href='https://dlike.io/latest/".$category."' class='news-detail'>".$row1['title']."</a><br>";
                  }
                } ?>
            </div>
        </div>
    </div>
<?php include('template/footer.php'); ?>

var aq = moment.unix(1588100604).format('HH:mm')