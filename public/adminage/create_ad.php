<?php include('head.php'); ?>
<div class="container" style="    margin: 20px auto;">
  <h2>
	Create Ad
	  <a href="events.php" class="btn btn-primary" style="float: right;">Back</a>
  </h2>
  <form method="post" action="/helper/save_admin_data.php" enctype="multipart/form-data">
	<input type="hidden" name="tag" value="ads"/>
    <div class="form-group">
      <label for="Title">Title:</label>
      <input type="text" class="form-control" id="Title" placeholder="Enter Title" name="title">
    </div>
    <div class="form-group">
      <label for="Tags">Ad HTML:</label>
      <textarea class="form-control" id="ad_html" placeholder="Enter html" name="ad_html"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>


</div>
<?php include('../template/footer2.php'); ?>
<script>
	
$(document).ready(function(){
	
});
</script>
