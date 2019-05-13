<?php include('head.php'); ?>
<div class="container" style="    margin: 20px auto;">
  <h2>
	  Ads
	  <a href="create_ad.php" class="btn btn-primary" style="float: right;">Create Ad</a>
  </h2>
  <p id="total_result"></p>
  <div class="admin-latest-post-section">
	  <div id="loader">Loading</div>
	  <div id="show_results"></div>
  </div>

  <div class="modal fade" id="adStatusModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		    <div class="modal-body text-center">
			    <input type="hidden" id="a_id" />
			    <label for="Tags" class="">Ad HTML:</label>
			    <textarea class="form-control" id="ad_html" placeholder="Enter html" name="ad_html"></textarea>
			    <br>
			    <label for="Title">Status:</label>
			    <input type="radio" name="status" id="status_1" value="1"> Active
    
			    <input type="radio" name="status" id="status_0"value="0"> Inactive
    
			    <p><input type="button" id="saveadstatus" class="btn btn-primary" value="Save it"/></p>
				    
		    </div>
		    <div class="modal-footer">
		      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
	  </div>
	  
	</div>
      </div>
</div>
<?php include('../template/footer2.php'); ?>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//rawgit.com/carlo/jquery-base64/master/jquery.base64.min.js"></script>
<style>table.dataTable thead th{    border-bottom: 1px solid #dee2e6;}.dataTables_length{display:none !important;}.dataTables_wrapper .dataTables_filter input{    display: block;width: auto;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}table.dataTable.no-footer{    border-bottom: 1px solid #dee2e6;}</style>
<script>
	function openad_popup(self){
		var ad_html = $.base64.decode($(self).data('adhtml'));
		var status = $(self).data('status');
		var a_id =  $(self).data('id');
		
		$("#a_id").val(a_id);
		$("#ad_html").val(ad_html);
		$("#status_"+status).prop("checked", true);
		
		$("#adStatusModal").modal('show');
    }
    
$(document).ready(function(){
	$("#loader").show();
	
	var saveadstatus=$('#saveadstatus');

	
	saveadstatus.click(function(){
	    $("#loader").show();
	    var a_ad_html = $("#ad_html").val();
	    var a_status = $("input[name='status']:checked").val();
	    var a_id = $("#a_id").val();
	    if(a_status == ""){
		alert("Please select status.");
		return false;
	    }
	    
	    $.ajax({
		    type: "POST",
		    url: '/helper/save_admin_data.php',
		    data:{'tag':'ads','a_id':a_id,'status':a_status,'ad_html':a_ad_html},
		    dataType: 'json',
		    success: function(response) {
			$("#loader").hide();
			if(response.status == "OK") {
			    toastr.success(response.message);
			    $('#adStatusModal').modal('hide');
			    

			    var status = "Inactive";
			    if(a_status == "1"){
				status = "Active";
			    }
			    

			    $("#status_"+a_id).html(status);
			    $("#ad_html_"+a_id).html(a_ad_html);
			    $("#ad_"+a_id).data('adhtml',$.base64.encode(a_ad_html));
			    $("#ad_"+a_id).data('status',a_status);
			    
			    
				
			}
			else {
			    $('#adStatusModal').modal('hide');
			    toastr.error(response.message);
			    return false;
			}
		    },
		    error: function() {
				$("#loader").hide();
			$('#adStatusModal').modal('hide');
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
				var total = response.total;
				$("#total_result").html(total+" ads found.");
				
				var result_html = ' <table class="table table-bordered" id="ad_table"><thead><tr><th>Ad HTML</th><th>Status</th><th>Action</th></tr></thead><tbody >';
				var ad_html = '';
				for(i=0;i<result_data.length;i++){
					ad_html = $.base64.decode(result_data[i]['ad_html']);
					var action_var = "Edit";
					var status = "Inactive";
					if(result_data[i]['status'] == "1"){
					    status = "Active";
					}
					
					result_html += '<tr><td id="ad_html_'+result_data[i]['id']+'">'+ad_html+'</td><td id="status_'+result_data[i]['id']+'">'+status+'</td><td><a href="javascript:"  id="ad_'+result_data[i]['id']+'" onclick="return openad_popup(this)" class="btn btn-small btn-primary"  data-adhtml="'+result_data[i]['ad_html']+'" data-id="'+result_data[i]['id']+'" data-status="'+result_data[i]['status']+'" >'+action_var+'</a></td></tr>';
				}
				result_html += '</tbody></table>';			    
				$("#show_results").html(result_html);
				$('#ad_table').DataTable({language: { search: '', searchPlaceholder: "Search..." }});
			}
		}
	});
});
</script>
