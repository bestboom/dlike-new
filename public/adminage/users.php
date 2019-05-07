<?php include('head.php'); ?>
<div class="container" style="    margin: 20px auto;">
  <h2>Users</h2>
  <div id="show_results"></div>

  <div class="modal fade" id="userPostStatusModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-body text-center">
			<input type="hidden" id="pu_username" />
		
			<p>User Status</p>
			<select class="form-control" id="userstatus_select">
				<option value="">Please select</option>
				<option value="0">Blacklisted</option>
				<option value="1">Greenlisted</option>
				<option value="2">Whitelisted</option>
				<option value="3">Pro</option>
			</select>
			<br>
			<p><input type="button" id="saveuserpoststatus" class="btn btn-primary" value="Save it"/></p>
				
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
<style>table.dataTable thead th{    border-bottom: 1px solid #dee2e6;}.dataTables_length{display:none !important;}.dataTables_wrapper .dataTables_filter input{    display: block;width: auto;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}table.dataTable.no-footer{    border-bottom: 1px solid #dee2e6;}</style>
<script>

	function openuser_popup(self){
		var author = $(self).data('author');
		var status = $(self).data('status');
		
		$("#pu_username").val(author);
		$("#userstatus_select").val(status);
		$("#userPostStatusModal").modal('show');
    }

    
$(document).ready(function(){
	var saveuserpoststatus=$('#saveuserpoststatus');

	saveuserpoststatus.click(function(){

	    var p_username = $("#pu_username").val();
	    var p_status = $("#userstatus_select").val();

	    
	    if(p_status == ""){
			alert("Please select user status.");
			return false;
	    }
	    
	    $.ajax({
		    type: "POST",
		    url: '/helper/userpoststatus.php',
		    data:{'p_username':p_username,'p_status':p_status},
		    dataType: 'json',
		    success: function(response) {
			if(response.status == "OK") {
			    toastr.success(response.message);
			    $('#userPostStatusModal').modal('hide');
				var set_status = "";
			    if(p_status == 0 || p_status == "Blacklisted"){
					set_status = "Blacklisted";
				}
				else if(p_status == 1 || p_status == "Greenlisted"){
					set_status = "Greenlisted";
				}
				else if(p_status == 2 || p_status == "Whitelisted"){
					set_status = "Whitelisted";
				}
				else if(p_status == 3 || p_status == "Pro"){
					set_status = "Pro";
				}

					

			    var all_status = p_status;
			    $("#user_"+p_username).text('Edit Status');
			    $("#user_"+p_username).data('status',all_status);

			    $("#user_s_"+p_username).html(set_status);
				
			}
			else {
			    $('#userPostStatusModal').modal('hide');
			    toastr.error(response.message);
			    return false;
			}
		    },
		    error: function() {
				$('#userPostStatusModal').modal('hide');
				toastr.error('Error occured');
			    return false;
		    }
	    });
	});
	

	$.ajax({
		type: "POST",
		url: '/helper/getadmindata.php',
		data:{'data':'users'},
		dataType: 'json',
		success: function(response) {
			if(response.status == "OK") {
				var result_data = response.html_data;
				var result_html = ' <table class="table table-bordered" id="user_table"><thead><tr><th>Username</th><th>Status</th><th>Action</th></tr></thead><tbody >';
				for(i=0;i<result_data.length;i++){

					var action_var = "Add Status";
					var set_status = "";
					if(result_data[i]['status'] == 0 || result_data[i]['status'] == "Blacklisted"){
						set_status = "Blacklisted";
					}
					else if(result_data[i]['status'] == 1 || result_data[i]['status'] == "Greenlisted"){
						set_status = "Greenlisted";
					}
					else if(result_data[i]['status'] == 2 || result_data[i]['status'] == "Whitelisted"){
						set_status = "Whitelisted";
					}
					else if(result_data[i]['status'] == 3 || result_data[i]['status'] == "Pro"){
						set_status = "Pro";
					}

					if(result_data[i]['status'] !== null && result_data[i]['status'] !== undefined){
						action_var = "Edit Status";
					}
					
					
					result_html += '<tr><td>'+result_data[i]['username']+'</td><td id="user_s_'+result_data[i]['username']+'">'+set_status+'</td><td><a href="javascript:"  id="user_'+result_data[i]['username']+'" onclick="return openuser_popup(this)" class="btn btn-small btn-primary" data-author="'+result_data[i]['username']+'" data-status="'+result_data[i]['status']+'" >'+action_var+'</a></td></tr>';
				}

				result_html += '</tbody></table>';
				$("#show_results").html(result_html);
				$('#user_table').DataTable({language: { search: '', searchPlaceholder: "Search..." }});
			}
		}
	});
});
</script>

