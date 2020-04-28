<?php  include('template/header5.php'); include('includes/config.php'); ?>
</div><!-- sub-header -->
<style>
  .faq-section{background: #e6e6e6;}
  .container {max-width: 1366px;background: #fff;padding: 100px 50px 50px;}
</style>
<div class="container" style="background: #191d5d;max-width: 100% !important;">
    <div class="row" style="padding: 50px;">
        <div class="col" style="text-align:center;color: #fff;">
            <h3>Latest News</h3>
        </div>
    </div>
</div>
    <div class="faq-section">
        <div class="container2">
            <div class="row">
          <?php $sql1 = "SELECT * FROM latestnews ORDER BY id DESC LIMIT 48";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) 
                {
                  while($row1 = $result1->fetch_assoc()) 
                  {
                      echo $title = $row1['title']."<br>";  
                  }
                } ?>
            </div>
        </div>
    </div>
<?php include('template/footer.php'); ?>