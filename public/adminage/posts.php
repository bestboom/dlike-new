<?php include('head.php'); ?>
<div class="container" style="    margin: 20px auto;">
	<h2>
	    Posts
	    <button type="button" style="float:right" class="btn btn-danger" data-toggle="modal" data-target="#deleteposts">Delete Posts</button>
	</h2>
	<p id="total_result"></p>

  <div class="admin-latest-post-section">
	  <div id="loader">Loading</div>
	  <div id="show_results"></div>
  </div>

  <div class="modal fade" id="PostStatusModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		    <div class="modal-body text-center">
			    <input type="hidden" id="p_username" />
			    <input type="hidden" id="p_permlink" />
			    <input type="hidden" id="p_category" />
			    <p>What would you think about this post?</p>
			    <select class="form-control" id="status_select">
			    <option value="">Please select</option>
			    <option value="Rejected">Rejected</option>
			    <option value="Low Level">Low Level</option>
			    <option value="High Level">High Level</option>
			    </select>
			    <br>
			    <p><input type="button" id="savepoststatus" class="btn btn-primary" value="Save it"/></p>
				    
		    </div>
		    <div class="modal-footer">
		      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
	  </div>
	  
	</div>
      </div>


      <div class="modal fade" id="deleteposts" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-body text-center">
		    
			<div class="text-left">
			    <label>How many hours older posts you want to delete?</label>
			    <input type="text" id="p_hours" class="form-control" placeholder="Please enter hours"/><br>
			</div>
		    <p><input type="button" id="deleteposts_status" class="btn btn-primary" value="Delete"/></p>
			    
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	  
	</div>
      </div>
      
</div>
<?php include('../template/footer3.php'); ?>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<style>table.dataTable thead th{    border-bottom: 1px solid #dee2e6;}.dataTables_length{display:none !important;}.dataTables_wrapper .dataTables_filter input{    display: block;width: auto;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}table.dataTable.no-footer{    border-bottom: 1px solid #dee2e6;}</style>
<script>

	function openpost_popup(self){
		var permlink = $(self).data('permlink');
		var author = $(self).data('author');
		var category = $(self).data('category');
		var status = $(self).data('status');
		
		$("#p_username").val(author);
		$("#p_permlink").val(permlink);
		$("#p_category").val(category);

		$("#status_select").val(status);
		
		$("#PostStatusModal").modal('show');
    }

    
$(document).ready(function(){

    $("#loader").show();
    
	var savepoststatus=$('#savepoststatus');
	var deleteposts_status = $('#deleteposts_status');

	deleteposts_status.click(function(){
	    $("#loader").show();

	    var p_hours = $("#p_hours").val();
	    if(p_hours == ""){
		alert("Please enter hours.");
		return false;
	    }
	    
	    $.ajax({
		    type: "POST",
		    url: '/helper/deleteposts.php',
		    data:{'p_hours':p_hours},
		    dataType: 'json',
		    success: function(response) {
			if(response.status == "OK") {
			    toastr.success(response.message);
			    $('#deleteposts').modal('hide');

			    $.ajax({
				type: "POST",
				url: '/helper/getadmindata.php',
				data:{'data':'posts'},
				dataType: 'json',
				success: function(response) {
				    $("#loader").hide();
					if(response.status == "OK") {
						var result_data = response.html_data;
						var total = response.total;
						$("#total_result").html(total+" Posts found.");
						var result_html = ' <table class="table table-bordered" id="post_table"><thead><tr><th>Title</th><th>Username</th><th>Category</th><th>Permlink</th><th>Status</th><th>Action</th></tr></thead><tbody >';
						for(i=0;i<result_data.length;i++){

							var action_var = "Add Status";
			
							var all_status = result_data[i]['status'];
							if(all_status !== null && all_status !== undefined){
							    action_var = "Edit Status";
							}
					    
							
							
							result_html += '<tr><td>'+result_data[i]['title']+'</td><td>'+result_data[i]['username']+'</td><td>'+result_data[i]['category']+'</td><td>'+result_data[i]['permlink']+'</td><td id="post_s_'+result_data[i]['username']+'">'+all_status+'</td><td><a href="javascript:"  id="post_'+result_data[i]['username']+'" onclick="return openpost_popup(this)" class="btn btn-small btn-primary" data-author="'+result_data[i]['username']+'" data-category="'+result_data[i]['category']+'" data-permlink="'+result_data[i]['permlink']+'" data-status="'+all_status+'" >'+action_var+'</a></td></tr>';
						}

						result_html += '</tbody></table>';
						$("#show_results").html(result_html);
						$('#post_table').DataTable({language: { search: '', searchPlaceholder: "Search..." }});
					}
				}
			});

	
			}
			else {
			     $("#loader").hide();
			    $('#deleteposts').modal('hide');
			    toastr.error('Error occured');
			    return false;
			}
		    },
		    error: function() {
			 $("#loader").hide();
			$('#deleteposts').modal('hide');
			 toastr.error('Error occured');
			    return false;
		    }
	    });
	});

	

	savepoststatus.click(function(){
	    $("#loader").show();

	    var p_username = $("#p_username").val();
	    var p_permlink = $("#p_permlink").val();
	    var p_category = $("#p_category").val();
	    var p_status = $("#status_select").val();
	    if(p_status == ""){
		alert("Please select status.");
		return false;
	    }
	    
	    $.ajax({
		    type: "POST",
		    url: '/helper/poststatus.php',
		    data:{'p_username':p_username,'p_permlink':p_permlink,'p_category':p_category,'p_status':p_status},
		    dataType: 'json',
		    success: function(response) {
			 $("#loader").hide();
			if(response.status == "OK") {
			    toastr.success(response.message);
			    $('#PostStatusModal').modal('hide');
			    
			    var all_status = p_status;
			    $("#post_"+p_username).text('Edit Status');
			    $("#post_"+p_username).data('status',all_status);

			    $("#post_s_"+p_username).html(all_status);
			    
				
			}
			else {
			    $('#PostStatusModal').modal('hide');
			    toastr.error(response.message);
			    return false;
			}
		    },
		    error: function() {
			 $("#loader").hide();
			$('#PostStatusModal').modal('hide');
			 toastr.error('Error occured');
			    return false;
		    }
	    });
	});
	

	$.ajax({
		type: "POST",
		url: '/helper/getadmindata.php',
		data:{'data':'posts'},
		dataType: 'json',
		success: function(response) {
		    $("#loader").hide();
			if(response.status == "OK") {
				var result_data = response.html_data;
				var total = response.total;
				$("#total_result").html(total+" Posts found.");
				var result_html = ' <table class="table table-bordered" id="post_table"><thead><tr><th>Title</th><th>Username</th><th>Category</th><th>Permlink</th><th>Status</th><th>Action</th></tr></thead><tbody >';
				for(i=0;i<result_data.length;i++){

					var action_var = "Add Status";
	
					var all_status = result_data[i]['status'];
					if(all_status !== null && all_status !== undefined){
					    action_var = "Edit Status";
					}
			    
					
					
					result_html += '<tr><td>'+result_data[i]['title']+'</td><td>'+result_data[i]['username']+'</td><td>'+result_data[i]['category']+'</td><td>'+result_data[i]['permlink']+'</td><td id="post_s_'+result_data[i]['username']+'">'+all_status+'</td><td><a href="javascript:"  id="post_'+result_data[i]['username']+'" onclick="return openpost_popup(this)" class="btn btn-small btn-primary" data-author="'+result_data[i]['username']+'" data-category="'+result_data[i]['category']+'" data-permlink="'+result_data[i]['permlink']+'" data-status="'+all_status+'" >'+action_var+'</a></td></tr>';
				}

				result_html += '</tbody></table>';
				$("#show_results").html(result_html);
				$('#post_table').DataTable({language: { search: '', searchPlaceholder: "Search..." }});
			}
		}
	});
});
</script>

