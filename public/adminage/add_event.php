<?php include('head.php'); ?>
<div class="container" style="    margin: 20px auto;">
  <h2>
	Add Events
	  <a href="events.php" class="btn btn-primary" style="float: right;">Back</a>
  </h2>
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="Title">Title:</label>
      <input type="text" class="form-control" id="Title" placeholder="Enter Title" name="title">
    </div>
    <div class="form-group">
      <label for="Tags">Tags:</label>
      <input type="text" class="form-control" id="Tags" placeholder="Enter Tags with comma e.g test1,test2" name="tags">
    </div>
    <div class="form-group">
      <label for="Image">Image:</label>
      <input type="file" class="form-control" id="Image" name="file"/>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>


</div>
<?php include('../template/footer2.php'); ?>
<script>
	
$(document).ready(function(){
	
});
</script>


