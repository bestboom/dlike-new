<?php include('head.php'); ?>
<div class="container" style="    margin: 20px auto;">
  <h2>
	Ads
	<a href="javascript:" class="btn text-white bg-success" data-option="enable" id="ads_show_status" style="float: right;margin-left: 5px;">Success</a>
  </h2>
  <div class="col-sm-12" style="display: block;    overflow: hidden;">
  <form method="post" action="/helper/save_admin_data.php" enctype="multipart/form-data">
	<input type="hidden" name="tag" value="ads"/>
	<div class="col-sm-6" style="float:left;">
	<div class="form-group">
	  <label for="ad1_html">Ad1 HTML:</label>
	  <textarea class="form-control" id="ad1_html" placeholder="Enter Ad1 html" name="ad1_html"></textarea>
	</div>
	 </div>
	 <div class="col-sm-6" style="float:left;">
	<div class="form-group">
	  <label for="ad2_html">Ad2 HTML:</label>
	  <textarea class="form-control" id="ad2_html" placeholder="Enter Ad2 html" name="ad2_html"></textarea>
	</div>
	  </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</div>
<?php include('../template/footer2.php'); ?>
<script>
	
$(document).ready(function(){
    var ads_show_status = $('#ads_show_status');
    ads_show_status.click(function(){
		$("#loader").show();
		var option = $(this).data('option');
		var setclass="bg-danger";
		var r_class="bg-success";
		var setoption="disable";
		
		$.ajax({
		    type: "POST",
		    url: '/helper/save_admin_data.php',
		    data:{'tag':'settings','type':'ads','option':option},
		    dataType: 'json',
		    success: function(response) {
				$("#loader").hide();
			if(response.status == "OK") {
				
			    toastr.success(response.message);
			    if(option == "disable") {
					setclass = "bg-success";
					setoption="enable";
					r_class = "bg-danger";
					settoption = "Enable";
				}
				else {
					setclass = "bg-danger";
					setoption="disable";
					r_class = "bg-success";
					settoption = "Disable";
				}
			    ads_show_status.addClass(setclass);
			    ads_show_status.removeClass(r_class);
			    ads_show_status.data('option',setoption);
			    ads_show_status.text(settoption);
			    
				
			}
			else {
			    toastr.error(response.message);
			    return false;
			}
		    },
		    error: function() {
				$("#loader").hide();
				toastr.error('Error occured');
			    return false;
		    }
	    });
	});

	$.ajax({
		type: "POST",
		url: '/helper/getadmindata.php',
		data:{'data':'ads'},
		dataType: 'json',
		success: function(response) {
			$("#loader").hide();
			if(response.status == "OK") {
				var result_data = response.html_data;
				var ad1_html = '';
				var ad2_html = '';
				for(i=0;i<result_data.length;i++){
				    if(result_data[i]['ad_html'] == "ad1"){
					ad1_html = $.base64.decode(result_data[i]['ad_html']);
				    }
				    if(result_data[i]['ad_html'] == "ad2"){
					ad2_html = $.base64.decode(result_data[i]['ad_html']);
				    }
				}
					    
				$("#ad1_html").val(ad1_html);
				$("#ad2_html").val(ad2_html);
			}
		}
	});

});
</script>
